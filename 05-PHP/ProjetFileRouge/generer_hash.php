<?php
// generer_hash.php
$motDePassePourAdmin = 'admin123'; // Le mot de passe que vous utiliserez pour vous connecter
$hachageDuMotDePasse = password_hash($motDePassePourAdmin, PASSWORD_DEFAULT);
echo "Le hachage pour '{$motDePassePourAdmin}' est : <br>";
echo "<strong>" . $hachageDuMotDePasse . "</strong>";
