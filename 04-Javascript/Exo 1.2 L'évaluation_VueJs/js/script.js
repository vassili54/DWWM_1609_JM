const { createApp } = Vue;

createApp({
    data() {
        return {
            titre: "Résultat de l'évaluation",
            evaluations: [], // Initialisation d'un tableau vide pour stocker les données
            nombreEtudiants: 0,
            noteMoyenne: 0,
            nombreAuDessusMoyenne: 0,
            erreurChargement: null // Pour afficher un message d'erreur si le chargement échoue
        };
    },
    mounted() {
        fetch("./data/eval.json")
            .then(response => response.json())
            .then(data => {
                // Trier le tableau 'data' par la note (grade) en ordre décroissant
                data.sort((a, b) => b.grade - a.grade);
                this.evaluations = data; // Stocker les données dans la propriété 'evaluations'
                this.calculerStatistiques(); // Appeler la fonction pour calculer les statistiques
            })
            .catch(error => {
                console.error("Erreur lors de la récupération du JSON:", error);
                this.evaluations = []; // En cas d'erreur, on s'assure que le tableau est vide
                this.erreurChargement = "Erreur lors du chargement des données."; // Optionnel : pour afficher un message d'erreur
            });
    },
    methods: {
        calculerStatistiques() {
            this.nombreEtudiants = this.evaluations.length;
            let sommeNotes =0;
            this.evaluations.forEach(personne => {
                sommeNotes += personne.grade;
            });
            this.noteMoyenne = this.nombreEtudiants > 0 ? sommeNotes /this.nombreEtudiants : 0; // Calculer la moyenne
            this.nombreAuDessusMoyenne = this.evaluations.filter(personne => personne.grade > this.noteMoyenne).length; // Filtrer les étudiants avec une note supérieure à la moyenne
        }
    }

}).mount('#app');