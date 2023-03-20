<template>
    <nav class="d-flex justify-center align-items-center">
        <section class="container">
            <div class="d-flex justify-content-between">
                <RouterLink class="link" :to="{ name: 'home' }">
                    <img src="../assets/boolbnblogo.png" class="mb-1" alt="boolbnb-logo">
                </RouterLink>
                <section v-if="!authStore.user" class="d-flex justify-content-end align-items-center">
                    <div class="d-none d-md-block d-md-flex">
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

                            <font-awesome-icon id="inbox" class="rounded-circle p-2 me-4" 
                            icon="fa-solid fa-message" />
                        </RouterLink>
                    </div>

                    <div class="profile d-flex ">
                        <div class="dropdown">
                            <a href="#" src="/avatar1.png" class="dropdown-toggle fw-bold" alt="Avatar"
                            data-bs-toggle="dropdown" aria-expanded="false">Menu</a>
                            <ul class="dropdown-menu">
                                <!-- item dropdown menu -->
                                <li class="fw-bold username dropdown-item">{{ authStore.user.name }}</li>
                                
                                <li>
                                    <RouterLink class="dropdown-item link"
                                    :to="{ name: 'dashboard', params: { id: `${authStore.user.id}` } }">
                                    Dashboard
                                    </RouterLink>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item link">

                                        Account
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item link">

                                        Assistenza
                                    </a>
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
    width: 100%;
    height: 10vh;
    z-index: 900;
    position: fixed;
    top: 0;
    background: rgba($color: #000000, $alpha: 0.3);

    a {

        text-decoration: none;
        color: #fff;
    }

    .dropdown-item {
        color: white;
        &:hover {
            color: #ff3d00;
        }
    }

    img {
        width: 30%;
    }

    .dropdown {
        z-index: 1;

        .dropdown-menu {

            background-color: transparent;
            border: 2px solid #fff;
            
            li {
                
                color: #FF6E31;
            }
        }
    }

}

#inbox {

    border: 3px solid #fff;
    cursor: pointer;
    color: #fff;
    transition: .4s ease-in-out;

    &:hover{

        border-color: #FF6E31;
        background-color: #FF6E31;
        color: #fff;
    }
}

.profile {
    img {
        width: 40px;
        cursor: pointer;
    }

    .username {
        
        cursor: pointer;
        color: #fff;
        border-bottom: 1px solid grey;
    }
}
</style>