<?php
// generate_hashes.php
// Ce script génère des hashes pour les mots de passe des scientifiques
// A utiliser une seule fois puis supprimer après usage
$options = [
    'memory_cost' => 65536,
    'time_cost' => 4,
    'threads' => 2
];

$hashes = [
    'Espadon25' => password_hash('Espadon25', PASSWORD_ARGON2ID, $options),
    'Chateau46' => password_hash('Chateau46', PASSWORD_ARGON2ID, $options)
];

echo "UPDATE scientists SET pass_scientist = '".$hashes['Espadon25']."' WHERE mail_scientist = 'p.mortimer@mifivesec.eu';\n";
echo "UPDATE scientists SET pass_scientist = '".$hashes['Chateau46']."' WHERE mail_scientist = 'f.blake@mifivesec.eu';";
?>