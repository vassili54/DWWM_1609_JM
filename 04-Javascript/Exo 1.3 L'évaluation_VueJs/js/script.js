const { createApp } = Vue;

createApp({
    data() {
        return {
            titre: "Résultat de l'évaluation",
            evaluations: [], // Initialisation d'un tableau vide pour stocker les données
            nombreEtudiants: 0,
            noteMoyenne: 0,
            nombreAuDessusMoyenne: 0,
            erreurChargement: null, // Pour afficher un message d'erreur si le chargement échoue
            nouveauEtudiant: {
                fullname: '',
                grade: null
            }
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
        },
        formaterNomPrenom(nom) {
            if (!nom) return '';
            return nom.charAt(0).toUpperCase() + nom.slice(1).toLowerCase(); // Mettre la première lettre en majuscule et le reste en minuscule
        },
        ajouterEtudiant() {
            if (this.nouveauEtudiant.fullname && this.nouveauEtudiant.grade !== null) {
                // Créer un nouvel objet  étudiant
                const fullname = this.nouveauEtudiant.fullname.trim();
                const nameParts = fullname.split(' ');
                if (nameParts.length >= 2 && nameParts[0].toLowerCase().length >= 2 && nameParts[1].toLowerCase().length >= 2) {
                    const formattedPrenom = this.formaterNomPrenom(nameParts[0]);
                    const formattedNom = this.formaterNomPrenom(nameParts[1]);
                    const formattedFullname = `${formattedPrenom} ${formattedNom}`;
                    
                    const nouvelEtudiantObjet = { ...this.nouveauEtudiant, fullname: formattedFullname };

                    // Ajouter le nouvel étudiant au tableau evaluations
                    this.evaluations.push(nouvelEtudiantObjet);

                    // Trier le tableau après l'ajout (pour qu'il reste trié par note)
                    this.evaluations.sort((a, b) => b.grade - a.grade);

                    // Réinitialiser le formulaire
                    this.nouveauEtudiant = { fullname: '', grade: null };

                    // Recalculer les statistiques
                    this.calculerStatistiques();
                } else {
                    alert("Veuillez remplir le nom, prénom complet et la note de l'étudiant.");
                }
            } else {
                alert("Veuillez remplir le nom, prénom complet et la note de l'étudiant.");
            }
        }
    }       

}).mount('#app');