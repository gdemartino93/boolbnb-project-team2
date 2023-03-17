<template>
    <nav class="d-flex justify-center align-items-center">
        <section class="container">
            <div class="d-flex justify-content-between">
                <RouterLink class="link" :to="{ name: 'home' }">
                    <img src="/logo.png" class="mb-1" alt="boolbnb-logo">
                </RouterLink>
                <section v-if="!authStore.user" class="d-flex justify-content-end align-items-center">
                    <div class="d-none d-md-block">
                        <RouterLink class="link mx-3 btn btn-primary btn-block text-uppercase rounded-pill shadow-sm"
                            :to="{ name: 'login' }">Login</RouterLink>
                        <RouterLink class="link mx-3 btn btn-primary btn-block text-uppercase rounded-pill shadow-sm"
                            :to="{ name: 'register' }">Register</RouterLink>
                    </div>
                    <div class="d-md-none">
                        <font-awesome-icon icon="fa-solid fa-bars" class="fs-1" />
                    </div>

                </section>

                <div v-else class="d-flex justify-content-end align-items-center">

                    <div>

                        <RouterLink :to="{ name: 'inbox'}">

                            <font-awesome-icon id="inbox" class="rounded-circle p-2 text-white me-4" 
                            icon="fa-solid fa-message" />
                        </RouterLink>
                    </div>

                    <div class="profile d-flex algin- ">
                        <span class="fw-bold username d-none d-xl-block align-self-center">{{ authStore.user.name }}</span>
                        <div class="dropdown">
                            <img src="/avatar1.png" class=" mx-2 rounded-circle dropdown-toggle" alt="Avatar"
                                data-bs-toggle="dropdown" aria-expanded="false" />
                            <ul class="dropdown-menu">
                                <!-- item dropdown menu -->
                                <li>
                                    <RouterLink class="dropdown-item link" :to="{ name: 'addApt' }">
                                        Aggiungi Appartamento
                                    </RouterLink>
                                </li>

                                <li>
                                    <RouterLink class="dropdown-item link"
                                        :to="{ name: 'dashboard', params: { id: `${authStore.user.id}` } }">
                                        Dashboard
                                    </RouterLink>
                                </li>
                                <li>
                                    <button class="dropdown-item" @click="authStore.handleLogout">Logout</button>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </nav>
</template>

<script>
import { useAuthStore } from '../stores/auth';
import { store } from '../stores/store';
import 'bootstrap/dist/js/bootstrap.bundle.min.js'

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
    border-bottom: 1px solid #dcd2d2;


    img {
        width: 30%;
    }

    .dropdown {
        z-index: 1;
    }

}

#inbox {

    background-color: #FF6E31;
    cursor: pointer;
}

.profile {
    img {
        width: 40px;
        cursor: pointer;
    }

    .username {
        color: var(--b-4);
    }
}
</style>