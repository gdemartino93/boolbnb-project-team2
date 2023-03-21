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
    <div class="dashboard d-flex">
        <div class="left col-7">
            <div class="container">
                <div class="box">
                    <div class="box-header text-center my-4">
                        <h2>Lista Appartamenti</h2>
                    </div>
                    <div class="box-body">
                        <ul v-if="authStore.apartments" class="apartments-list">
                            <li v-for="apartment in authStore.apartments" class="apartment-item">
                                <span class="apartment-title">{{ apartment.title }}</span>
                                <button
                                    class="delete-button btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2"
                                    @click="deleteApartment(apartment)">Elimina</button>
                                <router-link class="edit-link" :to="{ name: 'editApt', params: { id: `${apartment.id}` } }">
                                    <button
                                        class="edit-button btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2">Modifica</button>
                                </router-link>
                                <button
                                    class="visible-button btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2"
                                    @click="toggleVisibility(apartment.id)">
                                    {{ apartment.visible ? 'Nascondi' : 'Mostra' }}
                                </button>
                                <Map :address="apartment.address" />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="right col-5"></div>
    </div>
</template>

<style lang="scss" scoped>
.dashboard {
    padding-top: 10vh;
    background-color: #bbc6c7;
    height: 100vh;
}
.right{
    background-image: url('/dash-img.png');
}
.box-body{
    height: 75vh;
    background-color: beige;
    overflow: auto;
}
</style>