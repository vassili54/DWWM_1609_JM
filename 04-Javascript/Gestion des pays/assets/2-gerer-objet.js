const laFrance = {
    "country_code": "FR", 
    "country_name": "France" 
};

console.log(laFrance); // Affiche l'objet 'laFrance' dans la console du navigateur pour le débogage

// Charger et exploiter l'objet France pour l'afficher dans le HTML
const mainElement = document.getElementById('principal'); // Récupère l'élément <main> du HTML en utilisant son ID

if (mainElement) { // Vérifie si l'élément <main> a été trouvé dans le HTML
    const articleFrance = document.createElement('article'); // Crée un nouvel élément <article>
    const pFrance = document.createElement('p'); // Crée un nouvel élément <p>
    pFrance.textContent = `Pays 1 : ${laFrance.country_name} (${laFrance.country_code})`; // Définit le contenu textuel du paragraphe en utilisant les données de l'objet 'laFrance'
    articleFrance.appendChild(pFrance); // Ajoute l'élément <p> comme enfant de l'élément <article>
    mainElement.appendChild(articleFrance); // Ajoute l'élément <article> (contenant le <p>) comme enfant de l'élément <main>
} else {
    console.error("L'élément <main> avec l'ID 'principal' n'a pas été trouvé dans le HTML."); // Affiche une erreur dans la console si l'élément <main> n'est pas trouvé
}

// Partie 2 : Charger et exploiter l'objet Belgique depuis un fichier JSON
fetch('./data/belgique.json') // Lance une requête HTTP pour récupérer le contenu du fichier 'belgique.json'
    .then(response => { // 'then' est exécuté lorsque la requête est réussie (la promesse est résolue)
        if (!response.ok) { // Vérifie si le statut de la réponse indique un succès (ex: 200 OK)
            throw new Error(`Erreur HTTP ! statut : ${response.status}`); // Si le statut n'est pas OK, lance une nouvelle erreur
        }
        return response.json(); // Demande à la réponse d'être interprétée comme du JSON et retourne une nouvelle promesse avec le résultat
    })
    .then(belgique => { // 'then' est exécuté lorsque la promesse de l'interprétation JSON est résolue, 'belgique' contient l'objet JSON parsé
        console.log(belgique); // Affiche l'objet 'belgique' dans la console du navigateur

        const articleBelgique = document.createElement('article'); // Crée un nouvel élément <article> pour la Belgique
        const pBelgique = document.createElement('p'); // Crée un nouvel élément <p> pour la Belgique
        pBelgique.textContent = `Pays 2 : ${belgique.country_name} (${belgique.country_code})`; // Définit le contenu textuel du paragraphe en utilisant les données de l'objet 'belgique'
        articleBelgique.appendChild(pBelgique); // Ajoute l'élément <p> comme enfant de l'élément <article> pour la Belgique
        mainElement.appendChild(articleBelgique); // Ajoute l'élément <article> (contenant le <p>) comme enfant de l'élément <main>
    })
    .catch(error => { // 'catch' est exécuté si une erreur se produit lors de la requête 'fetch' ou de l'interprétation JSON
        console.error("Erreur lors du chargement du fichier JSON :", error); // Affiche une erreur dans la console en cas de problème avec le chargement du fichier JSON
    });