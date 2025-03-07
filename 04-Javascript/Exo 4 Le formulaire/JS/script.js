// Fonction pour calculer l'âge
function calculateAge() {
    console.log("Calcul de l'âge en cours...");
    // Sélectionnez les champs de formulaire
    var birthdate = document.getElementById('birthdate').value;
    var resultDIV = document.getElementById('result');
    
    // Vérifiez si une date a été saisie
    if (!birthdate) {
        resultDIV.innerHTML = '<p class="error">Veuillez saisir une date de naissance.</p>';
        return;
    }
    // Convertir la date de naissance en objet Date
    var birthDate = new Date(birthdate);
    var today = new Date();

    // Vérifiez si la date est dans le futur
    if (birthDate > today) {
        resultDIV.innerHTML = '<p class="error">La date de naissance ne peut pas être dans le futur.</p>';
        return;
    }

    // Formater la date au format français (jj/mm/aaaa)
    const day = String(birthDate.getDate()).padStart(2, '0'); // Jour sur 2 chiffres
    const month = String(birthDate.getMonth() + 1).padStart(2, '0'); // Mois sur 2 chiffres
    const year = birthDate.getFullYear(); // Année sur 4 chiffres
    const hours = String(birthDate.getHours()).padStart(2, '0'); // Heures sur 2 chiffres
    const minutes = String(birthDate.getMinutes()).padStart(2, '0'); // Minutes sur 2 chiffres
    const formattedDateTime = `${day}/${month}/${year} à ${hours}:${minutes}`; // Format français 

    // Calculer l'âge 
    var age = today.getFullYear() - birthDate.getFullYear();
    var monthDifference = today.getMonth() - birthDate.getMonth();

    // Ajuster l'âge si l'anniversaire n'est pas encore passé cette année
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    // Calculer le signe astrologique
    var zodiacSign = getZodiacSign(birthDate.getMonth() + 1, birthDate.getDate());

    // Afficher le résultat
    resultDIV.innerHTML = `
        <p>Vous êtes né(e) le <span class="blue-text">${formattedDateTime}</span>.</p>
        <p>Il s'est écoulé <span class="blue-text">${age}</span> années depuis votre naissance.</p>
        <p>Votre signe astrologique est : <span class="blue-text">${zodiacSign}</span>.</p>
    `;
}

// Fonction pour obtenir le signe astrologique
function getZodiacSign(month, day) {
    var sign = "";
    if ((month == 1 && day <= 20) || (month == 2 && day <= 18)) {
        sign = "Verseau";
    } else if ((month == 2 && day >= 19) || (month == 3 && day <= 20)) {
        sign = "Poissons";
    } else if ((month == 3 && day >= 21) || (month == 4 && day <= 19)) {
        sign = "Bélier";
    } else if ((month == 4 && day >= 20) || (month == 5 && day <= 20)) {
        sign = "Taureau";
    } else if ((month == 5 && day >= 21) || (month == 6 && day <= 20)) {
        sign = "Gémeaux";
    } else if ((month == 6 && day >= 21) || (month == 7 && day <= 22)) {
        sign = "Cancer";
    } else if ((month == 7 && day >= 23) || (month == 8 && day <= 22)) {
        sign = "Lion";
    } else if ((month == 8 && day >= 23) || (month == 9 && day <= 22)) {
        sign = "Vierge";
    } else if ((month == 9 && day >= 23) || (month == 10 && day <= 22)) {
        sign = "Balance";
    } else if ((month == 10 && day >= 23) || (month == 11 && day <= 21)) {
        sign = "Scorpion";
    } else if ((month == 11 && day >= 22) || (month == 12 && day <= 21)) {
        sign = "Sagittaire";
    } else if ((month == 12 && day >= 22) || (month == 1 && day <= 19)) {
        sign = "Capricorne";
    }
    return sign;                        
}

// Ajouter un événement au bouton "Calculer"
document.getElementById('btnCalculer').addEventListener('click', function(e) {
    e.preventDefault(); // Empêcher la soumission du formulaire
    calculateAge(); // Appelle la fonction de calcul
});

