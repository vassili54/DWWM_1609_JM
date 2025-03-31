const { createApp } = Vue; // Importe la fonction createApp depuis la librairie Vue.js

createApp({ // Crée une nouvelle instance d'application Vue
    data() { // La fonction data retourne un objet contenant les données réactives de notre application
        return {
            titrePage: 'Résultat de la course', // Propriété pour stocker le titre de la page
            nbParticipantsInput: '', // Propriété pour stocker la valeur de l'input du nombre de participants
            nomGagnantInput: '', // Propriété pour stocker la valeur de l'input du nom du gagnant
            participants: [] // Propriété pour stocker le tableau des données des participants récupérées
        };
    },
    mounted() { // Le hook de cycle de vie mounted est appelé une fois que le composant Vue est monté dans le DOM
        fetch('./data/resultat10000metres.json') // Utilise l'API fetch pour récupérer les données depuis le fichier JSON
            .then(response => { // Première promesse : gère la réponse de la requête
                if (!response.ok) { // Vérifie si la réponse a un statut d'erreur (par exemple, 404)
                    throw new Error(`HTTP error! status: ${response.status}`); // Lance une erreur si la réponse n'est pas OK
                }
                return response.json(); // Si la réponse est OK, parse le corps de la réponse en JSON et retourne une nouvelle promesse
            })
            .then(data => { // Deuxième promesse : gère les données JSON récupérées
                this.participants = data; // Assigne les données JSON récupérées au tableau 'participants' dans notre instance Vue
                this.nbParticipantsInput = `${data.length} participants`; // Met à jour l'input du nombre de participants avec la taille du tableau de données
                this.findWinner(); // Appelle la méthode pour déterminer et afficher le gagnant
            })
            .catch(error => { // Gère toute erreur survenue lors de la requête ou du traitement des données
                console.error('Erreur lors de la récupération des données:', error); // Affiche l'erreur dans la console
            });
    },
    computed: { // La section 'computed' contient des propriétés calculées dont la valeur est mise en cache et se recalcule automatiquement lorsque leurs dépendances changent
        sortedParticipants() { // Propriété calculée qui retourne une copie triée du tableau 'participants' par temps
            return [...this.participants].sort((a, b) => a.temps - b.temps); // Crée une nouvelle copie du tableau 'participants' avec l'opérateur de décomposition (...) et la trie en utilisant la méthode 'sort'. La fonction de comparaison (a, b) => a.temps - b.temps trie les participants par temps croissant.
        },
        formattedParticipants() { // Propriété calculée qui mappe le tableau trié pour formater les données avant l'affichage dans le tableau HTML
            return this.sortedParticipants.map(participant => ({ // Utilise la méthode 'map' pour créer un nouveau tableau d'objets formatés
                pays: participant.pays, // Récupère le pays du participant
                nom: this.getNom(participant.nom), // Appelle la méthode 'getNom' pour extraire le nom de famille du nom complet
                prenom: this.getPrenom(participant.nom), // Appelle la méthode 'getPrenom' pour extraire le prénom du nom complet
                tempsFinal: this.formatTemps(participant.temps) // Appelle la méthode 'formatTemps' pour formater le temps en minutes et secondes
            }));
        }
    },
    methods: { // La section 'methods' contient des fonctions qui peuvent être appelées depuis le template HTML ou d'autres parties du script
        findWinner() { // Méthode pour déterminer le gagnant et mettre à jour l'input correspondant
            if (this.sortedParticipants.length > 0) { // Vérifie s'il y a des participants dans le tableau trié
                this.nomGagnantInput = `Gagnant : ${this.sortedParticipants[0].nom}`; // Le gagnant est le premier participant dans le tableau trié (car il est trié par temps croissant)
            }
        },
        formatTemps(tempsEnSecondes) { // Méthode pour formater un temps en secondes en une chaîne de caractères "MMminSSs"
            const minutes = Math.floor(tempsEnSecondes / 60); // Calcule le nombre de minutes entières
            const secondes = tempsEnSecondes % 60; // Calcule le nombre de secondes restantes
            const minutesFormattees = minutes < 10 ? '0' + minutes : minutes; // Ajoute un zéro devant les minutes si elles sont inférieures à 10
            const secondesFormattees = secondes < 10 ? '0' + secondes : secondes; // Ajoute un zéro devant les secondes si elles sont inférieures à 10
            return `${minutesFormattees}min${secondesFormattees}s`; // Retourne la chaîne de caractères formatée
        },
        getNom(fullName) { // Méthode pour extraire le nom de famille d'un nom complet (suppose que tout sauf le dernier mot est le nom)
            const nameParts = fullName.split(' '); // Divise le nom complet en un tableau de mots en utilisant l'espace comme séparateur
            if (nameParts.length > 1) { // Vérifie s'il y a plus d'un mot dans le nom
                return nameParts.slice(0, -1).join(' '); // Retourne tous les mots sauf le dernier, joints par un espace (supposé être le nom de famille)
            } else if (nameParts.length === 1) { // Vérifie s'il n'y a qu'un seul mot
                return nameParts[0]; // Retourne le seul mot (peut être le nom ou le prénom selon la convention)
            }
            return ''; // Retourne une chaîne vide si le nom est vide
        },
        getPrenom(fullName) { // Méthode pour extraire le prénom d'un nom complet (suppose que le dernier mot est le prénom)
            const nameParts = fullName.split(' '); // Divise le nom complet en un tableau de mots en utilisant l'espace comme séparateur
            if (nameParts.length > 1) { // Vérifie s'il y a plus d'un mot dans le nom
                return nameParts.slice(-1).join(' '); // Retourne le dernier mot (supposé être le prénom)
            }
            return ''; // Retourne une chaîne vide s'il n'y a qu'un seul mot ou si le nom est vide
        }
    }
}).mount('.course'); // Lie l'instance d'application Vue à l'élément HTML avec la classe "course"