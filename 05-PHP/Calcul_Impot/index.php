<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Calcul impot</title>
</head>
<body>
    <form action="#" method="GET" enctype="text/plain">
        <label for="nom"> Votre nom :</label>
        <input type="text" maxlength="50" name="nom" id="nom" required><br>
        <label for="revenu">Salaire annuel :</label>
        <input type="number" name="revenu" id="revenu" step="0.01" required><br>
        <input type="submit" value="Calculer" name="calcul" id="calcul"><br>
        <label for="impot"> montant de l'impôt sur le revenu</label><br>
        <input type="text" name="impot" id="impot" readonly size="10">
    </form>
    
</body>

<?php

const TAUX_REDUIT=0.09;
const TAUX_MAX=0.14;

function calculerImpot( float $_salaire ):float 
{
    $montant= 0.01;
    if ($_salaire<=15000) {
        $montant= $_salaire*TAUX_REDUIT;
    }
    else {
        $tranche1 = 15000*TAUX_REDUIT;
        $tranche2 = ($_salaire-15000)*TAUX_MAX;
        $montant=$tranche1+$tranche2;
    }
    return $montant;
}
if (isset($_GET["revenu"]) && !empty($_GET["revenu"])) {
    $montantImpot= calculerImpot(floatval($_GET["revenu"]));
    echo "votre impot sur le revenu est de : ".$montantImpot. "€";
}

?>

</html>