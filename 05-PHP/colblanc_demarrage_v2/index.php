<?php
// index.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Utilisez __DIR__ pour les chemins absolus
require_once __DIR__ . '/dao/Dbconnect.php';
require_once __DIR__ . '/dao/InstRepository.php';
require_once __DIR__ . '/autoload.php';

$instRepository = new InstRepository();

// Gestion des paramètres
$selectedDepartement = $_GET['departement'] ?? '';
$selectedTypes = $_GET['choix'] ?? [];

// Récupération des données
$institutions = (!empty($selectedDepartement))
  ? $instRepository->searchByDepartementAndType($selectedDepartement, $selectedTypes)
  : $instRepository->selectAll();

$departements = $instRepository->getAllDepartements();
?>


<!doctype html>
<html lang="fr-FR">

<head>
  <meta charset="utf-8">
  <title>Entrainement Centre de Readaptation</title>
  <link rel="stylesheet" media="screen" href="css/style.css">
</head>

<body>

  <div id="page">
    <div id="header">
      <img src="contenu/header.jpg" width="980" height="176" alt="colblanc entete">
    </div>

    <div id="menu">
      <ul>
        <li><a href="#">Entreprises</a>
          <ul>
            <li><a href="#" target="_self">Visualiser</a>
            </li>
            <li><a href="filtre.php">Rechercher</a>
            </li>
            <li><a href="#">Ajouter</a>
            </li>
          </ul>
        </li>
        <li><a href="#">Candidats</a>
          <ul>
            <li><a href="#" target="_self">Listing</a>
            </li>
            <li><a href="#">rechercher</a>
            </li>
            <li><a href="#">Ajouter</a>
            </li>
            <li><a href="#">CVthèque</a>
            </li>
          </ul>
        </li>
        <li><a href="#">Projets</a>

        </li>
        <li><a href="#">offres</a>
          <ul>

            <li><a href="#">Par secteur</a>

            </li>

            <li><a href="#">Par entreprises</a>

            </li>
          </ul>
        </li>
      </ul>
    </div>


    <main>
      <section>
        <form method="get">
          <div class="form-layout-container">
            <div class="filter-column">
              <div class="form-group department-group">
                <label for="departement">Choisir votre département :</label>
                <select name="departement" id="departement">
                  <option value="">Tous les départements</option>
                  <?php foreach ($departements as $dep): ?>
                    <option value="<?= $dep['id_dep'] ?>" <?= $selectedDepartement == $dep['id_dep'] ? 'selected' : '' ?>>
                      <?= htmlspecialchars($dep['dep_name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group establishment-type-group">
                <h3>Sélectionner votre type d'établissement :</h3>
                <div class="checkbox-list">
                  <?php
                  $types_etab = [
                    'TPE',
                    'PME',
                    'GRANDE ENTREPRISE',
                    'COLLECTIVITE TER',
                    'ASSOCIATION',
                    'AUTRES (secteur public)'
                  ];

                  foreach ($types_etab as $type) {
                    $checked = (in_array($type, $selectedTypes)) ? 'checked' : '';
                    echo '<div class="checkbox-item">';
                    echo '<input type="checkbox" name="choix[]" id="' . htmlspecialchars($type) . '" value="' . htmlspecialchars($type) . '" ' . $checked . '>';
                    echo '<label for="' . htmlspecialchars($type) . '">' . htmlspecialchars($type) . '</label>';
                    echo '</div>'; // Fin checkbox-item
                  }
                  ?>
                </div>
              </div>

              <div class="action-buttons-container">
                <button type="button" onclick="window.print()">Imprimer</button>
                <button type="submit">Valider</button>
              </div>
            </div>
            <div class="results-title-column">
              <h1 class="results-page-title">Résultat de la recherche : <?php echo count($institutions); ?></h1>
            </div>

          </div>
        </form>
        <table class="results-table">
          <thead>
            <tr>
              <th>Nom de l'établissement</th>
              <th>Type d'établissement</th>
              <th>Nom du responsable</th>
              <th>Adresse</th>
              <th>Code Postal</th>
              <th>Ville</th>
              <th>Téléphone</th>
              <th>E-mail</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($institutions as $institution): ?>
              <tr>
                <td><?= htmlspecialchars($institution['nom_etab'] ?? '') ?></td>
                <td><?= htmlspecialchars($institution['type_etab'] ?? '') ?></td>
                <td><?= htmlspecialchars($institution['nom_resp'] ?? '') ?></td>
                <td><?= htmlspecialchars($institution['adresse'] ?? '') ?></td>
                <td><?= htmlspecialchars($institution['cp'] ?? '') ?></td>
                <td><?= htmlspecialchars($institution['ville'] ?? '') ?></td>
                <td><?= htmlspecialchars($institution['Telephone'] ?? '') ?></td>
                <td>
                  <?php if (!empty($institution['email'])): ?>
                    <a href="mailto:<?= htmlspecialchars($institution['email']) ?>">
                      <?= htmlspecialchars($institution['email']) ?>
                    </a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>


        </table>

        <aside>
        </aside>


      </section>
    </main>


    <footer>
      ©2025 CRM Mulhouse. Tous droits réservés
    </footer>
  </div>
</body>

</html>