<script>
import { useAuthStore } from '../../stores/auth';
import axios from 'axios';

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

            <h3 class="apartments-title"></h3>

            <ul v-if="authStore.apartments" class="apartments-list w-75">
                <li v-for="apartment in authStore.apartments" class="apartment-item">
                    <span class="apartment-title w-100">{{ apartment.title }}</span>
                    <button class="delete-button btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2"
                        @click="deleteApartment(apartment)">Elimina</button>
                    <router-link class="edit-link" :to="{ name: 'editApt', params: { id: `${apartment.id}` } }">
                        <button
                            class="edit-button btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2">Modifica</button>
                    </router-link>
                    <button class="visible-button btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2">
                        <font-awesome-icon :icon="faEyeSlash" />
                    </button>
                    <Map :address="apartment.address" />
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
    <div class="col-md-6 bg-image">
        <img src="https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="" class="img-r">
    </div>
</template>

<style lang="scss" scoped>
.container {
    margin: 100px auto 0 0px;
    width: 60%;

    .dashboard-section {
        background-color: #f8f9fa;
        margin-bottom: 20px;


        .add-apartment-link {
            // background-color: #f2f2f2;
            // color: white;
            // padding: 10px;
            // border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            margin-bottom: 20px;
            display: inline-block;
        }

        .dashboard-title {
            font-size: 35px;
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-start;
            color: #ff385c;
        }

        .apartments-title {
            font-size: 20px;
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
        }

        .apartments-list {
            list-style: none;
            // margin: 0 auto;
            padding: 0
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
            // background-color: #ff385c;
            margin-right: 10px;
            // color: white;
            // border: none;
            // border-radius: 5px;
            // padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .edit-button {
            // background-color: #ff385c;
            margin-right: 10px;
            // color: white;
            // border: none;
            // border-radius: 5px;
            // padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .visible-button {
            // background-color: #ff385c;
            margin-right: 10px;
            // color: white;
            // border: none;
            // border-radius: 5px;
            // padding: 5px 10px;
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
                // background-color: red;
                top: 10px;
            }

            50% {
                // background-color: red;
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