const { createApp } = Vue;

const app = createApp({
  data() {
    return {
      titrePage: 'Employees',
      message: 'This is the current list of employees',
      employes: [],  // Initialisation du tableau pour stocker les employés
      sortBy: null, // Initialise le tri par salaire au chargement
      sortDirection: 'asc', // Initialise la direction du tri à croissant
      totalSalairesMensuels: 0
    };
  },
  mounted() {
    // Cette fonction est appelée une fois que le composant Vue est monté
    fetch('./data/employees.json')  // Chemin vers votre fichier JSON
      .then(response => response.json())  // Convertit la réponse en JSON
      .then(data => {
        this.employes = data.data.map(employe => {
          const fullNameParts = employe.employee_name.split(' ');
          const firstName = fullNameParts[0].toLowerCase();
          const lastName = fullNameParts.slice(1).join(' ').toLowerCase();
          const email = `${firstName.charAt(0)}.${lastName}@email.com`;
          const monthlySalary = (employe.employee_salary / 12).toFixed(2);;
          const currentYear = new Date().getFullYear();
          const yearOfBirth = currentYear - employe.employee_age;

          return {
            id: employe.id,
            fullname: employe.employee_name,
            email: email,
            salary: monthlySalary,
            birth: yearOfBirth,
            actions: '' // Nous ajouterons les boutons dans le HTML
          };
        });
        this.calculateTotalSalary();  // Appeler la fonction pour calculer le total après le chargement
      })
      .catch(error => {
        console.error('Erreur lors du chargement des employés:', error);
      });
  },
  methods: {
    sortBySalary() {
      if (this.sortBy === 'salary') {
        this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
      } else {
        this.sortBy = 'salary'
        this.sortDirection = 'asc'
      }

      this.employes.sort((a, b) => {
        const comparison = parseFloat(a.salary) - parseFloat(b.salary);
        return this.sortDirection === 'asc' ? comparison : comparison * -1;
      });
    },
    calculateTotalSalary() {
      this.totalSalairesMensuels = this.employes.reduce((total, employe) => {
        return total + parseFloat(employe.salary); // Additionne les salaires mensuels
      }, 0).toFixed(2);
    },
    duplicateEmployee(employeToDuplicate) {
      // Trouver l'ID le plus élevé actuel pour générer un nouvel ID unique
      const maxId = this.employes.reduce((max, emp) => Math.max(max, emp.id), 0);
      const newId = maxId + 1;

      const duplicatedEmployee = {
        id: newId,
        fullname: employeToDuplicate.fullname,
        email: employeToDuplicate.email,
        salary: employeToDuplicate.salary,
        birth: employeToDuplicate.birth,
        actions: ''
      };
      this.employes.push(duplicatedEmployee);
      this.calculateTotalSalary(); // Recalculer le total après duplication
    },
    deleteEmployee(idToDelete) {
      this.employes = this.employes.filter(employe => employe.id !== idToDelete);
      this.calculateTotalSalary(); // Recalculer le total après suppression
    }
  }
}).mount('#app');
