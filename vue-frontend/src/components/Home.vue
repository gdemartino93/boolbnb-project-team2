<template>
    <div>
        <h1>Home Page</h1>
        <div v-if="authStore.user">
            <h2> Welcome {{ authStore.user.name }} {{ authStore.user.lastname }}</h2>
        </div>
        <div v-else>Go to login</div>
        
        <div class="container">

          <AptCard v-for="apartment in apartments" :apartment="apartment"/>  
        </div>
    </div>
</template>
  
<script>
import axios from 'axios';
import { useAuthStore } from '../stores/auth';

import AptCard from './AptCard.vue';



export default {
    name: 'HomePage',
    components: {
      AptCard
    },
    data() {
        return {
            // dichiariamo un istanza di useAuthstore 
            authStore : useAuthStore(),
            apartments: []
        };
    },
    methods: {

      async apartmentPrint() {
            try {
                const response = await axios.get('/api/v1/apartment/all');
                this.apartments = response.data.response.apartments;
                console.log(this.apartments);
            } catch (error) {
                // bisogna gestire l'errore della chiamata API
                // console.log(error);
            }
        },
    },
    mounted() {
        
        this.authStore.getUser(); //uso la funzione dello store di pinia
        this.apartmentPrint();
    },
};
</script>

<style scoped>
.container {
  display: flex;
  gap: 1rem;
  overflow-x: auto;
}

</style>
  