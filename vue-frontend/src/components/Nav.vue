<template>
    <div>
        <ul>
            <RouterLink :to="{name: 'home'}">Home</RouterLink>

            <div v-if="!authStore.user">
                <RouterLink :to="{name: 'login'}">Login</RouterLink> <br>
                <RouterLink :to="{name: 'register'}">Register</RouterLink>
            </div>
            <div v-else>
                <RouterLink :to="{ name: 'dashboard', params: {id: `${authStore.user.id}`} }">Dashboard</RouterLink>
                
                <button @click="authStore.handleLogout">Logout</button>

            </div>
        </ul>
    </div>
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

<style lang="scss" scoped>

</style>