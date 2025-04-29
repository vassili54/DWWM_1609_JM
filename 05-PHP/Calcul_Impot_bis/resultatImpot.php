<?php 
// Inclure le fichier de la classe Contribuable
require_once 'Contribuable.php';
?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat Impôt</title>
</head>
<body>
    <h1>Résultat du calcul de l'impôt</h1>

    <div class="result">
        <?php
        // Vérifier si les données attendues ont été soumises via GET
        if (isset($_GET['nom']) && !empty($_GET['nom']) && isset($_GET['revenu']) && $_GET['revenu'] !== '') {
          
            // Récupérer et nettoyer (basique) les données
            $nom = htmlspecialchars($_GET['nom']); // Empêche les attaques XSS basiques
            $revenu = floatval($_GET['revenu']);  // Convertit en nombre décimal

            // Vérifier si le revenu est un nombre valide et non négatif après conversion
            if ($revenu >= 0) {
                // Instancier la classe Contribuable
                $contribuable = new Contribuable($nom, $revenu);

                // Calculer l'impôt en utilisant la méthode de l'objet
                $montantImpot = $contribuable->calculerImpot();

                // Afficher le résultat au format demandé
                // Utilisation de number_format pour afficher le montant avec 2 décimales
                echo "<p>Mr/Mme " . $contribuable->getNom() . " votre impôt est de " . number_format($montantImpot, 2, ',', '') . " euros.</p>";

            } else {
                echo "<p style='color: red;'>Erreur : Veuillez saisir un revenu annuel valide et non négatif.</p>";
            }
        } else {
            // Si les données ne sont pas présentes (accès direct au fichier, par exemple)
            echo "<p style='color: orange;'>Aucune donnée de formulaire reçue. Veuillez utiliser le formulaire sur la page d'accueil.</p>";
            echo "<p><a href='index.php'>Retour au formulaire</a></p>";
        }
        ?>
    </div>
    
</body>
</html>