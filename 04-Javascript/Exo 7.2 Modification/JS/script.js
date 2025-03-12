// Données initiales
let employee = {
    lastname: "Doe",
    firstname: "John",
    birthday: "1981-11-12",
    salary: 2150,
};

// Générer l'email
function generateEmail(firstname, lastname) {
    return `${firstname.toLowerCase()}.${lastname.toLowerCase()}@example.com`;
}

// Mettre à jour le tableau
function updateTable() {
    document.getElementById("lastname").textContent = employee.lastname;
    document.getElementById("firstname").textContent = employee.firstname;
    document.getElementById("birthday").textContent = employee.birthday;
    document.getElementById("email").textContent = generateEmail(employee.firstname, employee.lastname);
    document.getElementById("salary").textContent = `${employee.salary} €`;
}

// Remplir le formulaire avec les données actuelles
function fillForm() {
    document.getElementById("inputLastname").value = employee.lastname;
    document.getElementById("inputFirstname").value = employee.firstname;
    document.getElementById("inputBirthday").value = employee.birthday;
    document.getElementById("inputSalary").value = employee.salary;
}

// Contrôles de saisie
function validateForm(data) {
    const errors = [];

    // Vérifier le nom et le prénom
    const nameRegex = /^[A-Za-z]{2,}$/;
    if (!nameRegex.test(data.lastname)) {
        errors.push("Le nom doit contenir au moins 2 lettres et uniquement des lettres.");
    }
    if (!nameRegex.test(data.firstname)) {
        errors.push("Le prénom doit contenir au moins 2 lettres et uniquement des lettres.");
    }

    // Vérifier la date de naissance
    const today = new Date();
    const birthday = new Date(data.birthday);
    if (birthday >= today) {
        errors.push("La date de naissance doit être dans le passé.");
    }
    

    // Vérifier le salaire
    if (data.salary < employee.salary) {
        errors.push("Le salaire ne peut pas être inférieur au salaire précédent.");
    }

    
    return errors;
}

// Gérer la soumission du formulaire
document.getElementById("employeeForm").addEventListener("submit", function (event) {
    event.preventDefault();

    // Récupérer les données du formulaire
    const formData = {
        lastname: document.getElementById("inputLastname").value.trim(),
        firstname: document.getElementById("inputFirstname").value.trim(),
        birthday: document.getElementById("inputBirthday").value,
        salary: parseFloat(document.getElementById("inputSalary").value),
    };

    // Valider les données
    const errors = validateForm(formData);
    if (errors.length > 0) {
        alert(errors.join("\n"));
        return;
    }

    // Mettre à jour l'objet employee
    employee = { ...formData };

    // Mettre à jour le tableau et regénérer l'email
    updateTable();

    alert("Informations mises à jour avec succès !");
});

// Initialisation
fillForm();
updateTable();