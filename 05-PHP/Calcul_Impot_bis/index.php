<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Calcul impot</title>
</head>
<body>

    <h1>Calcul de l'impôt sur le revenu</h1>

    <form action="resultatImpot.php" method="GET">
        <label for="nom">Votre nom :</label>
        <input type="text" id="nom" name="nom" required maxlength="50">

        <label for="revenu">Votre revenu annuel (€) :</label>
        <input type="number" id="revenu" name="revenu" required step="0.01" min="0">

        <input type="submit" value="Calculer l'impôt" name="calcul">
    </form>

</body>

</html>