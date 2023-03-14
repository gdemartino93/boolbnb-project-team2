<template>
    <nav>
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
            // logo: process.env.BASE_URL + 'logo.png'
        }
    }
}
</script>

<style lang="scss" scoped>
@use '../assets/main.css';
nav {
    background-color:var(--b-1);

    .link {
        color: black;
        text-decoration: none;

        img {
            width: 30%;
        }
    }
}
</style>