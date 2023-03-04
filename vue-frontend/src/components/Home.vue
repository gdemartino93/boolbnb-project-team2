<template>
    <div>
        <h1>Home Page</h1>
        <template v-if="user !== null">
            <template v-if="user">
                <h2>{{ user.name }}</h2>
            </template>
            <template v-else>
                <p>Please log in to see your profile.</p>
            </template>
        </template>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.withCredentials = true;

const user = ref(null);
onMounted(async () => {
    try {
        const response = await axios.get('/api/user');
        user.value = response.data;
    } catch (error) {
        // gestiamo l'errore nel caso l'utente non sia loggato per non fare crashare la nostra applicazione
        if (error.response.status === 401) {
            user.value = null;
            // se il problema non è l'utente non loggato allora AMEN, leggi il console logs
        } else {
            user.value = null;
            console.error(error);
        }
    }
});
</script>
