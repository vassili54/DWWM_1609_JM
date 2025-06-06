<?php
// Vérification que la méthode est bien POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Accès non autorisé.");
}

// Fonction pour nettoyer les données
function nettoyer($donnee) {
    $donnee = trim($donnee);
    $donnee = stripslashes($donnee);
    $donnee = htmlspecialchars($donnee, ENT_QUOTES, 'UTF-8');
    return $donnee;
}

try {
    // Vérification des champs obligatoires
    if (!isset($_POST['nom'], $_POST['dateDeNaissance'], $_POST['email'], $_POST['message'])) {
        throw new Exception('Tous les champs sont obligatoires.');
    }

    // Nettoyage et récupération des données
    $nom = nettoyer($_POST['nom']);
    $dateDeNaissance = $_POST['dateDeNaissance'];
    $email = nettoyer($_POST['email']);
    $message = nettoyer($_POST['message']);

    // Validation du nom
    if (!preg_match('/^[a-zA-ZÀ-ÿ\s\-]{2,50}$/u', $nom)) {
        throw new Exception('Le nom doit contenir uniquement des lettres (2-50 caractères).');
    }

    // Validation de la date
    $dateNaissance = DateTime::createFromFormat('Y-m-d', $dateDeNaissance);
    if (!$dateNaissance) {
        throw new Exception('Format de date invalide.');
    }

    $aujourdhui = new DateTime();
    if ($dateNaissance >= $aujourdhui) {
        throw new Exception('La date de naissance doit être dans le passé.');
    }

    // Calcul de l'âge
    $age = $dateNaissance->diff($aujourdhui)->y;

    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Adresse email invalide.');
    }

    // Protection contre XSS pour le message
    $message = strip_tags($message);
    if (empty($message)) {
        throw new Exception('Le message ne doit pas être vide après suppression des balises HTML.');
    }

    // Affichage des résultats
    ?>
    <!DOCTYPE html>
    <html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmation</title>
        <link rel="stylesheet" href="./asset/css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="resultat">
                <h2>Merci pour votre message !</h2>
                <p><strong>Nom :</strong> <?= $nom ?></p>
                <p><strong>Date de naissance :</strong> <?= $dateDeNaissance ?> (Âge: <?= $age ?> ans)</p>
                <p><strong>Email :</strong> <?= $email ?></p>
                <p><strong>Message :</strong></p>
                <div><?= nl2br($message) ?></div>
            </div>
        </div>
    </body>
    </html>
    <?php
} catch (Exception $e) {
    // Gestion des erreurs
    ?>
    <!DOCTYPE html>
    <html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Erreur</title>
        <link rel="stylesheet" href="./asset/css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="erreur">
                <h2>Erreur</h2>
                <p><?= htmlspecialchars($e->getMessage()) ?></p>
                <a href="contact.html" class="retour-lien">Retour au formulaire</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}