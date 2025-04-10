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
            checkedCereales: [], // Nouveau tableau pour stocker les IDs des céréales cochées
        }
    },
    mounted() {
        this.loadData(); // Charge les données au montage du composant (MODIFIÉ)
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
            const etatApplication = {
                listeCereales: this.cerealesFiltrees,
                checkedCereales: this.checkedCereales
                
            };
            const jsonData = JSON.stringify(etatApplication);
            if (localStorage.getItem('cerealesAppState')) {
                if (confirm("Une sauvegarde existe déjà, Voulez-vous l'écraser ?")) {
                    localStorage.setItem('cerealesAppState', jsonData);
                    alert("Tableau sauvegardé dans le navigteur !");
                }
            } else {
                localStorage.setItem('cerealesAppState', jsonData);
                alert("Tableau sauvegardé dans le navigateur !");
            }
        },

        // Télécharge un fichier JSON de l'état actuel du tableau
        downloadData() {
            const jsonData = JSON.stringify(this.listeCereales, null, 2);
            const filename = 'cereales.json';
            // Blob est l'acronyme de Binary Large Object
            const blob = new Blob([jsonData], { type: 'application/json' }); // Crée un blob à partir des données JSON
            const url = URL.createObjectURL(blob); // Crée une URL pour le blob
            const a = document.createElement('a');
            a.href = url; // Définit l'URL du lien
            a.download = filename; // Définit le nom du fichier à télécharger
            document.body.appendChild(a); // Ajoute le lien au DOM
            a.click(); // Simule un clic sur le lien pour déclencher le téléchargement
            document.body.removeChild(a); // Supprime le lien du DOM
            URL.revokeObjectURL(url); // Libère l'URL du blob
        },


        // Charge les données depuis localStorage si une sauvegarde existe, sinon appelle fetchCereales
        loadData() {
            const savedAppState = localStorage.getItem('cerealesAppState');
            if (savedAppState) {
                const parsedData = JSON.parse(savedAppState);
                this.listeCereales = parsedData.listeCereales;
                this.checkedCereales = parsedData.checkedCereales || [];
                alert("Données sauvegardées chargées depuis le navigateur.");
            } else {
                this.fetchCereales();
            }
        },

        // Supprime la sauvegarde et recharge les données depuis l'API
        resetData() {
            if (confirm("Êtes-vous sûr de vouloir réiniatialiser les données ? La saugarde locale sera supprimée.")) {
                localStorage.removeItem('cerealesAppState');
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