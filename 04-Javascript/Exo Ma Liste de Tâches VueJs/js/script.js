const { createApp } = Vue;

const app = createApp({});

app.component('tache-item', {
  props: ['tache'], // On recevra un objet 'tache' en prop
  template: `
    <li>
      {{ tache.texte }}
      <button @click="$emit('supprimer', tache.id)">Supprimer</button>
    </li>
  `
});
app.component('app', {
    data() {
      return {
        nouvelleTache: '',
        taches: [
          { id: 1, texte: 'Faire les courses' },
          { id: 2, texte: 'Nettoyer la maison' }
        ],
        nextId: 3 // Pour générer des IDs uniques
      };
    },
    template: `
      <div>
        <h2>Ma Liste de Tâches</h2>
        <input type="text" v-model="nouvelleTache" placeholder="Ajouter une tâche">
        <button @click="ajouterTache">Ajouter</button>
  
        <ul>
          <tache-item
            v-for="tache in taches"
            :key="tache.id"
            :tache="tache"
            @supprimer="supprimerTache"
          ></tache-item>
        </ul>
      </div>
    `,
    methods: {
      ajouterTache() {
        if (this.nouvelleTache.trim()) {
          this.taches.push({ id: this.nextId++, texte: this.nouvelleTache });
          this.nouvelleTache = ''; // Réinitialise le champ de saisie
        }
      },
      supprimerTache(id) {
        this.taches = this.taches.filter(tache => tache.id !== id);
      }
    }
  });
  
  // Montez le composant principal 'app' sur la div#app
  app.mount('#app');