const { createApp } = Vue;

const app = createApp({
    data() {
        return {
            listeCereales: [], // Stocke la liste des céréales
            recherche: '', // Terme de recherche
            filtresNutriscore: [], // Filtres Nutriscore sélectionnés (A-E)
            filtreCategorie: 'Tous', // Catégorie sélectionnée
            sortKey: '', // Colonne utilisée pour le tri
            sortDirection: 'asc', // Direction du tri (ascendant/descendant)
        }
    },
    mounted() {
        this.loadData(); // Charge les données au montage du composant
    },
    methods: {
        // Récupère les données des céréales depuis le JSON
        async fetchCereales() {
            try {
                const response = await fetch('./data/cereals.json');
                const data = await response.json();
                this.listeCereales = data.data || data; // Gère les deux formats possibles
            } catch (error) {
                console.error("Erreur lors du chargement des céréales :", error);
                // Vous pourriez ajouter un état d'erreur pour l'interface
            }
        },

        // Supprime de l'affichage une céréale par son ID
        supprimerCereale(id) {
            this.listeCereales = this.listeCereales.filter(cereale => cereale.id !== id);
        },

        // Trie les céréales par colonne
        sortBy(key) {
            if (this.sortKey === key) {
                // Inverse le tri si on clique sur la même colonne
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                // Nouvelle colonne de tri, ordre ascendant par défaut
                this.sortKey = key;
                this.sortDirection = 'asc';
            }

            this.listeCereales.sort((a, b) => {
                let valueA = a[key];
                let valueB = b[key];

                // Gère les valeurs manquantes
                if (valueA === undefined || valueA === null) valueA = '';
                if (valueB === undefined || valueB === null) valueB = '';

                if (typeof valueA === 'string' && typeof valueB === 'string') {
                    // Comparaison de texte
                    return this.sortDirection === 'asc'
                        ? valueA.localeCompare(valueB)
                        : valueB.localeCompare(valueA);
                } else {
                    // Comparaison numérique
                    valueA = parseFloat(valueA) || 0;
                    valueB = parseFloat(valueB) || 0;
                    return this.sortDirection === 'asc'
                        ? valueA - valueB
                        : valueB - valueA;
                }
            });
        },

        // Calcule le Nutriscore à partir de la note
        calculerNutriscore(rating) {
            const ratingValue = parseFloat(rating);

            if (ratingValue > 80) return 'A';
            if (ratingValue > 70) return 'B';
            if (ratingValue > 55) return 'C';
            if (ratingValue > 35) return 'D';
            return 'E';
        },

        // Retourne la classe CSS pour le Nutriscore
        classNutriscore(nutriscore) {
            return `nutriscore-${nutriscore.toLowerCase()}`;
        },

        // Sauvegarde l'état actuel du tableau dans localStorage
        saveData() {
            if (localStorage.getItem('cerealesData')) {
                if (confirm("Une sauvegarde existe déjà. Voulez-vous l'écraser ?")) {
                    localStorage.setItem('cerealesData', JSON.stringify(this.listeCereales));
                    alert("Tableau sauvegardé dans le navigateur !");
                }
            } else {
                localStorage.setItem('cerealesData', JSON.stringify(this.listeCereales));
                alert("Tableau sauvegardé dans le navigateur !");
            }
        },

        // Télécharge un fichier JSON de l'état actuel du tableau
        downloadData() {
            const jsonData = JSON.stringify(this.listeCereales, null, 2); // null, 2 pour un formatage lisible
            const filename = 'cereales.json';
            const blob = new Blob([jsonData], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        },

        // Charge les données depuis localStorage si une sauvegarde existe, sinon appelle fetchCereales
        loadData() {
            const savedData = localStorage.getItem('cerealesData');
            if (savedData) {
                this.listeCereales = JSON.parse(savedData);
                alert("Données sauvegardées chargées depuis le navigateur.");
            } else {
                this.fetchCereales();
            }
        },

        // Supprime la sauvegarde et recharge les données depuis l'API
        resetData() {
            if (confirm("Êtes-vous sûr de vouloir réinitialiser les données ? La sauvegarde locale sera supprimée.")) {
                localStorage.removeItem('cerealesData');
                this.fetchCereales();
                alert("Données réinitialisées et rechargées depuis l'API.");
            }
        }
    },
    computed: {
        // Compte le nombre total de céréales
        cerealesCount() {
            return this.cerealesFiltrees.length;
        },

        // Calcule la moyenne des calories
        averageCalories() {
            if (this.cerealesCount === 0) return '-';
            const total = this.cerealesFiltrees.reduce((sum, c) => sum + (parseFloat(c.calories) || 0), 0);
            return Math.round(total / this.cerealesCount);
        },

        // Filtre les céréales selon les critères
        cerealesFiltrees() {
            return this.listeCereales.filter(cereale => {
                const matchSearch = cereale.name.toLowerCase().includes(this.recherche.toLowerCase());
                const matchNutriscore = this.filtresNutriscore.length === 0 || this.filtresNutriscore.includes(this.calculerNutriscore(cereale.rating));

                let matchCategorie = true;

                if (this.filtreCategorie !== 'Tous') {
                    matchCategorie = false;  // Initialiser à false

                    switch (this.filtreCategorie) {
                        case 'Sans sucre':
                            if (parseFloat(cereale.sugars) < 1) {
                                matchCategorie = true;
                            }
                            break;
                        case 'Pauvre en Sel':
                            if (parseFloat(cereale.sodium) < 50)  {
                                matchCategorie = true;
                            }
                            break;
                        case 'Boost':
                            if (parseFloat(cereale.vitamins) >= 25 && parseFloat(cereale.fiber) >= 10) {
                                matchCategorie = true;
                            }
                            break;
                    }
                }

                return matchSearch && matchNutriscore && matchCategorie;
            });
        }
    }

}).mount('#app');