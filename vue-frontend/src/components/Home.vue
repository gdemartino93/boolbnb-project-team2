<template>
    <div>
      <h1>Home Page</h1>
      <div v-if="user !== null">
        <div v-if="user">
          <h2>{{ user.name }}</h2>
        </div>
        <div v-else>
          <p>Please log in to see your profile.</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  
  export default {
    name: 'HomePage',
    data() {
      return {
        user: null,
      };
    },
    methods: {
      async fetchUser() {
        try {
          const response = await axios.get('/api/user');
          this.user = response.data;
        } catch (error) {
          // gestiamo l'errore nel caso l'utente non sia loggato per non fare crashare la nostra applicazione
          if (error.response.status === 401) {
            this.user = null;
            // se il problema non è l'utente non loggato allora AMEN, leggi il console logs
          } else {
            this.user = null;
            console.error(error);
          }
        }
      },
    },
    mounted() {
      this.fetchUser();
    },
  };
  </script>
  