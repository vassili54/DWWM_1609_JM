<?php
require_once __DIR__.'/src/Dbconnect.php';
require_once __DIR__.'/src/Repositories/CandidateRepository.php';
require_once __DIR__.'/src/Repositories/DepartementRepository.php';

// Fonction pour afficher les candidats dans un tableau HTML
function displayCandidatesTable($candidates) {
    echo '<h2>Liste des candidats inscrits</h2>';
    echo '<table border="1" cellpadding="5" cellspacing="0" style="width:100%;border-collapse:collapse;">';
    echo '<thead><tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Département</th>
            <th>Âge</th>
            <th>Mot de passe (hashé)</th>
          </tr></thead>';
    echo '<tbody>';
    
    foreach ($candidates as $candidate) {
        echo '<tr>';
        echo '<td>'.htmlspecialchars($candidate->id_user ?? '').'</td>';
        echo '<td>'.htmlspecialchars($candidate->lastname_user ?? '').'</td>';
        echo '<td>'.htmlspecialchars($candidate->firstname_user ?? '').'</td>';
        echo '<td>'.htmlspecialchars($candidate->mail_user ?? '').'</td>';
        echo '<td>'.htmlspecialchars($candidate->departement_user ?? '').'</td>';
        echo '<td>'.htmlspecialchars($candidate->age_user ?? '').'</td>';
        echo '<td style="max-width:200px;word-wrap:break-word;">'.htmlspecialchars($candidate->pass_user ?? '').'</td>';
        echo '</tr>';
    }
    
    echo '</tbody></table>';
}

// Affichage de la page
echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisation des candidats</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #f2f2f2; text-align: left; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .controls { margin: 20px 0; }
    </style>
</head>
<body>
    <h1>Visualisation des inscriptions</h1>
    <div class="controls">
        <form method="GET">
            <input type="submit" name="refresh" value="Actualiser">
            <input type="number" name="limit" value="'.($_GET['limit'] ?? 1000).'" min="1" max="5000">
            <label for="limit">enregistrements</label>
        </form>
    </div>';

try {
    $db = Dbconnect::getInstance()->getPDO();
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 1000;
    
    // Requête pour récupérer les candidats
    $stmt = $db->prepare("SELECT * FROM candidats ORDER BY id_user DESC LIMIT :limit");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $candidates = $stmt->fetchAll();
    
    // Afficher le tableau
    displayCandidatesTable($candidates);
    
    // Statistiques
    $count = count($candidates);
    echo "<p>Affichage de $count enregistrement(s)</p>";
    
} catch (Exception $e) {
    echo '<div style="color:red;padding:10px;border:1px solid red;">';
    echo '<strong>Erreur :</strong> '.htmlspecialchars($e->getMessage());
    echo '</div>';
}

echo '</body></html>';
?>