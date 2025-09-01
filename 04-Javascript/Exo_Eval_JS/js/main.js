// On récupère les éléments HTML
const formulaire = document.querySelector('form');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirmPassword');
const texteErreur = document.querySelector('.texte_erreur');
const body = document.body;
const form = document.querySelector('.form'); // On sélectionne aussi le conteneur du formulaire

// On écoute la soumission du formulaire
formulaire.addEventListener('submit', (event) => {
    // On empêche la soumission par défaut pour que la page ne se recharge pas
    event.preventDefault();

    // On récupère les valeurs saisies
    const username = usernameInput.value;
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    // On efface les messages d'erreur précédents
    texteErreur.textContent = '';

    // retire la classe 'valide-theme' au début pour réinitialiser
    body.classList.remove('valide-theme');
    form.classList.remove('valide-theme');

    // -- Validation Nom d'utilisateur --
    if (username.length < 3) {
        texteErreur.textContent = "Le nom d'utilisateur doit avoir une longueur d'au moins 3 caractères.";
        return;
    }

    // -- Validation Longueur du mot de passe --
    if (password.length < 10) {
        texteErreur.textContent = 'Le mot de passe doit avoir une longueur minimum de 12 caractères.';
        return;
    }

    // -- Validation Les mots de passe sont-ils identiques ? --
    if (password !== confirmPassword) {
        texteErreur.textContent = 'Les mots de passe ne correspondent pas.';
        return;
    }

    // Si toutes les validations passent, on ajoute la classe 'valide-theme'
    body.classList.add('valide-theme');
    form.classList.add('valide-theme');
    
    // Affiche le message de succès
    texteErreur.textContent = 'Le formulaire est valide !';
    texteErreur.style.color = '#ffff00';

    // Créer et stocker les informations dans un objet littéral
    const userNew = {
        username: username,
        password: password
    };

    console.log(userNew);
});

// Initialisation du pied de page
const footer = document.querySelector('footer p');
footer.textContent = 'Copyright © 2025 Rocky Balbala';