// Attendre que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', function() {
    // Créer l'élément div pour l'encadré
    const cadreDiv = document.createElement('div');
    cadreDiv.classList.add('evaluation'); // Ajouter la classe 'evaluation'

    // Créer l'élément de titre
    const titreH1 = document.createElement('h1');
    titreH1.textContent = "Résultat de l'évaluation"; // Définir le texte du titre

    // Ajouter le titre à l'encadré
    cadreDiv.appendChild(titreH1);

    // Créer l'élément de tableau
    const tableau = document.createElement('table');

    // Créer l'en-tête du tableau (thead)
    const thead = document.createElement('thead');
    const headerRow = document.createElement('tr');
    const nomHeader = document.createElement('th');
    nomHeader.textContent = "Nom";
    const prenomHeader = document.createElement('th');
    prenomHeader.textContent = "Prénom";
    const noteHeader = document.createElement('th');
    noteHeader.textContent = "Note";
    headerRow.appendChild(nomHeader);
    headerRow.appendChild(prenomHeader);
    headerRow.appendChild(noteHeader);
    thead.appendChild(headerRow);
    tableau.appendChild(thead);

    // Créer le corps du tableau (tbody)
    const tbody = document.createElement('tbody');
    tableau.appendChild(tbody);

    // Ajouter le tableau à l'encadré
    cadreDiv.appendChild(tableau);

    // Ajouter l'encadré au corps de la page
    document.body.appendChild(cadreDiv);

    fetch("./data/eval.json")
        .then(response => response.json()) // Convertir la réponse en JSON
        .then(data => {
            // Maintenant, 'data' contient votre tableau JSON
            // Vous pouvez parcourir ce tableau et créer des lignes de tableau pour chaque personne
            data.forEach(personne => {
                const row = document.createElement('tr');

                // Séparer le nom complet en prénom et nom
                const parts = personne.fullname.split(' ');
                const prenom = parts[0];
                const nom = parts.slice(1).join(' '); // Récupérer le reste comme nom

                const nomCell = document.createElement('td');
                nomCell.textContent = nom;
                const prenomCell = document.createElement('td');
                prenomCell.textContent = prenom;
                const noteCell = document.createElement('td');
                noteCell.textContent = personne.grade;

                row.appendChild(nomCell);
                row.appendChild(prenomCell);
                row.appendChild(noteCell);
                tbody.appendChild(row);
            });

            // Calculer les statistiques
            const nombreEtudiants = data.length;
            let sommeNotes = 0;
            data.forEach(personne => {
                sommeNotes += personne.grade;
            });
            const noteMoyenne = nombreEtudiants > 0 ? sommeNotes / nombreEtudiants : 0;
            let nombreAuDessusMoyenne = 0;
            data.forEach(personne => {
                if (personne.grade > noteMoyenne) {
                    nombreAuDessusMoyenne++;
                }
            });
            
            // Créer les éléments pour afficher les statistiques











        })
        .catch(error => {
            console.error("Erreur lors de la récupération du JSON:", error);
            const erreurMessage = document.createElement('p');
            erreurMessage.textContent = "Erreur lors du chargement des données.";
            cadreDiv.appendChild(erreurMessage);
        });
});