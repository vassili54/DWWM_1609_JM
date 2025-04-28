<?php
//-------------------Serie 6A-------------------
/**
 * Retourne et affiche la date du jour au format j/m/Y
 * 
 * @return string La date formatée (ex: "25/04/2025")
 */
function getToday(): string {
    // Crée un objet DateTime pour la date actuelle
    $today = new DateTime('now', new DateTimeZone('Europe/Paris')); // Pour être explicite sur le fuseau horaire
    // Formatage de la date au format "j/m/Y"
    $formattedDate = $today->format('d/m/Y');
    // Affichage de la date (comme demandé)
    echo $formattedDate . "\n";
    // Retourne la valeur
    return $formattedDate;
}

// Test de la fonction
$todayDate = getToday();  // Affiche et retourne la date du jour

//-------------------Serie 6B-------------------

/**
 * Calcule le temps restant avant une date donnée
 * 
 * @param string $inputDate Date au format Y-m-d
 * @return string Message formaté
 */
function getTimeLeft(string $inputDate): string {
    // Vérification du format de date
    $date = DateTime::createFromFormat('Y-m-d', $inputDate);
    if (!$date || $date->format('Y-m-d') !== $inputDate) {
        return 'Date invalide';
    }

    $today = new DateTime();
    $diff = $today->diff($date);
    
    // Date dans le passé
    if ($diff->invert) {
        return 'Évènement passé';
    }
    
    // Date aujourd'hui
    if ($diff->days === 0) {
        return 'Aujourd\'hui';
    }
    
    // Calcul des différences
    $years = $diff->y;
    $months = $diff->m;
    $days = $diff->d;
    
    // Construction du message
    if ($years > 0) {
        $message = "Dans $years an" . ($years > 1 ? 's' : '');
        if ($months > 0) {
            $message .= " et $months mois";
        }
        return $message;
    }
    
    if ($months > 0) {
        $message = "Dans $months mois";
        if ($days > 0) {
            $message .= " et $days jour" . ($days > 1 ? 's' : '');
        }
        return $message;
    }
    
    return "Dans $days jour" . ($days > 1 ? 's' : '');
}

// Tests (avec date du jour = 2025-04-25)
echo getTimeLeft('2025-04-24') . "\n"; // Evènement passé
echo getTimeLeft('2025-04-25') . "\n"; // Aujourd'hui
echo getTimeLeft('2025-05-11') . "\n"; // Dans 16 jours
echo getTimeLeft('2025-09-11') . "\n"; // Dans 4 mois et 17 jours
echo getTimeLeft('2026-08-25') . "\n"; // Dans 1 an et 4 mois
echo getTimeLeft('2028-02-25') . "\n"; // Dans 2 ans et 9 mois
echo getTimeLeft("2020-02-29") . "\n";  // Date invalide (2020 n'est pas bissextile)
?>