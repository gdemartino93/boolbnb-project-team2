<script>
import { useAuthStore } from '../../stores/auth';
import axios from 'axios';

export default {
    data() {
        return {
            authStore: useAuthStore(),
        }
    },
    methods: {

        deleteApartment(apartment) {
            axios.delete('/api/v1/apartment/delete/' + apartment.id)
                .then(res => {

                    const data = res.data;
                    const success = data.success;

                    if (success) {
                        this.authStore.getUsersWithApt();
                    }
                })
                .catch(err => console.log);
        },
    },

    mounted() {
        this.authStore.getUsersWithApt();
    }
}
</script>

<template>
    <section v-if="authStore.user">
        <RouterLink :to="{ name: 'addApt' }">
        <a href="#">Aggiungi appartamento</a>
    </RouterLink>
    <h2>CIAO SEI NELLA DASHBOARD {{ $route.params.id }}</h2>

    <h3>List of apartments</h3>

    <ul v-if="authStore.apartments">
        <li v-for="apartment in authStore.apartments">
            {{ apartment.title }}
            <button @click="deleteApartment(apartment)">Elimina</button>
            <RouterLink :to="{ name: 'editApt', params: { id: `${apartment.id}` } }">
                <button @click="">Modifica Appartamento</button>
            </RouterLink>
        </li>
    </ul>

    </section>
    <section v-else>
        <h1 class="text-danger">
            non autenticato
        </h1>
    </section>
    
</template>

<style scoped></style>