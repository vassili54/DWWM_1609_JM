// Fonction pour afficher la date et l'heure actuelles
function showCurrentDate() {
    const currentDateInput = document.getElementById('CurrentDate');
    const currentTimeInput = document.getElementById('CurrentTime');
    const dateTimeDisplay = document.getElementById('dateTimeDisplay');

    const now = new Date();

    // Définir la date actuelle dans le champ date
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, '0'); // Les mois sont indexés de 0 à 11
    const day = now.getDate().toString().padStart(2, '0');
    currentDateInput.value = `${year}-${month}-${day}`;

    // Définir l'heure actuelle dans le champ time
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    currentTimeInput.value = `${hours}:${minutes}`;

    // Afficher la date et l'heure dans le paragraphe
    dateTimeDisplay.innerHTML = `Aujourd'hui nous sommes le : <span class="blue-text">${currentDateInput.value}</span>, l'heure courante est : <span class="blue-text">${currentTimeInput.value}</span>`;
}