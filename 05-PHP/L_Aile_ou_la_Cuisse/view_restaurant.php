/* <?php
require_once './RestoRepository.php';

try {
    // Vérifier si un ID est passé en paramètre
    $id = $_GET['id'] ?? null;
    
    if (!$id || !is_numeric($id)) {
        throw new Exception("ID de restaurant invalide");
    }

    // Récupérer le restaurant
    $repo = new RestoRepository();
    $restaurant = $repo->searchById($id);
    
    if (!$restaurant) {
        throw new Exception("Aucun restaurant trouvé avec cet ID");
    }

    // Affichage
    echo "<!DOCTYPE html>
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Restaurant ".htmlspecialchars($restaurant['nom'])."</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css'>
    </head>
    <body class='container py-4'>
        <h1 class='mb-4'><i class='bi bi-shop'></i> ".htmlspecialchars($restaurant['nom'])."</h1>
        
        <div class='table-responsive'>
            <table class='table table-bordered table-hover'>
                <tbody>
                    <tr>
                        <th class='w-25'><i class='bi bi-geo-alt'></i> Adresse</th>
                        <td>".htmlspecialchars($restaurant['adresse'])."</td>
                    </tr>
                    <tr>
                        <th><i class='bi bi-cash-coin'></i> Prix moyen</th>
                        <td>".number_format($restaurant['prix'], 2, ',', ' ')." €</td>
                    </tr>
                    <tr>
                        <th><i class='bi bi-star'></i> Note</th>
                        <td>
                            <span class='badge ".($restaurant['Note'] >= 8 ? 'bg-success' : ($restaurant['Note'] >= 5 ? 'bg-warning' : 'bg-danger'))."'>
                                ".$restaurant['Note']."/10
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class='bi bi-calendar'></i> Date de visite</th>
                        <td>".date('d/m/Y', strtotime($restaurant['visite']))."</td>
                    </tr>
                    <tr>
                        <th><i class='bi bi-chat-text'></i> Commentaire</th>
                        <td>".nl2br(htmlspecialchars($restaurant['Commentaire']))."</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <a href='index.php' class='btn btn-primary mt-3'>
            <i class='bi bi-arrow-left'></i> Retour à la liste
        </a>
    </body>
    </html>";

} catch (Exception $e) {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Erreur</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body class='container py-4'>
        <div class='alert alert-danger'>
            <i class='bi bi-exclamation-octagon'></i> ".htmlspecialchars($e->getMessage())."
        </div>
        <a href='index.php' class='btn btn-primary'>Retour</a>
    </body>
    </html>";
}
?>

*//