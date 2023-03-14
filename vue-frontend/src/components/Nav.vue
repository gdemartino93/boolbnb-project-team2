<template>
    <nav class="d-flex justify-center align-items-center">
        <section class="container">
            <div class="d-flex justify-content-between">

                    <RouterLink class="link" :to="{ name: 'home' }">
                        <img src="/logo.png" class="mb-1" alt="boolbnb-logo">
                    </RouterLink>



                <section v-if="!authStore.user" class="d-flex justify-content-end align-items-center">
                    <div class="d-none d-md-block">
                        <RouterLink class="link mx-3" :to="{ name: 'login' }">Login</RouterLink>
                        <RouterLink class="link mx-3" :to="{ name: 'register' }">Register</RouterLink>
                    </div>
                    <div class="d-md-none">
                        <font-awesome-icon icon="fa-solid fa-bars" class="fs-1" />
                    </div>

                </section>

                <div v-else class="d-flex justify-content-end align-items-center">
                    <RouterLink class="link mx-3" :to="{ name: 'dashboard', params: { id: `${authStore.user.id}` } }">
                        Dashboard
                    </RouterLink>

                    <button class="link mx-3" @click="authStore.handleLogout">Logout</button>

                    <div class="profile d-flex">                  
                        <span class="fw-bold username d-none d-xl-block">{{ authStore.user.name }}</span>
                        <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class=" mx-2 rounded-circle " alt="Avatar" />
                    </div>
                </div>
            </div>
        </section>

    </nav>
</template>

<script>
import { useAuthStore } from '../stores/auth';
import { store } from '../stores/store';

export default {
    data() {
        return {
            store,
            authStore: useAuthStore(),
        }
    }
}
</script>

<style lang="scss" scoped>
@use '../assets/main.css';
nav {
    // background-color:var(--b-1);
    height: 10vh;
    background-color:#f8f9fa ;
    .link {
        color: black;
        text-decoration: none;

        img {
            width: 30%;
        }
    }
}
.profile{
    img{
        width: 30px;
    }
    .username{
        color: var(--b-4);
    }
}
</style>