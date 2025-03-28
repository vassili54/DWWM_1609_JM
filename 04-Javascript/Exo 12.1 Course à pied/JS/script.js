document.addEventListener('DOMContentLoaded', function() {
    const courseDiv = document.querySelector('.course');
    const existingTable = courseDiv.querySelector('table');
    const tbody = document.createElement('tbody');

    // Fonction pour créer et remplir le tableau avec les données
    function populateTable(courseData) {
        // Créer l'élément thead s'il n'existe pas déjà
        if (!existingTable.querySelector('thead')) {
            const thead = document.createElement('thead');
            const headerRow = document.createElement('tr');
            const headers = ["Pays", "Nom", "Prénom", "Temps final"];
            headers.forEach(headerText => {
                const th = document.createElement('th');
                th.textContent = headerText;
                headerRow.appendChild(th);
            });
            thead.appendChild(headerRow);
            existingTable.appendChild(thead);
        }

        // Trier les participants par temps
        courseData.sort((a, b) => a.temps - b.temps);

        // Vider le tbody s'il contient déjà des lignes
        tbody.innerHTML = '';

        courseData.forEach((participant, index) => {
            const row = document.createElement('tr');
            const paysCell = document.createElement('td');
            paysCell.textContent = participant.pays;
            
            // Séparer le nom complet en nom et prénom
            const fullName = participant.nom;
            const nameParts = fullName.split(' '); // Split par espace

            let prenom = '';
            let nom = '';

            if (nameParts.length > 1) {
                nom = nameParts.slice(0, -1).join(' '); // Assumer que tout sauf le dernier mot est le nom de famille
                prenom = nameParts.slice(-1).join(' '); // Assumer que le dernier mot est le prénom
            } else if (nameParts.length === 1) {
                nom = nameParts[0]; // Si un seul mot, l'assigner au nom de famille (vous pouvez ajuster cette logique)
            }
    
            const nomCell = document.createElement('td');
            nomCell.textContent = nom;
            const prenomCell = document.createElement('td');
            prenomCell.textContent = prenom;

            const tempsEnSecondes = participant.temps;
            const minutes = Math.floor(tempsEnSecondes / 60);
            const secondes = tempsEnSecondes % 60;

            // Formater les minutes et les secondes pour avoir toujours 2 chiffres
            const minutesFormattees = minutes < 10 ? '0' + minutes : minutes;
            const secondesFormattees = secondes < 10 ? '0' + secondes : secondes;

            const tempsCell = document.createElement('td');
            tempsCell.textContent = `${minutesFormattees}min${secondesFormattees}s`;

            row.appendChild(paysCell);
            row.appendChild(nomCell);
            row.appendChild(prenomCell);
            row.appendChild(tempsCell);
            tbody.appendChild(row);
        });

        existingTable.appendChild(tbody);
    }

    // Utiliser fetch pour récupérer les données depuis data.json
    fetch('./data/resultat10000metres.json')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            populateTable(data);

            // Afficher le gagnant dans l'input "nomGagnant"
            const nomGagnantInput = document.getElementById('nomGagnant');
            if (data.length > 0) {
                nomGagnantInput.value = `Gagnant : ${data[0].nom}`;
            }

            // Afficher le nombre de participants dans l'input "nbParticipants"
            const nbParticipantsInput = document.getElementById('nbParticipants');
            nbParticipantsInput.value = `${data.length} participants`;
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données:', error);
            // Vous pouvez afficher un message d'erreur à l'utilisateur ici si nécessaire
        });
});