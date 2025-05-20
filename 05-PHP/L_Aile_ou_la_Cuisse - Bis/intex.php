<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Restaurants - Laragon</title>
    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <!-- En-tête -->
    <header class="restaurant-header">
        <div class="container text-center">
            <h1 class="display-4 fw-bold"><i class="bi bi-egg-fried"></i> Guide Restaurants</h1>
            <p class="lead">Les meilleures tables de Colmar</p>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="container">
        <!-- Bouton d'action -->
        <div class="d-flex justify-content-end mb-4">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRestaurantModal">
                <i class="bi bi-plus-circle"></i> Ajouter un restaurant
            </a>
        </div>

        <!-- Grille des restaurants -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php
            // Connexion à la base avec Laragon (paramètres par défaut)
            try {
                $db = new PDO('mysql:host=localhost;dbname=Guide;charset=utf8mb4', 'root', '');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Correction ici

                // Requête avec gestion des erreurs
                $query = "SELECT * FROM restaurants ORDER BY Note DESC";
                $stmt = $db->query($query);
                
                if ($stmt->rowCount() > 0) {
                    while ($restaurant = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $visitDate = date('d/m/Y', strtotime($restaurant['visite']));
                        $ratingColor = $restaurant['Note'] >= 8 ? 'bg-success' : ($restaurant['Note'] >= 5 ? 'bg-warning' : 'bg-danger');
                        
                        echo '
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span class="badge ' . $ratingColor . '">' . $restaurant['Note'] . '/10</span>
                                    <span class="price-tag">' . number_format($restaurant['prix'], 2, ',', ' ') . ' €</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($restaurant['nom']) . '</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        <i class="bi bi-geo-alt"></i> ' . htmlspecialchars($restaurant['adresse']) . '
                                    </h6>
                                    <p class="card-text">' . nl2br(htmlspecialchars($restaurant['Commentaire'])) . '</p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <small class="text-muted">Visité le: ' . $visitDate . '</small>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo '<div class="col-12"><div class="alert alert-info">Aucun restaurant à afficher pour le moment.</div></div>';
                }
            } catch(PDOException $e) {
                echo '<div class="col-12"><div class="alert alert-danger">Erreur de connexion: ' . $e->getMessage() . '</div></div>';
            }
            ?>
        </div>
    </main>

    <!-- Modal d'ajout (structure de base) -->
    <div class="modal fade" id="addRestaurantModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un restaurant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Formulaire d'ajout à implémenter...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    <footer class="mt-5 py-3 bg-light">
        <div class="container text-center">
            <p class="mb-0">© <?php echo date('Y'); ?> Guide Restaurants - Colmar</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>