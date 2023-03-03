<template>
    <div>
        <h1>login</h1>
        <form @submit.prevent="handleLogin">
            <label for="email">Email</label>
            <input type="text" name="email" v-model="form.email">
            <label for="email">Password</label>
            <input type="password" name="password"  v-model="form.password">
            <button type="submit" class="">Login</button>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.withCredentials = true;

const router = useRouter();

const form = ({
    email: '',
    password : ''
});

// csrf protection laravel documentation
const getToken = async () =>{
    await axios.get('/sanctum/csrf-cookie')
};

const handleLogin = async () => {
    await getToken();
    await axios.post('/login',{
        email: form.email,
        password: form.password
    });
    router.push("/");
}
</script>

<style lang="scss" scoped>

</style>