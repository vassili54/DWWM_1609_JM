// Fonction pour vérifier les entrées en temps réel
function checkInputs() {
    // Sélection des champs de formulaire
    var firstName = document.getElementById('firstName').value;
    var age = document.getElementById('age').value;
    var resultDIV = document.getElementById('result');
    
    // Vérifie si le prénom est vide ou si l'âge n'est pas un entier valide supérieur à 0
    if (firstName.trim() === "" || age === "" || parseInt(age) <= 0) {
        // Affiche le message d'erreur
        resultDIV.innerHTML = '<p class="error">Compléter/corriger le formulaire.</p>';
        resultDIV.classList.add("error");
    } else {
        // Enlève le message d'erreur
        resultDIV.innerHTML = "";
        resultDIV.classList.remove("error");
    }
}

// Fonction pour valider le formulaire
function validateForm() {
    // Sélectionnez les champs de formulaire
    var firstName = document.getElementById('firstName').value;
    var age = document.getElementById('age').value;
    var resultDIV = document.getElementById('result');
    
    // Vérifiez si le prénom n'est pas vide et si l'âge est un entier valide supérieur à 0
    if (firstName.trim() !== "" && age !== "" && parseInt(age) > 0) {
        // Détermine si la personne est majeure ou mineure
        const message = parseInt(age) >= 18 ? 'La personne est majeure.' : 'La personne est mineure.';
        
        // Affiche le message de bienvenue avec le prénom, l'âge et le statut (majeur/mineur)
        resultDIV.innerHTML = `
            <p>Bonjour ${firstName}, votre âge est : ${age}.</p>
            <p>${message}</p>
        `;
        resultDIV.classList.remove("error");
    } else {
        // Affichez un message d'erreur
        resultDIV.innerHTML = '<p class="error">Compléter/corriger le formulaire.</p>';
        resultDIV.classList.add("error");
    }
}

// Fonction pour vider le formulaire
function resetForm() {
    console.log("Réinitialisation du formulaire...");
    // Réinitialise le formulaire
 
    document.getElementById('firstName').value = '';
    document.getElementById('age').value = '';
    // Videz également le bloc résultat
    var resultDIV = document.getElementById('result');
    resultDIV.innerHTML = '';
    resultDIV.classList.remove("error");
}

// Ajouter des événements pour vérifier les entrées en temps réel
document.getElementById('firstName').addEventListener('input', checkInputs);
document.getElementById('age').addEventListener('blur', checkInputs);

// Ajouter des événements pour les boutons
document.getElementById('btnvalid').addEventListener('click', function(e) {
    e.preventDefault(); // Empêche la soumission du formulaire
    validateForm(); // Appelle la fonction de validation
});

document.getElementById('btnvide').addEventListener('click', function(e) {
    e.preventDefault(); // Empêche la soumission du formulaire
    resetForm(); // Appelle la fonction pour vider le formulaire
});