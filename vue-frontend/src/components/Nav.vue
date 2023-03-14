<template>
    <nav>
        <section class="container">
            <ul class="d-flex justify-content-between">
                <li class="d-flex">
                    <RouterLink class="link" :to="{ name: 'home' }">
                        <img src="/logo.png" class="mb-1" alt="boolbnb-logo">
                    </RouterLink>
                </li>

                <li v-if="!authStore.user" class="d-flex justify-content-end align-items-center">
                    <RouterLink class="link mx-3" :to="{ name: 'login' }">Login</RouterLink>
                    <RouterLink class="link mx-3" :to="{ name: 'register' }">Register</RouterLink>
                </li>
                <li v-else class="d-flex justify-content-end align-items-center">
                    <RouterLink class="link mx-3" :to="{ name: 'dashboard', params: { id: `${authStore.user.id}` } }">
                        Dashboard
                    </RouterLink>

                    <button class="link mx-3" @click="authStore.handleLogout">Logout</button>
                </li>
            </ul>
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
nav {
    background-color: #faf2ed;

    .link {
        color: black;
        text-decoration: none;

        img {
            width: 30%;
        }
    }
}
</style>