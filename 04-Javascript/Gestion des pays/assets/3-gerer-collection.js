fetch('./data/collectionPays.json') // Lance une requête pour récupérer le contenu du fichier JSON
    .then(response => { // Lorsque la réponse est reçue
        if (!response.ok) { // Vérifie si la réponse est un succès
            throw new Error(`Erreur HTTP ! statut : ${response.status}`); // Si non, lance une erreur
        }
        return response.json(); // Interprète la réponse comme du JSON et retourne une promesse
    })
    .then(pays => { // Lorsque les données JSON sont interprétées (le tableau 'pays')
        console.log(pays); // Affiche le tableau de pays dans la console

        const tbodyElement = document.getElementById('mesPays'); // Récupère l'élément <tbody> du tableau

        if (tbodyElement) { // Vérifie si l'élément <tbody> a été trouvé
            pays.forEach(paysItem => { // Parcours chaque objet 'paysItem' dans le tableau 'pays'
                const trElement = document.createElement('tr'); // Crée une nouvelle ligne <tr> pour chaque pays
                const tdCode = document.createElement('td'); // Crée une nouvelle cellule <td> pour le code du pays
                const tdNom = document.createElement('td'); // Crée une nouvelle cellule <td> pour le nom du pays

                tdCode.textContent = paysItem.country_code; // Définit le contenu de la cellule du code avec la propriété 'country_code'
                tdNom.textContent = paysItem.country_name; // Définit le contenu de la cellule du nom avec la propriété 'country_name'

                trElement.appendChild(tdCode); // Ajoute la cellule du code à la ligne
                trElement.appendChild(tdNom); // Ajoute la cellule du nom à la ligne

                tbodyElement.appendChild(trElement); // Ajoute la ligne complète au corps du tableau (<tbody>)
            });
        } else {
            console.error("L'élément <tbody> avec l'ID 'mesPays' n'a pas été trouvé dans le HTML.");
        }
    })
    .catch(error => { // Gestion des erreurs lors de la récupération ou de l'interprétation du JSON
        console.error("Erreur lors du chargement du fichier JSON :", error);
    });