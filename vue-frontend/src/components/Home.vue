<template>
    <div>
        <h1>Home Page</h1>
        <div v-if="authStore.user">
            <h2> Welcome {{ authStore.user.name }} {{ authStore.user.lastname }}</h2>
        </div>
        <div v-else>Go to login</div>
        <ul>
            <li v-for="apartment in apartments" :key="apartment.id">
                <h1>Apartments n:{{ apartment.id }}</h1>
                
                <img :src="apartment.img" :alt="apartment.img">
                
                <h3>Nome: {{ apartment.title }}</h3>
                
                <!-- <ul>
                    <li v-for="additional_service in apartment.additional_services" :key="additional_service.id">
                        Nome:{{ additional_service.name }}
                    </li>
                </ul> -->

                <h3> Additional services: {{ apartment.additional_services.length }}</h3>
            </li>
        </ul>
    </div>
</template>
  
<script>
import axios from 'axios';
import { useAuthStore } from '../stores/auth';



export default {
    name: 'HomePage',
    data() {
        return {
            // dichiariamo un istanza di useAuthstore 
            authStore : useAuthStore(),
            apartments: [],
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
  