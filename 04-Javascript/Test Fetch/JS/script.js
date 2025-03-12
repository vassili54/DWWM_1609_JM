fetch("./JS/data.json")
.then(response => response.json()) //  renvoie également une promesse contenant la réponse à votre demande en JSON.
.then(data => console.log(data)); // affiche les données dans la console.