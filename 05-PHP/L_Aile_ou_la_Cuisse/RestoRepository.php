<?php
require_once './Connection.php';

class RestoRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    /**
     * Récupère tous les restaurants de la base de données
     * @return array Tableau associatif des restaurants
     */
    public function searchAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM restaurants ORDER BY id ASC");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return []; // Retourne un tableau vide en cas d'échec
        }
    }

    /**
     * Récupère un restaurant par son ID
     * @param int $id L'identifiant du restaurant
     * @return array|false Les données du restaurant ou false si non trouvé
     */
    public function searchById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM restaurants WHERE id=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne le tableau associatif ou false
    }

    /**
     * Génère un tableau HTML5 avec les données de la table
     * @param string $tableName Le nom de la table
     * @return string HTML du tableau
     */
    public function rendre_html($tableName): string
    {
        $tableInfo = $this->info_table($tableName);
        $columns = $tableInfo['columns'];
        $primaryKey = $tableInfo['primary_key'];
        $data = $this->searchAll();

        $html = '<div class="table-responsive">';
        $html .= '<table class="table table-striped table-bordered">';
        $html .= '<thead class="table-dark"><tr>';

        foreach ($columns as $column) {
            if (empty($column)) continue;
            $html .= '<th>' . htmlspecialchars($column);
            if ($column === $primaryKey) {
                $html .= ' <i class="bi bi-key" title="Clé primaire"></i>';
            }
            $html .= '</th>';
        }

        /* $html .= '<th>Ajouter</th>'; */
        $html .= '<th>Modifier</th>';
        $html .= '<th>Supprimer</th>';
        $html .= '</tr></thead><tbody>';

        foreach ($data as $row) {
            $html .= '<tr>';
            foreach ($columns as $column) {
                if (empty($column)) continue;
                $html .= '<td';
                $noteClass = '';
                if ($column === 'Note' && is_numeric($row[$column])) {
                    if ($row[$column] >= 7.5) {
                        $noteClass = 'note-high';
                    } elseif ($row[$column] >= 5) {
                        $noteClass = 'note-medium';
                    } else {
                        $noteClass = 'note-low';
                    }
                }
                if (!empty($noteClass)) {
                    $html .= ' class="' . $noteClass . '"';
                } elseif ($column === $primaryKey) {
                    $html .= ' class="fw-bold"';
                }
                $html .= '>' . htmlspecialchars($row[$column] ?? '') . '</td>';
            }
            /*
            // Bouton "Ajouter" qui va vers le formulaire vierge
            $html .= '<td>';
            $html .= '<a href="fichedetail.php" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Ajouter</a>';
            $html .= '</td>';
            */    
            // Bouton de modification
            $html .= '<td>';
            $html .= '<a href="fichedetail.php?id=' . $row[$primaryKey] . '" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Modifier</a>';
            $html .= '</td>';

            // Bouton de suppression (formulaire POST)
            $html .= '<td>';
            $html .= '<form method="POST" action="fichedetail.php" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer cet enregistrement ?\')">';
            $html .= '<input type="hidden" name="id" value="' . $row[$primaryKey] . '">';
            $html .= '<input type="hidden" name="action" value="delete">';
            $html .= '<button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Supprimer</button>';
            $html .= '</form>';
            $html .= '</td>';

            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
        $html .= '</div>';
        return $html;
    }

    /**
     * Récupère les noms des colonnes de la table choisie et la clé primaire
     * @param string $tableName Le nom de la table
     * @return array Tableau associatif contenant les noms des colonnes et la clé primaire
     */
    private function info_table($tableName): array
    {
        $stmt = $this->db->prepare("DESCRIBE $tableName");
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $columnNames = array_column($columns, 'Field');
        $primaryKey = '';
        foreach ($columns as $column) {
            if (isset($column['Key']) && $column['Key'] === 'PRI') {
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
     * Ajoute un nouveau restaurant dans la base de données
     * @param array $data Les données du restaurant
     * @return int L'ID du nouveau restaurant inséré
     * @throws Exception Si l'insertion échoue ou si des données sont manquantes
     */
    public function ajouter(array $data): int
    {
        $requiredFields = ['nom', 'adresse', 'prix'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new Exception("Le champ '$field' est obligatoire.");
            }
        }

        $stmt = $this->db->prepare("
            INSERT INTO restaurants (nom, adresse, prix, Commentaire, Note, visite)
            VALUES (:nom, :adresse, :prix, :commentaire, :note, :visite)");

        $stmt->bindValue(':nom', $data['nom'], PDO::PARAM_STR);
        $stmt->bindValue(':adresse', $data['adresse'], PDO::PARAM_STR);
        $stmt->bindValue(':prix', $data['prix'], PDO::PARAM_STR);
        $stmt->bindValue(':commentaire', $data['Commentaire'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':note', $data['Note'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':visite', $data['visite'] ?? null, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de l'ajout du restaurant : " . implode(', ', $stmt->errorInfo()));
        }

        return $this->db->lastInsertId();
    }

    /**
     * Met à jour un restaurant existant
     * @param int $id L'identifiant du restaurant
     * @param array $data Les nouvelles données
     * @return bool True si la mise à jour a réussi, false sinon
     * @throws Exception En cas d'échec de la modification
     */
    public function modifier(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE restaurants SET
            nom = :nom,
            adresse = :adresse,
            prix = :prix,
            Commentaire = :commentaire,
            Note = :note,
            visite = :visite
            WHERE id = :id
        ");

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':nom', $data['nom'], PDO::PARAM_STR);
        $stmt->bindValue(':adresse', $data['adresse'], PDO::PARAM_STR);
        $stmt->bindValue(':prix', $data['prix'], PDO::PARAM_STR);
        $stmt->bindValue(':commentaire', $data['Commentaire'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':note', $data['Note'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':visite', $data['visite'] ?? null, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de la modification du restaurant : " . implode(', ', $stmt->errorInfo()));
        }

        return $stmt->rowCount() > 0;
    }

    /**
     * Supprime un enregistrement de la table
     * @param string $tableName Le nom de la table
     * @param int $id L'identifiant de l'enregistrement
     * @return bool True si la suppression a réussi, false sinon
     */
    public function deleteRow($tableName, $id): bool
    {
        if (!is_numeric($id)) {
            throw new InvalidArgumentException("L'ID doit être numérique");
        }

        $tableInfo = $this->info_table($tableName);
        $primaryKey = $tableInfo['primary_key'];

        $sql = "DELETE FROM $tableName WHERE $primaryKey = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de la suppression de l'enregistrement : " . implode(', ', $stmt->errorInfo()));
        }
        return $stmt->rowCount() > 0;
    }

    public function __destruct()
    {
        unset($this->db);
    }
    /**
     * Écrit la collection de restaurants dans un fichier JSON
     * @param string $filename Nom du fichier (sans extension)
     * @return void
     * @throws Exception Si l'écriture échoue
     */
    public function chercherCollection(string $filename = 'restaurants'): void
    {
        try {
            $directory = __DIR__ .'/dataobjet';
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            // Chemin complet du fichier
            $filepath = $directory . '/' . $filename . '.json';

            // Recupérer les données
            $restaurants = $this->searchAll();
            $jsonData = json_encode($restaurants, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            if ($jsonData === false) {
                throw new Exception("Erreur lors de la conversion en JSON");
            }
            
            // Écrire dans le fichier (mode 'w' pour écraser)
            $result = file_put_contents($filepath, $jsonData);

            if ($result === false) {
                throw new Exception("Erreur lors de l'écriture dans le fichier");
            }
            
        } catch (Exception $e) {
            throw new Exception("Erreur dans chercherCollection: " . $e->getMessage());
        }
    }
}
