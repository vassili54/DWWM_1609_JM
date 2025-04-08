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
        this.fetchCereales(); // Charge les données au montage du composant
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
        
        // Supprime une céréale par son ID
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
        
        // Filtre les céréales selon les critères (à implémenter)
        cerealesFiltrees() {
            return this.listeCereales.filter(cereale => {
                // Filtre par recherche
                const matchSearch = cereale.name.toLowerCase().includes(
                    this.recherche.toLowerCase()
                );
                
                // Filtre par Nutriscore
                const matchNutriscore = this.filtresNutriscore.length === 0 || 
                    this.filtresNutriscore.includes(
                        this.calculerNutriscore(cereale.rating)
                    );
                
                let matchCategorie = true; // Par défaut, toutes les catégories correspondent

                if (this.filtreCategorie === 'sans sucre') {
                    matchCategorie = parseFloat(cereale.sugars) === 0;
                } else if  (this.filtreCategorie === 'pauvre en sel') {
                    matchCategorie = parseFloat(cereale.sodium) < 100;
                } else if (this.filtreCategorie === 'Boost') {
                    matchCategorie = parseFloat(cereale.protein) > 3;;
                } else if (this.filtreCategorie !== 'Tous') {
                    matchCategorie = true;
                }

                return matchSearch && matchNutriscore && matchCategorie;
            });
        }
    }
}).mount('#app');