<template>
    <nav>
        <ul>
            <RouterLink :to="{name: 'home'}">Home</RouterLink>

            <div v-if="!authStore.user" class="d-flex mx-2">
                <RouterLink :to="{name: 'login'}">Login</RouterLink> <br>
                <RouterLink :to="{name: 'register'}" class="mx-2">Register</RouterLink>
            </div>
            <div v-else class="d-flex">
                <RouterLink :to="{ name: 'dashboard', params: {id: `${authStore.user.id}`} }">Dashboard</RouterLink>
                
                <button @click="authStore.handleLogout">Logout</button>

            </div>
        </ul>
    </nav>
</template>

<script>
import { useAuthStore } from '../stores/auth';
import { store } from '../stores/store';

export default{
    data(){
        return{
            store,
            authStore : useAuthStore(),
        }
    }
}
</script>

<style scoped>
nav{
    display: flex;
}
ul{
    display: flex;
}
</style>