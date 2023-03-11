<template>
    <div>
        <input type="search" name="searchBar" placeholder="Cosa stai cercando?">
        <button>Search</button>
        <Map :center="{ lat: 41.902782, lon: 12.496366 }" :flats="flats" />
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
import Map from './Map/Map.vue';
import AptCard from './AptCard.vue';




export default {
    name: 'HomePage',
    components: {
      AptCard,
      Map
    },
    data() {
        return {
            // dichiariamo un istanza di useAuthstore 
            authStore : useAuthStore(),
            apartments: []
        };
    },
    methods: {
        // Igor ha detto che questa parte dovrebbe andare in Pinia, perchè altrimenti non avrebbe senso installarla :)
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

<style lang="scss" scoped>
.container {
  display: flex;
  gap: 1rem;
  overflow-x: auto;
}

input {
    width: 80%;
    margin-left: 2rem;    
    padding-left: .5rem;
    border-radius: 16px 0 16px 0;
    // appearance: none;
    // border: none;
    // outline: none;
    background: none;
    background-color: rgba(255, 255, 255, .35);
    transition: 0.4s;

    &:focus {
        border-radius: 0 16px 0 16px;
        background-color: rgba(255, 255, 255, .75);
    }
    
}

button {
    margin-left: 2rem;
    padding: 0.5rem;
    appearance: none;
    border: none;
    outline: none;
    border-radius: 16px 0 16px 0;
    transition: 0.4s;
    
    &:hover {
        border-radius: 0 16px 0 16px;
    }
}
</style>
  