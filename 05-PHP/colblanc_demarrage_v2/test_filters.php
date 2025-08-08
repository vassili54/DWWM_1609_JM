<?php
require 'dao/Dbconnect.php';
require 'dao/InstRepository.php';

$repo = new InstRepository();

// Test 1: Aucun filtre
$results = $repo->selectAll();
echo "Sans filtre: ".count($results)." résultats<br>";

// Test 2: Filtre département seul
$results = $repo->searchByDepartementAndType(75, []);
echo "Département 75: ".count($results)." résultats<br>";

// Test 3: Filtre type seul
$results = $repo->searchByDepartementAndType('', ['PME']);
echo "Type PME: ".count($results)." résultats<br>";

// Test 4: Combinaison
$results = $repo->searchByDepartementAndType(75, ['PME']);
echo "Département 75 + PME: ".count($results)." résultats<br>";