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
        <ul>
            <li v-for="apartment in apartments" :key="apartment.id">
                <h1>Apartments n:{{ apartment.id }}</h1>
                Nome: {{ apartment.title }}
                <ul>
                    <li v-for="additional_service in apartment.additional_services" :key="additional_service.id">
                        Nome:{{ additional_service.name }}
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>
  
<script>
import { ref } from 'vue';
import axios from 'axios';
axios.defaults.baseURL = "http://localhost:8000";

export default {
    name: 'HomePage',
    data() {
        return {
            user: null,
            apartments: [],
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
                    console.log(error);
                }
            }
        },
        async apartmentPrint() {
            try {
                const response = await axios.get('/api/v1/apartment/all');
                this.apartments = response.data.response.apartments;
                console.log(this.apartments);
            } catch (error) {
                // gestiamo l'errore nel caso l'utente non sia loggato per non fare crashare la nostra applicazione
                console.log(error);
            }
        },
    },
    mounted() {
        this.fetchUser();
        this.apartmentPrint();

    },
};
</script>
  