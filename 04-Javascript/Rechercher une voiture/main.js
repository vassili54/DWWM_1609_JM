/*
 fetch ('./data/.cars.json');

.then(Response => Response.json())
.then(data => {
    const cars = data;
})
*/

import { collectionCars } from './data/cars.js';

const monBouton = document.getElementById('validate');
const inputCars = document.getElementById('carName');
const divResult = document.getElementById("result");

console.log("Bouton :", monBouton); // Vérifiez que le bouton est bien récupéré

// Ajouter un écouteur d'événement sur le bouton "Rechercher"
monBouton.addEventListener('click', function(event) {
    event.preventDefault();  // Empêcher le rechargement de la page

    const searchTerm = inputCars.value.trim().toLowerCase(); // recup et nettoye le terne de recherche

    if (searchTerm === "") {
        divResult.innerHTML = "";
        return;
    }

    // Filtrer les voitures qui correspondent au terme de recherche
    const FilteredCars = collectionCars.filter(car => car.car_name.toLowerCase().includes(searchTerm));

    // Afficher les résultats
    if (FilteredCars.length > 0) {
        divResult.innerHTML = FilteredCars.map(car => `
             <div class="car-info">
                <p><strong>ID:</strong> ${car.car_id}</p>
                <p><strong>Nom:</strong> ${car.car_name}</p>
                <p><strong>Modèle:</strong> ${car.car_model}</p>
                <p><strong>Cylindres:</strong> ${car.car_cylinders}</p>
                <p><strong>Puissance:</strong> ${car.car_horsepower} HP</p>
                <p><strong>Poids:</strong> ${car.car_weight} lbs</p>
                <p><strong>Origine:</strong> ${car.car_origin}</p>
            </div>
            `).join('');
    } else {
        divResult.innerHTML = "<p>Aucune voiture trouvée.</p>";
    }

});