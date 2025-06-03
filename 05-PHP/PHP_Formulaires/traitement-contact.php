<?php
// traitement-contact.php

// Vérification que la méthode est bien POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Méthode non autorisée.");
}

try {
    // Vérification que toutes les données sont présentes
    if (!isset($_POST['nom'], $_POST['naissance'], $_POST['email'], $_POST['message'])) {
        throw new Exception("Tous les champs du formulaire sont obligatoires.");
    }

    // Récupération des données
    $nom = trim($_POST['nom']);
    $naissance = $_POST['naissance'];
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Validation du nom (lettres seulement, 2 caractères minimum)
    if (!preg_match('/^[A-Za-zÀ-ÿ\s]{2,}$/u', $nom)) {
        throw new Exception("Le nom doit contenir uniquement des lettres (minimum 2 caractères).");
    }

    // Validation de la date de naissance (doit être dans le passé)
    $dateNaissance = new DateTime($naissance);
    $aujourdhui = new DateTime();
    if ($dateNaissance >= $aujourdhui) {
        throw new Exception("La date de naissance doit être dans le passé.");
    }

    // Calcul de l'âge
    $age = $dateNaissance->diff($aujourdhui)->y;

    // Vérification de l'âge (doit être >= 18)
    if ($age < 18) {
        throw new Exception("Vous êtes mineur, accès interdit.");
    }

    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("L'adresse email n'est pas valide.");
    }

    // Validation du message (pas de balises HTML)
    if ($message !== strip_tags($message)) {
        throw new Exception("Le message ne doit pas contenir de balises HTML.");
    }

    // Si toutes les validations passent, afficher les résultats
    ?>
    <!DOCTYPE html>
    <html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Résultat du formulaire</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="result-container">
            <h1>Merci pour votre message !</h1>
            
            <div class="result">
                <h2>Informations soumises :</h2>
                <p><strong>Nom :</strong> <?= htmlspecialchars($nom) ?></p>
                <p><strong>Date de naissance :</strong> <?= htmlspecialchars($naissance) ?></p>
                <p><strong>Âge :</strong> <?= $age ?> ans</p>
                <p><strong>Email :</strong> <?= htmlspecialchars($email) ?></p>
                <p><strong>Message :</strong></p>
                <p><?= nl2br(htmlspecialchars($message)) ?></p>
            </div>
        </div>
    </body>
    </html>
    <?php

} catch (Exception $e) {
    // Affichage des erreurs
    ?>
    <!DOCTYPE html>
    <html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Erreur</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="error-container">
            <h1>Erreur lors du traitement du formulaire</h1>
            <div class="error">
                <?= htmlspecialchars($e->getMessage()) ?>
            </div>
            <a href="contact.html" class="back-link">Retour au formulaire</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}
?>