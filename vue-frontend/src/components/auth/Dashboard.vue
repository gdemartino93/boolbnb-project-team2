<script>
import { useAuthStore } from '../../stores/auth';
import axios from 'axios';
import { ref } from 'vue';

export default {
    data() {
        return {
            authStore: useAuthStore(),

        }
    },
    methods: {

        deleteApartment(apartment) {
            axios.delete('/api/v1/apartment/delete/' + apartment.id)
                .then(res => {

                    const data = res.data;
                    const success = data.success;

                    if (success) {
                        this.authStore.getUsersWithApt();
                    }
                })
                .catch(err => console.log);
        },
        async toggleVisibility(id) {
            try {
                await axios.get(`/api/v1/apartment/${id}/visibility`)
            } catch (error) {
                console.log(error)
            }
        }
    },
    mounted() {
        this.authStore.getUsersWithApt();
    }
}
</script>

<template>
    <div class="container">
        <section class="dashboard-section" v-if="authStore.user">
            <h2 class="dashboard-title">I tuoi appartamenti {{ $route.params.id }}</h2>

            <RouterLink class="add-apartment-link" :to="{ name: 'addApt' }">
                <a href="#" class="btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2">Aggiungi
                    appartamento</a>
            </RouterLink>

            <h3 class="apartments-title"></h3>

            <ul v-if="authStore.apartments" class="apartments-list w-75">
                <li v-for="(apartment, index) in authStore.apartments" class="apartment-item">
                    <span class="apartment-title w-100">{{ apartment.title }}</span>
                    <button class="delete-button btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2"
                        @click="deleteApartment(apartment)">Elimina</button>
                    <router-link class="edit-link" :to="{ name: 'editApt', params: { id: `${apartment.id}` } }">
                        <button
                            class="edit-button btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2">Modifica</button>
                    </router-link>
                    <button class="visible-button btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2"
                        @click="toggleVisibility(apartment.id)">
                        {{ apartment.visible ? 'Nascondi' : 'Mostra' }}
                    </button>
                </li>
            </ul>

            <RouterLink class="add-apartment-link" :to="{ name: 'addApt' }">
                <a href="#" class="btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-3">Aggiungi
                    appartamento</a>
            </RouterLink>

        </section>
        <section class="autenticato" v-else>
            <h1 class="text-danger">Non Autenticato</h1>
            <h2>Effettua il Login</h2>
        </section>
    </div>
</template>

<style lang="scss" scoped>
.container {
    margin: 100px auto 0 auto;
    width: 100%;
    height: 100vh;

    .dashboard-section {
        background-color: #f8f9fa;
        margin-bottom: 20px;

        .dashboard-title {
            font-size: 35px;
            color: #ff385c;
        }

        .add-apartment-link {
            text-decoration: none;
            margin-top: 20px;
            margin-bottom: 20px;
            display: inline-block;
        }

        .apartments-title {
            font-size: 20px;
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
        }

        .image {
            img {
                width: 100%;
                height: 100%;
            }
        }

        .apartments-list {
            list-style: none;
        }

        .apartment-item {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border-bottom: 1px solid #dcd2d2;
        }

        apartment-title {
            font-weight: bold;
        }

        .delete-button {
            margin-right: 10px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .edit-button {
            margin-right: 10px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .visible-button {
            margin-right: 10px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }
    }

    .autenticato {
        width: 50%;
        text-align: center;
        margin: 100px auto 0 auto;
        position: relative;
        animation-name: animation;
        animation-duration: 0.5s;

        @keyframes animation {
            0% {
                top: 10px;
            }

            50% {
                top: 0px;
            }

            75% {
                top: 10px;
            }

            100% {
                top: 0px;
            }
        }
    }
}
</style>