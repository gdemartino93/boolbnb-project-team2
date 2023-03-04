<template>
    <div>
        <h1>login</h1>
        <form class="d-flex" @submit.prevent="handleRegister">
            <label for="name">Nome</label>
            <input type="text" name="name" v-model="form.name">

            <label for="surname">Cognome</label>
            <input type="text" name="surname" v-model="form.surname">

            <label for="date">Data di nascita</label>
            <input type="date" name="dateOB" v-model="form.dateOB" >

            <label for="email">Email</label>
            <input type="text" name="email" v-model="form.email" >

            <label for="email">Password</label>
            <input type="password" name="password" v-model="form.password">

            <!-- <label for="email">Repeat Password</label>
            <input type="password" name="password_confirmation" v-model="form.password_confirmation"> -->

            <button type="submit" class="">Login</button>
        </form>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.withCredentials = true;

const router = useRouter();
// colleghiamo i dati agli input del form tramite v-model e creiamo un oggetto con quei dati
const form = ref({
    name : "",
    surname : "",
    dateOB : "",
    email : "",
    password : "",

});
// csrf protection laravel documentation
const getToken = async () =>{
    await axios.get('/sanctum/csrf-cookie')
};
// facciamo la chiamta api per la registrazzione
const handleRegister = async () =>{
    await getToken(); // ottieni il token CSRF prima di effettuare la richiesta
    await axios.post('/register',{
        // passiamo al backend l'oggetto che che abbiamo creato con i dati presi dal form
        name : form.value.name,
        surname : form.value.surname,
        dateOB : form.value.dateOB,
        password : form.value.password,
        password_confirmation : form.value.password_confirmation
    })
    router.push('/');
}

</script>

<style lang="scss" scoped>
.d-flex{
    display: flex;
    flex-direction: column;
    width: 500px;
    margin: 0 auto;
}
</style>