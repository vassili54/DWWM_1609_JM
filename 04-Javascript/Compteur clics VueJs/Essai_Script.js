// Essai_Script.js
const { createApp } = Vue;

createApp({
  data() {
    return {
      message: 'Compteur de clics avec Vue.js',
      count: 0
    };
  },
  methods: {
    incrementCounter() {
      this.count++;
    },
    resetCounter() {
        this.count = 0;
    }
  }
}).mount('#app');