<template>
    <div>
        <h1>Home Page</h1>
        <h2>{{ user?.name }}</h2>
    </div>
</template>

<script setup>

import { ref, onMounted } from 'vue';
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.withCredentials = true;


const user = ref();
onMounted(async () =>{
    const data = await axios.get('/api/user');
    user.value = data.data
})
</script>

<style lang="scss" scoped>

</style>