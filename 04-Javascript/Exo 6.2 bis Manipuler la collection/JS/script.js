// Définir le tableau de personnes
const people = ['Mike Dev', 'John Makenzie', 'Léa Grande'];

// Ajouter des styles globaux au document
function addGlobalStyles() {
    const style = document.createElement('style');
    style.innerHTML = `
        body {
            font-family: verdana, sans-serif;
            background-color: #536B78;
            margin: 0;
            padding: 0;
            color: white;
        }
        .container {
            border: 2px solid #ACCBE1;
            width: 800px;
            background-color: #536B78;
            padding: 10px;
            margin: 30px 15px 15px 15px;
            box-sizing: border-box;
        }
        h1 {
            color: #ACCBE1;
            margin-top: 0;
        }

        h2 {
            font-size: 1em;
        }

        ul {
            color: white;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        li {
            color: white;
            padding: 5px 0;
        }
        li::before {
            content: '•';
            font-weight: bold;
            display: inline-block;
            width: 1em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #aec5d2;
        }

        th {
            displex: flex;
            justify-content: center;}

        td {
            border: 1px solid #ACCBE1;
            padding: 8px;
            text-align: left;
        }

        .delete-btn {
            background-color: transparent;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }
    `;
    document.head.appendChild(style);
}

// Appeler la fonction pour ajouter les styles globaux
addGlobalStyles();

// Sélectionner les éléments de la liste et du tableau
const peopleList = document.getElementById('people-list');
peopleList.setAttribute('style', 'list-style: none; padding: 0; margin: 0; color: #aec5d2; padding: 10px;');

// Parcourir le tableau et ajouter chaque personne à la liste
for (let i = 0; i < people.length; i++) {
    const monli = document.createElement('li');
    monli.textContent = people[i];
    peopleList.appendChild(monli);
}




// Fonction pour créer une cellule de données
function createCell(text, row) {
    let cell = row.insertCell();
    cell.setAttribute("style", "border: 1px solid #aec5d2; padding: 10px;");
    cell.textContent = text;
    return cell;
}
function createCellTitle(text, row) {
    let cell = document.createElement('th');
    cell.setAttribute("style", "border: 1px solid #aec5d2; color: #aec5d2; padding: 10px; font-weight: bold;");
    cell.textContent = text;
    row.appendChild(cell);
}

// Fonction pour générer une adresse e-mail
function generateEmail(firstName, lastName) {
    return `${firstName.toLowerCase()}.${lastName.toLowerCase()}@example.com`;
}  

function genererTableau(){

  

    // Créer un tableau
    const myTable = document.createElement('table');
    myTable.setAttribute("id", "tabledata");
myTable.setAttribute('style', 'padding:0; margin:0; color: #aec5d2; background-color: #637081;');
document.querySelector('.container').appendChild(myTable);
let myThead = myTable.createTHead();
let myRowTitle = myThead.insertRow();

// Fonction pour créer une cellule de titre

    let tableTitle = ['Nom', 'Prénom', 'Email', 'Supprimer'];
    for (let i = 0; i < tableTitle.length; i++) {
        createCellTitle(tableTitle[i], myRowTitle);
    }
    
  
    
    
    // Ajouter les données au tableau
    const mybody = myTable.createTBody();
    for (let i = 0; i < people.length; i++) {
        let myRow = mybody.insertRow();
        let [firstName, lastName] = people[i].split(' ');
        let email = generateEmail(firstName, lastName);
        createCell(lastName, myRow);
        createCell(firstName, myRow);
        createCell(email, myRow);
    
        // Ajouter une cellule pour le bouton "Supprimer" avec une croix grise
        let deleteCell = myRow.insertCell();
        let deleteButton = document.createElement('button');
        deleteButton.innerHTML = 'X';
        deleteButton.className = 'delete-btn';
        deleteButton.onclick = function() {
            myTable.deleteRow(myRow.rowIndex); // Supprime la ligne du tableau
        };
        deleteCell.appendChild(deleteButton);
    }
}
genererTableau();

// Ajouter un titre pour le formulaire
const formTitle = document.createElement('h2');
formTitle.textContent = 'Ajouter une personne';
document.querySelector('.container').insertBefore(formTitle, peopleList);


// Ajouter un formulaire pour ajouter une personne
const formContainer = document.createElement('form');
formContainer.setAttribute('id', 'person-form');

const firstNameLabel = document.createElement('label');
firstNameLabel.setAttribute('for', 'firstName');
firstNameLabel.textContent = 'Prénom : ';

const firstNameInput = document.createElement('input');
firstNameInput.setAttribute('type', 'text');
firstNameInput.setAttribute('id', 'firstName');
firstNameInput.setAttribute('name', 'firstName');
firstNameInput.required = true;

const lastNameLabel = document.createElement('label');
lastNameLabel.setAttribute('for', 'lastName');
lastNameLabel.textContent = 'Nom : ';

const lastNameInput = document.createElement('input');
lastNameInput.setAttribute('type', 'text');
lastNameInput.setAttribute('id', 'lastName');
lastNameInput.setAttribute('name', 'lastName');
lastNameInput.required = true;

const submitButton = document.createElement('input');
submitButton.setAttribute('type', 'button');
submitButton.value= 'Ajouter';
submitButton.setAttribute("style","margin-left:10px");

submitButton.addEventListener('click', function() {
const firstName = firstNameInput.value;
const lastName = lastNameInput.value;
let myPeople = firstName + ' ' + lastName;
people.push(myPeople); 
document.querySelector('#tabledata').remove(); // Supprime le tableau existant
genererTableau();
});

formContainer.appendChild(firstNameLabel);
formContainer.appendChild(firstNameInput);
formContainer.appendChild(lastNameLabel);
formContainer.appendChild(lastNameInput);
formContainer.appendChild(submitButton);


document.querySelector('.container').insertBefore(formContainer, peopleList);

const btnSupprimer = document.createElement('input');
formContainer.appendChild(btnSupprimer);
btnSupprimer.setAttribute('type', 'button');
btnSupprimer.value = 'Supprimer';
btnSupprimer.setAttribute('style', 'margin-left: 10px;');
btnSupprimer.addEventListener('click', function() {
    people.splice(0, people.length);

    document.querySelector('#tabledata').remove();
    genererTableau();
});

  