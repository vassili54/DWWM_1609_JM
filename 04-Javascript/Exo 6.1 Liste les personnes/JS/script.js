// Tableau de personnes
const people = ['Mike Dev', 'John Makenzie', 'Léa Grande'];

people.unshift("Francis Cabrel"); // Ajouter une personne au début

// Sélectionner les éléments de la liste et du tableau
const peopleList = document.getElementById('people-list');
peopleList.setAttribute('style', 'list-style: none; padding: 0; margin: 0;color: #aec5d2; padding: 10px; ');

// Fonction pour générer une adresse email
function generateEmail(firstName, lastName) {
    return `${firstName.toLowerCase()}.${lastName.toLowerCase()}@example.com`;
}

// Parcourir le tableau et ajouter chaque personne à la liste
for (let i = 0; i < people.length; i++) {
    const monli = document.createElement('li');
    monli.textContent = people[i];
    peopleList.appendChild(monli);
}

const myTable = document.querySelector('#tabledata');
myTable.setAttribute('style', 'padding:0; margin:0;color: #aec5d2; background-color: #637081;');

let myThead = myTable.createTHead();
let myRow = myThead.insertRow();

// Fonction pour créer une cellule de titre
function createCellTitle(text, row) {
    let cell = document.createElement('th');
    cell.setAttribute("style", "border: 1px solid #aec5d2;color: #aec5d2 padding: 10px;font-weight: bold;");
    cell.textContent = text;
    row.appendChild(cell);
}
// Fonction pour créer une cellule
function createCell(text, row) {
    let cell = row.insertCell();
    cell.setAttribute("style", "border: 1px solid #aec5d2; padding: 10px;");
    cell.textContent = text;
    return cell;
}
// Ajouter les titres au tableau
let tableTitle = ['Nom', 'Prénom', 'Email']; 
for (let i = 0; i < tableTitle.length; i++) { // Parcourir le tableau
    createCellTitle(tableTitle[i], myRow); // Ajouter le titre
}

// Ajouter les données au tableau
people.push("Ariana Grande"); // Ajouter une personne
const mybody = myTable.createTBody(); // Ajouter un corps au tableau
for (let i = 0; i < people.length; i++) { // Parcourir le tableau
    let myRow = mybody.insertRow(); // Ajouter une ligne
    let Nom = people[i].split(' ')[1]; // Séparer le prénom et le nom
    let Prenom = people[i].split(' ')[0]; // Séparer le prénom et le nom
    let email = generateEmail(Prenom, Nom); // Générer l'adresse email
    createCell(Nom, myRow); // Ajouter le nom
    createCell(Prenom, myRow);  // Ajouter le prénom
    createCell(email, myRow); // Ajouter l'adresse email
}
