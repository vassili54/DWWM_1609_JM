// Étape 1 : Définir le tableau de personnes
const people = ['Mike Dev', 'John Makenzie', 'Léa Grande'];

// Étape 2 : Ajouter des styles globaux au document
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
            margin-top: 0;
        }


        .dotted-border {
            border: 2px dotted #ACCBE1;
            padding: 10px;
            margin-bottom: 20px;
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
            width: 120px;
            border-collapse: collapse;
            margin-top: 20px;
            color: #aec5d2;
        }

        th {
            displex: flex;
            justify-content: center;
            width: 10px;
            }

        td {
            border: 1px solid #ACCBE1;
            padding: 8px;
            text-align: left;
            width: 10px;
            
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

// Étape 3 : Appeler la fonction pour ajouter les styles globaux
addGlobalStyles();

// Étape 4 : Sélectionner les éléments de la liste et du tableau
const peopleList = document.getElementById('people-list');
peopleList.setAttribute('style', 'list-style: none; padding: 0; margin: 0; color: #aec5d2; padding: 10px;');

// Étape 5 : Parcourir le tableau et ajouter chaque personne à la liste
for (let i = 0; i < people.length; i++) {
    const monli = document.createElement('li');
    monli.textContent = people[i];
    peopleList.appendChild(monli);
}

// Étape 6 : Fonction pour créer une cellule de données
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

function generateEmail(firstName, lastName) {
    return `${firstName.toLowerCase()}.${lastName.toLowerCase()}@example.com`;
}

// Étape 7 : Créer un tableau
function genererTableau(){
    const myTable = document.createElement('table');
    myTable.setAttribute("id", "tabledata");
    myTable.setAttribute('style', 'padding:0; margin:0; color: #aec5d2; background-color: #637081;');
    document.querySelector('.container').appendChild(myTable);
    let myThead = myTable.createTHead();
    let myRowTitle = myThead.insertRow();

    // Étape 8 : Créer une cellule de titre
    let tableTitle = ['Nom', 'Prénom', 'Email', 'Supprimer'];
    for (let i = 0; i < tableTitle.length; i++) {
        createCellTitle(tableTitle[i], myRowTitle);
    }

    // Étape 9 : Ajouter les données au tableau
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

// Étape 10 : Ajouter un titre pour le formulaire
const formWrapper = document.createElement('div');
formWrapper.setAttribute('class', 'dotted-border');

const formTitle = document.createElement('h2');
formTitle.textContent = 'Ajouter une personne';
formWrapper.appendChild(formTitle);


// Étape 11 : Ajouter un formulaire pour ajouter une personne
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
firstNameInput.setAttribute('style', 'width: 140px; padding: 5px; margin: 25px; background-color: #637081; border: 1px solid #ACCBE1; color: #aec5d2;'); // Ajout de style pour réduire la largeur du champ

const lastNameLabel = document.createElement('label');
lastNameLabel.setAttribute('for', 'lastName');
lastNameLabel.textContent = 'Nom : ';

const lastNameInput = document.createElement('input');
lastNameInput.setAttribute('type', 'text');
lastNameInput.setAttribute('id', 'lastName');
lastNameInput.setAttribute('name', 'lastName');
lastNameInput.required = true;
lastNameInput.setAttribute('style', 'width: 140px; padding: 5px; margin: 25px; background-color: #637081; border: 1px solid #ACCBE1; color: #aec5d2;'); // Ajout de style pour réduire la largeur

const submitButton = document.createElement('input');
submitButton.setAttribute('type', 'button');
submitButton.value= 'Ajouter';
submitButton.setAttribute('style','width: 90px; padding: 5px; margin: 5px; background-color: #637081; border: 1px solid #ACCBE1; color: #aec5d2;');

const confirmationMessage = document.createElement('p'); // Crée un élément <p> pour le message de confirmation
confirmationMessage.setAttribute('style', 'margin-top: 20px; margin-bottom: 10px;'); 




submitButton.addEventListener('click', function() {
    const firstName = firstNameInput.value;
    const lastName = lastNameInput.value;
    
    // Validation des champs
    const lettersOnly = /^[A-Za-zÀ-ÖØ-öø-ÿ]+$/;
    if (!lettersOnly.test(firstName) || !lettersOnly.test(lastName)) {
        alert("Le nom et le prénom doivent contenir uniquement des lettres.");
        return;
    }
    if (firstName.length < 2 || lastName.length < 2) {
        alert("Le nom et le prénom doivent contenir au moins 2 caractères.");
        return;
    }
    // Vérification de l'unicité
    const fullName = `${firstName} ${lastName}`;
    if (people.includes(fullName)) {
        alert("Une personne avec ce nom et prénom existe déjà.");
        return;
    }
    // Ajoute de la personne
    people.push(fullName);
    document.querySelector('#tabledata').remove(); // Supprime le tableau existant
    genererTableau();
    
    // Affiche le message de confirmation
    confirmationMessage.textContent = `${firstName} ${lastName} ajouté(e) avec succès !`;

    // Efface les champs du formulaire
    firstNameInput.value = '';
    lastNameInput.value = '';

});

formContainer.appendChild(firstNameLabel);
formContainer.appendChild(firstNameInput);
formContainer.appendChild(lastNameLabel);
formContainer.appendChild(lastNameInput);
formContainer.appendChild(submitButton);

formWrapper.appendChild(formContainer);
formWrapper.appendChild(confirmationMessage); // Ajoute le message de confirmation sous le formulaire
document.querySelector('.container').insertBefore(formWrapper, peopleList);
