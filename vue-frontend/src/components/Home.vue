<template>
    <div>
        
        <div v-if="authStore.user">
            <h2 class="mt-5"> Welcome {{ authStore.user.name }} {{ authStore.user.lastname }}</h2>
        </div>
        <div v-else class="mt-5">Go to login</div>

        <router-link :to="{name: 'advancedSearch'}">Vai alla ricerca</router-link>

        <div class="container">

            <AptCard v-for="apartment in apartments" :apartment="apartment" />
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
        AptCard,
        Map
    },
    data() {
        return {
            // dichiariamo un istanza di useAuthstore 
            authStore: useAuthStore(),
            apartments: []
        };
    },
    methods: {
        // Igor ha detto che questa parte dovrebbe andare in Pinia, perchè altrimenti non avrebbe senso installarla :)
        async apartmentPrint() {
            try {
                const response = await axios.get('/api/v1/apartment/all');
                this.apartments = response.data.response.apartments;
            } catch (error) {
                
                console.log(error);
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


</style>
  