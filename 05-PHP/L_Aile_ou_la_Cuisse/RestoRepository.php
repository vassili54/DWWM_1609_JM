<?php
class RestoRepository
{
    private $db;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->db = new PDO(
                'mysql:host=localhost;dbname=Guide;charset=utf8mb4',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }

    /**
     * Récupère tous les restaurants de la base de données
     * @return array Tableau associatif des restaurants
     * @throws Exception Si la requête échoue
     */
    public function searchAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM restaurants ORDER BY nom");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->execute()) {
            $tab = $stmt->fetchAll();
            return $tab;
        } else {
            return [];
        }
    }
    /**
     * Récupère un restaurant par son ID
     * @param int $id L'identifiant du restaurant
     * @return array Les données du restaurant
     */
    public function searchById($_id): array
    {
        if (!is_numeric($_id)) {
            throw new Exception("L'identifiant doit être un nombre entier.");
        }
        $stmt = $this->db->prepare("SELECT * FROM restaurants WHERE id=:id");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':id', $_id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            return [];
        }
        return $stmt->fetch();
    }
    /**
     * Récupère les noms des colonnes de la table choisie et la clé primaire
     * @param string $tableName Le nom de la table
     * @return array Tableau associatif contenant les noms des colonnes et la clé primaire
     */
    private function info_table($tableName): array {
        // Requête pour obtenir les colonnes
        $stmt = $this->db->prepare("DESCRIBE $tableName");
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Extraction juste des noms de colonnes
        $columnNames = array_column($columns, 'Field');

        // Identification de la clé primaire
        $primaryKey = '';
        foreach ($columns as $column) {
            if ($column['Key'] === 'PRI') {
                $primaryKey = $column['Field'];
                break;
            }
        }

        return [
            'columns' => $columnNames,
            'primary_key' => $primaryKey
        ];
    }
    /**
     * Génère un tableau HTML5 avec les données de la table
     * @param string $tableName Le nom de la table
     * @return string HTML du tableau
     */
    public function rendre_html($tableName): string {
    $tableInfo = $this->info_table($tableName);
    $columns = $tableInfo['columns'];
    $primaryKey = $tableInfo['primary_key'];
    $data = $this->searchAll();

    $html = '<div class="table-responsive">';
    $html .= '<table class="table table-striped table-bordered">';
    $html .= '<thead class="table-dark"><tr>';

    // Ajouter les noms des colonnes
    foreach ($columns as $column) {
        $html .= '<th>' . htmlspecialchars($column);
        if ($column === $primaryKey) {
            $html .= ' <i class="bi bi-key" title="Clé primaire"></i>';
        }
        $html .= '</th>';
    }
    $html .= '<th>Modifier</th>'; // Ajouter une colonne pour le bouton Modifier
    $html .= '<th>Supprimer</th>'; // Ajouter une colonne pour le bouton Supprimer

    $html .= '</tr></thead><tbody>';

    // Ajouter des données
    foreach ($data as $row) {
        $html .= '<tr>';
        foreach ($columns as $column) {
            $html .= '<td';
            if ($column === $primaryKey) {
                $html .= ' class="fw-bold"';
            }
            $html .= '>' . htmlspecialchars($row[$column] ?? '') . '</td>';
        }

        // Ajouter le bouton de modification
        $html .= '<td>';
        $html .= '<a href="fichedetail.php?id=' . $row[$primaryKey] . '" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Modifier</a>';
        $html .= '</td>';

        // Ajouter le bouton de suppression
        $html .= '<td>';
        $html .= '<form method="POST" action="fichedetail.php" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer cet enregistrement ?\')">';
        $html .= '<input type="hidden" name="id" value="' . $row[$primaryKey] . '">';
        $html .= '<input type="hidden" name="action" value="delete">';
        $html .= '<button type="submit" name="delete" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Supprimer</button>';
        $html .= '</form>';
        $html .= '</td>';

        $html .= '</tr>';
    }

    $html .= '</tbody></table>';
    $html .= '</div>';
    return $html;
}

    /**
     * Modifie un enregistrement dans la table
     * @param string $tableName Le nom de la table
     * @param int $id L'identifiant de l'enregistrement
     * @param array $data Les données à mettre à jour
     * @return bool True si la mise à jour a réussi, false sinon
     */
    public function modifyRow($tableName, $id, $data): bool {
        $tableInfo = $this->info_table($tableName);
        $primaryKey = $tableInfo['primary_key'];

        $setParts = [];
        foreach ($data as $key => $value) {
            $setParts[] = "$key = :$key";
        }
        $setClause = implode(', ', $setParts);

        $sql = "UPDATE $tableName SET $setClause WHERE $primaryKey = :id";
        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function insertRow($tableName, $data): bool {
    $columns = implode(', ', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));
    
    $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
    $stmt = $this->db->prepare($sql);
    
    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }
    
    return $stmt->execute();
    }


    /**
     * Supprime un enregistrement de la table
     * @param string $tableName Le nom de la table
     * @param int $id L'identifiant de l'enregistrement
     * @return bool True si la suppression a réussi, false sinon
     */

    public function deleteRow($tableName, $id): bool {
    if (!is_numeric($id)) {
        throw new InvalidArgumentException("L'ID doit être numérique");
    }
    
    $tableInfo = $this->info_table($tableName);
    $primaryKey = $tableInfo['primary_key'];
    
    $sql = "DELETE FROM $tableName WHERE $primaryKey = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
    return $stmt->execute();
    }

    public function __destruct()
    {
        $this->db = null;
    }
}
?>
