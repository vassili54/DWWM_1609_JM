<?php
// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion via index.php
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=connexion');
    exit;
}

require_once __DIR__ . '/../dao/Dbconnect.php'; // Nécessaire pour DepartementRepository
require_once __DIR__ . '/../dao/CandidateRepository.php';
require_once __DIR__ . '/../dao/DepartementRepository.php'; // Pour afficher le nom du département

$message = '';
$candidate = null;
$departementName = 'N/A';

try {
    $candidateRepo = new CandidateRepository();
    $candidate = $candidateRepo->findById($_SESSION['user_id']);

    if (!$candidate) {
        // Si le candidat n'est pas trouvé (ce qui ne devrait pas arriver si l'ID en session est valide)
        session_destroy(); // Détruire la session corrompue
        header('Location: index.php?page=connexion&error=invalid_user');
        exit;
    }

    // Récupérer le nom du département
    if ($candidate->departement_user) {
        $departementRepo = new DepartementRepository();
        // On pourrait ajouter une méthode findById dans DepartementRepository
        // Pour l'instant, on récupère tous les départements et on cherche
        $departements = $departementRepo->getAllDepartements();
        foreach ($departements as $dep) {
            if ($dep->id_dep == $candidate->departement_user) {
                $departementName = $dep->Name;
                break;
            }
        }
    }

} catch (Exception $e) {
    $message = '<div class="error">Une erreur est survenue: ' . htmlspecialchars($e->getMessage()) . '</div>';
    // Optionnel : détruire la session si une erreur grave survient
    // session_destroy();
    // header('Location: connexion.php?error=data_retrieval');
    // exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Jeu-Concours</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- <div class="container"> Supprimé -->
        <h1>Mon Profil</h1>

        <?= $message ?>

        <?php if ($candidate): ?>
            <p><strong>Nom :</strong> <?= htmlspecialchars($candidate->lastname_user) ?></p>
            <p><strong>Prénom :</strong> <?= htmlspecialchars($candidate->firstname_user) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($candidate->mail_user) ?></p>
            <p><strong>Département :</strong> <?= htmlspecialchars($departementName) ?> (ID: <?= htmlspecialchars($candidate->departement_user) ?>)</p>
            <p><strong>Âge :</strong> <?= htmlspecialchars($candidate->age_user) ?></p>
            
            <hr>
            <p><a href="index.php?page=modifier_profil" class="btn btn-primary">Modifier mes informations</a></p>
            <p><a href="index.php?page=logout" class="btn btn-danger">Se déconnecter</a></p>
        <?php else: ?>
            <p>Impossible de charger les informations du profil.</p>
        <?php endif; ?>
    <!-- </div> Supprimé -->
</body>
</html>