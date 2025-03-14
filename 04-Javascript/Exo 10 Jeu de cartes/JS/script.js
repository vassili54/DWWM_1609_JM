// Récupérer les données depuis l'API fictive
fetch("https://arfp.github.io/tp/web/javascript/03-cardgame/cardgame.json")
    .then(response => {
        if (!response.ok) {
            throw new Error("Erreur de réseau");
        }
        return response.json();
    })
    .then(data => {
        console.log("Données reçues de l'API :", data); // Afficher les données reçues dans la console
        const tableBody = document.querySelector("#card-table tbody");

        // Générer les lignes du tableau
        data.forEach(card => {
            const row = document.createElement("tr");

            // Liste des clés à afficher dans l'ordre des colonnes du tableau
            const keys = ["id", "name", "level", "description", "power", "attack", "armor", "damage", "mitigation", "played", "victory", "defeat", "draw"];

            // Ajouter chaque valeur de la carte dans une cellule
            keys.forEach(key => {
                const cell = document.createElement("td");
                if(key == "description"){
                    cell.textContent = "-";
                }
                else{
                    cell.textContent = card[key] !== null && card[key] !== undefined ? card[key] : "-"; // Gérer les valeurs nulles ou non définies
                }
                
                row.appendChild(cell);
            });

            tableBody.appendChild(row);
        });

        // Trouver la carte avec le plus de parties jouées
        let mostPlayed = data.reduce((max, card) => card.played > max.played ? card : max, data[0]);
        document.getElementById('most-played').innerText = `${mostPlayed.name} avec ${mostPlayed.victory} victoires`;

        // Trouver la carte avec le meilleur ratio victoires/défaites
        let bestRatioCard = data.reduce((best, card) => {
            let ratio = card.victory / card.defeat;
            let bestRatio = best.victory / best.defeat;
            return ratio > bestRatio ? card : best;
        }, data[0]);
        document.getElementById('best-ratio').innerText = `${bestRatioCard.name} avec ${bestRatioCard.played} parties et ${bestRatioCard.victory} victoires`;
    })
    .catch(error => {
        console.error("Erreur lors de la récupération des données :", error);
        document.getElementById('most-played').innerText = "Erreur de chargement des données";
        document.getElementById('best-ratio').innerText = "Erreur de chargement des données";
    });