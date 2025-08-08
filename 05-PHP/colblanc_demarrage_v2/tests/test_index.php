<?php
//tests/test_index.php

require_once '../dao/Dbconnect.php'; // Inclure la classe Dbconnect
require_once '../dao/InstRepository.php'; // Inclure le dépôt d'institutions

// Initialiser la connexion à la base de données
$pdo=Dbconnect::getInstance()->getPdo(); // Appel de la méthode statique pour obtenir l'instance unique de Dbconnect
// var_dump($pdo); // Afficher l'objet PDO pour vérifier la connexion

$instRepository = new InstRepository(); // Créer une instance du dépôt d'institutions
// $tableauInstitutions = $instRepository->selectAll(); // Récupérer toutes les institutions
// echo "<pre>" ;

// var_export($tableauInstitutions);
// "</pre>"; // Afficher le tableau des institutions

$institutions = $instRepository->selectAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Institutions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            position: sticky;
            top: 0;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Liste des Institutions (<?php echo count($institutions); ?> résultats)</h1>
    
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Responsable</th>
                <th>Adresse</th>
                <th>Code Postal</th>
                <th>Téléphone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($institutions as $institution): ?>
                <tr>
                    <td><?php echo htmlspecialchars($institution['nom_etab'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($institution['type_etab'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($institution['nom_resp'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($institution['adresse'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($institution['cp'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($institution['Telephone'] ?? ''); ?></td>
                    <td>
                        <?php if (!empty($institution['email'])): ?>
                            <a href="mailto:<?php echo htmlspecialchars($institution['email']); ?>">
                                <?php echo htmlspecialchars($institution['email']); ?>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>