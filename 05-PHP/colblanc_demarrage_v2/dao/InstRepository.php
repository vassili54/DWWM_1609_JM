<?php
class InstRepository {
    private ?PDO $connection;

    public function __construct() {
        $this->connection = Dbconnect::getInstance()->getPdo();
    }

    public function selectAll(): array {
        $query = 'SELECT nom_etab, type_etab, nom_resp, cp, adresse, Telephone, email FROM institutions';
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createInstitution(array $data): bool {
        $query = 'INSERT INTO institutions 
                 (identifiant, nom_resp, nom_etab, type_etab, nom_tut, adresse, cp, ville, depart, Telephone, fax, email, service, `desc`, mobile) 
                 VALUES 
                 (:identifiant, :nom_resp, :nom_etab, :type_etab, :nom_tut, :adresse, :cp, :ville, :depart, :Telephone, :fax, :email, :service, :desc, :mobile)';
        $stmt = $this->connection->prepare($query);
        return $stmt->execute($data);
    }

    public function searchByDepartementAndType($departement, $types): array {
    $sql = "SELECT * FROM institutions WHERE 1=1";
    $params = [];
    
    if (!empty($departement)) {
        $sql .= " AND depart = ?";
        $params[] = $departement;
    }
    
    if (!empty($types)) {
        $sql .= " AND type_etab IN (";
        $placeholders = array_fill(0, count($types), '?');
        $sql .= implode(',', $placeholders) . ")";
        $params = array_merge($params, $types);
    }
    
    $stmt = $this->connection->prepare($sql);
    $stmt->execute($params);
    
    // Debug: affiche la requête et les paramètres
    error_log("Requête SQL: " . $sql);
    error_log("Paramètres: " . print_r($params, true));
    
    return $stmt->fetchAll();
    }
}