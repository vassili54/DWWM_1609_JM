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

    // --- Ajouter le formulaire ici ---
    const etudiantForm = document.createElement('form');
    etudiantForm.id = 'etudiantForm';

    // Ajouter le titre au formulaire
    const titreFormulaire = document.createElement('h2');
    titreFormulaire.textContent = "Ajouter une note";
    etudiantForm.appendChild(titreFormulaire);

    const labelNomPrenom = document.createElement('label');
    labelNomPrenom.textContent = 'Nom Prénom :';
    const inputNomPrenom = document.createElement('input');
    inputNomPrenom.type = 'text';
    inputNomPrenom.id = 'fullname'; // ID unique pour le champ Nom Prénom
    inputNomPrenom.required = true;

    const labelNote = document.createElement('label');
    labelNote.textContent = 'Note (sur 20) :';
    const inputNote = document.createElement('input');
    inputNote.type = 'number';
    inputNote.id = 'note';
    inputNote.min = '0';
    inputNote.max = '20';
    inputNote.required = true;

    const submitButton = document.createElement('button');
    submitButton.type = 'submit';
    submitButton.textContent = 'Ajouter Étudiant';

    etudiantForm.appendChild(labelNomPrenom);
    etudiantForm.appendChild(inputNomPrenom);
    etudiantForm.appendChild(document.createElement('br')); // Saut de ligne (optionnel)
    etudiantForm.appendChild(labelNote);
    etudiantForm.appendChild(inputNote);
    etudiantForm.appendChild(document.createElement('br')); // Saut de ligne
    etudiantForm.appendChild(submitButton);

    cadreDiv.appendChild(etudiantForm);
    // --- Fin de l'ajout du formulaire ---

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
    const obtenuHeader = document.createElement('th');
    obtenuHeader.textContent = "Obtenu";
    headerRow.appendChild(nomHeader);
    headerRow.appendChild(prenomHeader);
    headerRow.appendChild(noteHeader);
    headerRow.appendChild(obtenuHeader);
    thead.appendChild(headerRow);
    tableau.appendChild(thead);

    // Créer le corps du tableau (tbody)
    const tbody = document.createElement('tbody');
    tableau.appendChild(tbody);

    // Ajouter le tableau à l'encadré
    cadreDiv.appendChild(tableau);

    // Ajouter l'encadré au corps de la page
    document.body.appendChild(cadreDiv);

    let dataEtudiants =; // Déclarer une variable pour stocker les données des étudiants

    fetch("./data/eval.json")
        .then(response => response.json())
        .then(data => {
            dataEtudiants = data; // Initialiser la variable avec les données fetchées
            afficherTableau(dataEtudiants, tbody);
            calculerEtAfficherStatistiques(dataEtudiants);
        })
        .catch(error => {
            console.error("Erreur lors de la récupération du JSON:", error);
            const erreurMessage = document.createElement('p');
            erreurMessage.textContent = "Erreur lors du chargement des données.";
            cadreDiv.appendChild(erreurMessage);
        });

    // Fonction pour afficher le tableau
    function afficherTableau(data, tbodyElement) {
        tbodyElement.innerHTML = ''; // Effacer le contenu précédent du tableau
        data.sort((a, b) => b.grade - a.grade);
        data.forEach(personne => {
            const row = document.createElement('tr');
            const prenom = personne.fullname.split(' ')[0];
            const nom = personne.fullname.split(' ').slice(1).join(' ');
            const nomCell = document.createElement('td');
            nomCell.textContent = nom;
            const prenomCell = document.createElement('td');
            prenomCell.textContent = prenom;
            const noteCell = document.createElement('td');
            noteCell.textContent = personne.grade;
            const obtenuCell = document.createElement('td');
            obtenuCell.textContent = personne.grade >= 12 ? "oui" : "Non";
            if (personne.grade < 12) {
                row.classList.add('failed');
            }
            row.appendChild(prenomCell);
            row.appendChild(nomCell);
            row.appendChild(noteCell);
            row.appendChild(obtenuCell);
            tbodyElement.appendChild(row);
        });
    }

    // Fonction pour calculer et afficher les statistiques
    function calculerEtAfficherStatistiques(data) {
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

        let statistiquesUl = document.getElementById('statistiques');
        if (!statistiquesUl) {
            statistiquesUl = document.createElement('ul');
            statistiquesUl.id = 'statistiques';
            document.body.appendChild(statistiquesUl);
        }
        statistiquesUl.innerHTML = ''; // Effacer les statistiques précédentes

        const nombreEtudiantsLi = document.createElement('li');
        nombreEtudiantsLi.textContent = `Nombre d’étudiants affichés dans le tableau : ${nombreEtudiants}`;
        const noteMoyenneLi = document.createElement('li');
        noteMoyenneLi.textContent = `Note moyenne : ${noteMoyenne.toFixed(2)}`;
        const nombreAuDessusMoyenneLi = document.createElement('li');
        nombreAuDessusMoyenneLi.textContent = `Nombre d’étudiants au dessus de la moyenne : ${nombreAuDessusMoyenne}`;
        const noteEliminatoireLi = document.createElement('li');
        noteEliminatoireLi.textContent = `Note éliminatoire : 12`;

        statistiquesUl.appendChild(nombreEtudiantsLi);
        statistiquesUl.appendChild(noteMoyenneLi);
        statistiquesUl.appendChild(nombreAuDessusMoyenneLi);
        statistiquesUl.appendChild(noteEliminatoireLi);
    }

    // Écouteur d'événement pour le formulaire d'ajout d'étudiant
    const etudiantFormulaire = document.getElementById('etudiantForm');
    if (etudiantFormulaire) {
        etudiantFormulaire.addEventListener('submit', function(event) {
            event.preventDefault(); // Empêcher la soumission par défaut du formulaire

            const fullname = document.getElementById('fullname').value.trim();
            const note = parseFloat(document.getElementById('note').value);

            if (fullname && !isNaN(note) && note >= 0 && note <= 20) {
                const nouvelEtudiant = { fullname: fullname, grade: note };
                dataEtudiants.push(nouvelEtudiant); // Ajouter le nouvel étudiant à notre tableau de données
                afficherTableau(dataEtudiants, tbody); // Mettre à jour le tableau
                calculerEtAfficherStatistiques(dataEtudiants); // Recalculer et afficher les statistiques

                // Réinitialiser le formulaire
                document.getElementById('fullname').value = '';
                document.getElementById('note').value = '';
            } else {
                alert("Veuillez remplir correctement tous les champs du formulaire.");
            }
        });
    }

    // Déplacer les statistiques en bas de page
    const statistiquesUl = document.getElementById('statistiques');
    if (statistiquesUl) {
        document.body.appendChild(statistiquesUl);
    }
});