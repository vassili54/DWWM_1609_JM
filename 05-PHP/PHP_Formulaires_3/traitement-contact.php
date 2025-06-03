<?php
require_once __DIR__ . '/Dao/ContactRepository.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Accès non autorisé.");
}

function nettoyer($donnee) {
    $donnee = trim($donnee);
    $donnee = stripslashes($donnee);
    $donnee = htmlspecialchars($donnee, ENT_QUOTES, 'UTF-8');
    return $donnee;
}

try {
    if (!isset($_POST['nom'], $_POST['dateDeNaissance'], $_POST['email'], $_POST['message'])) {
        throw new Exception('Tous les champs sont obligatoires.');
    }

    $nom = nettoyer($_POST['nom']);
    $dateDeNaissance = $_POST['dateDeNaissance'];
    $email = nettoyer($_POST['email']);
    $message = nettoyer($_POST['message']);

    if (!preg_match('/^[a-zA-ZÀ-ÿ\s\-]{2,50}$/u', $nom)) {
        throw new Exception('Le nom doit contenir uniquement des lettres (2-50 caractères).');
    }

    $dateNaissance = DateTime::createFromFormat('Y-m-d', $dateDeNaissance);
    if (!$dateNaissance) {
        throw new Exception('Format de date invalide.');
    }

    $aujourdhui = new DateTime();
    if ($dateNaissance >= $aujourdhui) {
        throw new Exception('La date de naissance doit être dans le passé.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Adresse email invalide.');
    }

    $message = strip_tags($message);
    if (empty($message)) {
        throw new Exception('Le message ne doit pas être vide.');
    }

    if (ContactRepository::insertMessage($nom, $dateDeNaissance, $email, $message)) {
        $confirmation = "Votre message a été envoyé avec succès.";
    } else {
        throw new Exception("Erreur lors de l'enregistrement.");
    }

} catch (Exception $e) {
    $erreur = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat</title>
    <link rel="stylesheet" href="./asset/css/style.css">
</head>
<body>
    <div class="container">
        <?php if(isset($confirmation)): ?>
            <div class="result">
                <h2>Confirmation</h2>
                <p><?= $confirmation ?></p>
                <a href="contact.html">Retour</a>
            </div>
        <?php else: ?>
            <div class="error">
                <h2>Erreur</h2>
                <p><?= htmlspecialchars($erreur ?? 'Erreur inconnue') ?></p>
                <a href="contact.html">Retour</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>