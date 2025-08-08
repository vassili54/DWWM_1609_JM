<?php
// auth.php - Version parfaitement adaptée à MySQL Workbench
session_start();
require_once __DIR__.'/config/database.php';

// Vérification requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Nettoyage des entrées
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';

if (!$email || empty($password)) {
    header('Location: index.php?error=invalid_input');
    exit;
}

// Connexion et requête
try {
    $db = DB::connect();
    
    $stmt = $db->prepare("
        SELECT 
            id_scientist,
            firstname_scientist,
            lastname_scientist,
            pass_scientist,
            level,
            mail_scientist
        FROM scientists
        WHERE mail_scientist = :email
        LIMIT 1
    ");
    
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification ARGON2ID
    if ($user && password_verify($password, $user['pass_scientist'])) {
        
        // 5. Mise à jour du hash si nécessaire (pour cohérence avec Workbench)
        $rehashOptions = [
            'memory_cost' => 65536,
            'time_cost' => 4,
            'threads' => 2
        ];
        
        if (password_needs_rehash($user['pass_scientist'], PASSWORD_ARGON2ID, $rehashOptions)) {
            $newHash = password_hash($password, PASSWORD_ARGON2ID, $rehashOptions);
            $update = $db->prepare("UPDATE scientists SET pass_scientist = :hash WHERE id_scientist = :id");
            $update->bindParam(':hash', $newHash, PDO::PARAM_STR);
            $update->bindParam(':id', $user['id_scientist'], PDO::PARAM_INT);
            $update->execute();
        }

        // Session sécurisée
        $_SESSION = [
            'auth' => [
                'validated' => true,
                'expires' => time() + 3600 // 1 heure
            ],
            'user' => [
                'id' => (int)$user['id_scientist'],
                'email' => $user['mail_scientist'],
                'name' => $user['firstname_scientist'].' '.$user['lastname_scientist'],
                'level' => (int)$user['level']
            ],
            'security' => [
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                'last_activity' => time()
            ]
        ];

        header('Location: taupe.php');
        exit;
    }

    // Gestion des échecs
    sleep(2); // Délai anti-brute force
    header('Location: index.php?error=auth_failed&email='.urlencode($email));
    exit;

} catch (PDOException $e) {
    // Journalisation compatible avec MySQL Workbench
    error_log("[MySQL Workbench] ".date('Y-m-d H:i:s')." - Erreur: ".$e->getMessage());
    header('Location: index.php?error=db_error');
    exit;
}
?>