// Récupérer le champ de l'identifiant
const usernameInput = document.getElementById('username');

// Fonction pour charger le fichier JSON et générer l'identifiant
async function loadUserData() {
    try {
        // Charger le fichier JSON
        const Response = await fetch('./JS/data.json'); // Chemin vers votre fichier JSON
        if (!Response.ok) {
            throw new Error('Erreur lors du chargement du fichier JSON');
        }

        // Convertir la réponse en objet JavaScript
        const userData = await Response.json();

        // Extraire le nom et le prénom
        const nom = userData.nom.toLowerCase();
        const prenom = userData.prenom.toLowerCase();

        // Générer l'identifiant
        const identifiant = `${prenom}.${nom}`;

        // Afficher l'identifiant dans le champ
        usernameInput.value = identifiant;
    } catch (error) {
        console.error('Erreur:', error);
        usernameInput.value = 'Erreur de chargement'; // Afficher un message d'erreur
    }
    
}

// Appeler la fonction au chargement de la page
window.addEventListener('load', loadUserData);