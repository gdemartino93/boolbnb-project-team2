<script>
import { useAuthStore } from '../../stores/auth';

export default {
    data() {
        return {

            authStore: useAuthStore(),
        }
    },
    methods: {
    },
    mounted() {

        this.authStore.getUsersWithApt();
    }
}
</script>

<template>
    <RouterLink :to="{ name: 'addApt' }">
        <a href="#">Aggiungi appartamento</a>
    </RouterLink>
    <h2>CIAO SEI NELLA DASHBOARD {{ $route.params.id }}</h2>

    <h3>List of apartments</h3>

    <ul v-if="authStore.apartments">
        <li v-for="apartment in authStore.apartments"> {{ apartment.title }}</li>
    </ul>
</template>

<style scoped></style>