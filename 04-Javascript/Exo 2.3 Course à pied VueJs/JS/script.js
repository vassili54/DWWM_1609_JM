const { createApp } = Vue;

createApp({
    data() {
        return {
            titrePage: 'Résultat de la course',
            nbParticipantsInput: '',
            nomGagnantInput: '',
            participants: [],
            selectedCountries: [],
            tempsMoyenCourse: '' 
        };
    },
    mounted() {
        fetch('./data/resultat10000metres.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                this.participants = data;
                this.nbParticipantsInput = `${data.length} participants`;
                this.findWinner();
                this.calculateAverageTime(); // Appel de la méthode pour calculer le temps moyen
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des données:', error);
            });
    },
    computed: {
        uniqueCountries() { // Propriété calculée pour obtenir la liste unique des pays des participants
            return [...new Set(this.participants.map(participant => participant.pays))].sort();
        },
        sortedParticipants() {
            return [...this.participants].sort((a, b) => a.temps - b.temps);
        },
        filteredParticipants() { // Propriété calculée pour filtrer les participants par pays
            if (this.selectedCountries.length === 0) {
                return this.sortedParticipants; // Si aucun pays n'est sélectionné, afficher tous les participants triés
            } else {
                return this.sortedParticipants.filter(participant =>
                    this.selectedCountries.includes(participant.pays) // Filtrer les participants dont le pays est inclus dans le tableau des pays sélectionnés
                );
            }
        },
        formattedParticipants() {
            const winnerTime = this.sortedParticipants.length > 0 ? this.sortedParticipants[0].temps : 0; // Récupérer le temps du gagnant
            
            return this.filteredParticipants.map(participant => { // Utiliser 'filteredParticipants' au lieu de 'sortedParticipants'
                const ecart = participant.temps - winnerTime; // Calculer l'écart par rapport au temps du gagnant
                

                return {
                    pays: participant.pays,
                    nom: this.getNom(participant.nom),
                    prenom: this.getPrenom(participant.nom),
                    tempsFinal: this.formatTempsCourt(participant.temps),
                    ecartGagnant: (ecart > 0 ? '+' : '') + ecart +'s'
                };

            });
        }
    },
    methods: {
        findWinner() {
            if (this.sortedParticipants.length > 0) {
                this.nomGagnantInput = `Gagnant : ${this.sortedParticipants[0].nom}`;
            }
        },
        calculateAverageTime() {
            if (this.participants.length > 0) {
                const totalTemps = this.participants.reduce((sum, participant) => sum + participant.temps, 0);
                const averageTemps = totalTemps / this.participants.length;
                const roundedAverageTemps = Math.round(averageTemps); // Arrondir le temps moyen
                this.tempsMoyenCourse = `Temps moyen : ${this.formatTempsLong(roundedAverageTemps)}`;
            } else {
                this.tempsMoyenCourse = '';
            }
        },
        formatTempsCourt(tempsEnSecondes) {
            const minutes = Math.floor(tempsEnSecondes / 60);
            const secondes = tempsEnSecondes % 60;
            const minutesFormattees = minutes < 10 ? '0' + minutes : minutes;
            const secondesFormattees = secondes < 10 ? '0' + secondes : secondes;
            return `${minutesFormattees}min${secondesFormattees}s`;
        },
        formatTempsLong (tempsEnSecondes) { 
            const minutes = Math.floor(tempsEnSecondes / 60);
            const secondes = tempsEnSecondes % 60;
            return `${minutes} minutes et ${secondes} secondes`;
        },
        getNom(fullName) {
            const nameParts = fullName.split(' ');
            if (nameParts.length > 1) {
                return nameParts.slice(0, -1).join(' ');
            } else if (nameParts.length === 1) {
                return nameParts[0];
            }
            return '';
        },
        getPrenom(fullName) {
            const nameParts = fullName.split(' ');
            if (nameParts.length > 1) {
                return nameParts.slice(-1).join(' ');
            }
            return '';
        }
    }
}).mount('.course');