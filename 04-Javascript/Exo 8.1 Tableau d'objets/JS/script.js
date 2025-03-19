// Récupérer le champ de l'identifiant et le bouton de connexion
const usernameInput = document.getElementById('username');
const btnConnexion = document.querySelector('button');

// Fonction pour charger le fichier JSON et vérifier l'identifiant
async function loadUserData() {
    try {
        // Charger le fichier JSON
        const response = await fetch('./JS/data.json'); // Chemin vers votre fichier JSON
        if (!response.ok) {
            throw new Error('Erreur lors du chargement du fichier JSON');
        }

        // Convertir la réponse en objet JavaScript
        const userData = await response.json();

        // Fonction pour vérifier l'identifiant
        function verifierIdentifiant() {
            const monId = usernameInput.value.toLowerCase(); // Récupérer et normaliser l'identifiant saisi
            for (let index = 0; index < userData.length; index++) {
                const prenom = userData[index].firstname.toLowerCase();
                const nom = userData[index].lastname.toLowerCase();
                const inscritId = `${prenom}.${nom}`; // Créer l'identifiant attendu
                if (monId === inscritId) {
                    return true; // Identifiant valide
                }
            }
            return false; // Identifiant invalide
        }

        // Fonction pour vérifier le mot de passe (à compléter selon vos besoins)
        function verifierMotPass(index) {
            // Exemple simple : vérifier si le mot de passe saisi correspond à celui dans le JSON
            const passwordInput = document.getElementById('password').value;
            return passwordInput === userData[index].password; // Assurez-vous que votre JSON contient un champ "password"
        }

        // Gérer l'événement de clic sur le bouton de connexion
        btnConnexion.addEventListener('click', () => {
            const identifiantValide = verifierIdentifiant();
            if (identifiantValide) {
                const index = userData.findIndex(user => `${user.firstname.toLowerCase()}.${user.lastname.toLowerCase()}` === usernameInput.value.toLowerCase());
                const motPassValide = verifierMotPass(index);
                if (motPassValide) {
                    alert('Connexion réussie !');
                } else {
                    alert('Mot de passe incorrect.');
                }
            } else {
                alert('Identifiant incorrect.');
            }
        });

    } catch (error) {
        console.error('Erreur:', error);
        usernameInput.value = 'Erreur de chargement'; // Afficher un message d'erreur
    }
}

// Appeler la fonction au chargement de la page
loadUserData();