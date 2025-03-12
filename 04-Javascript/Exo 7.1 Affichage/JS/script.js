document.getElementById('profileForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Récupérer les valeurs des champs du formulaire
    const nom = document.getElementById('nom').value;
    const prenom = document.getElementById('prenom').value;
    const email = document.getElementById('email').value;

    // Créer une nouvelle ligne dans le tableau
    const table = document.getElementById('myTable');
    const newRow = table.insertRow();

    // Insérer les cellules avec les données
    const cellNom = newRow.insertCell(0);
    const cellPrenom = newRow.insertCell(1);
    const cellEmail = newRow.insertCell(3);

    cellNom.innerHTML = nom;
    cellPrenom.innerHTML = prenom;
    cellEmail.innerHTML = email;

    // Réinitialiser le formulaire
    document.getElementById('profileForm').reset();
});


