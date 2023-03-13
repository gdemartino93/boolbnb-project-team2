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
            <RouterLink class="add-apartment-link" :to="{ name: 'addApt' }">
                <a href="#">Aggiungi appartamento</a>
            </RouterLink>
            <h2 class="dashboard-title">BENVENUTO NELLA DASHBOARD {{ $route.params.id }}</h2>

            <h3 class="apartments-title">LISTA APPARTAMENTI</h3>

            <ul v-if="authStore.apartments" class="apartments-list w-75">
                <li v-for="apartment in authStore.apartments" class="apartment-item">
                    <span class="apartment-title w-100">{{ apartment.title }}</span>
                    <button class="delete-button" @click="deleteApartment(apartment)">Elimina</button>
                    <router-link class="edit-link" :to="{ name: 'editApt', params: { id: `${apartment.id}` } }">
                        <button class="edit-button">Modifica</button>
                    </router-link>
                    <button class="visible-button">Occhio</button>
                </li>
            </ul>

        </section>
        <section v-else>
            <h1 class="text-danger">
                non autenticato
            </h1>
        </section>
    </div>
</template>

<style lang="scss" scoped>
.container {
    margin-top: 150px;

    .dashboard-section {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        margin-bottom: 20px;


        .add-apartment-link {
            background-color: #f2f2f2;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
        }

        .dashboard-title {
            font-size: 24px;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .apartments-title {
            font-size: 20px;
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
        }

        .apartments-list {
            list-style: none;
            margin: 0 auto;
            padding: 0
        }

        .apartment-item {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
        }

        apartment-title {
            font-weight: bold;
        }

        .delete-button {
            background-color: #ff385c;
            margin-right: 10px;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .edit-button {
            background-color: #ff385c;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .visible-button {
            background-color: #ff385c;
            margin-left: 10px;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }
    }
}
</style>