<template>
    <div>
        <ul>
            <RouterLink :to="{name: 'home'}">Home</RouterLink>
            <RouterLink :to="{name: 'login'}">Login</RouterLink>
            <RouterLink :to="{name: 'register'}">Register</RouterLink>
           
            <!-- <router-link :to="{name : "HomeX"}">ASDXASD</router-link> -->
            logout
        </ul>
    </div>
</template>

<script>
import { store } from '../stores/store';
export default{
    data(){
        return{
            store
        }
    }
}
</script>

<style lang="scss" scoped>

</style>