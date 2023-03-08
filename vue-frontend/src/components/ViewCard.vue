<script>
import { useAuthStore } from '../stores/auth';
import axios from 'axios';
export default {
    data() {
        return {

            authStore: useAuthStore(),
            apt: {},
            services: []
        }
    },
    methods: {
        async getSingleAp(id) {
            try {
                const response = await axios.get('/api/v1/apartment/' + id)
                this.apt = response.data.response;
                this.services = response.data.response.additional_services;


            } catch (error) {
                console.log(error)
            }

        }
    },
    mounted() {
        this.getSingleAp(this.$route.params.id);
        this.authStore.getUsersWithApt();
    }
}
</script>

<template>
    <ul>
        <li>Id: {{ apt.id }}</li>
        <li><img :src="apt.img" :alt="apt.img"></li>
        <li>Title: {{ apt.title }}</li>
        <li>Description: {{ apt.description }}</li>
        <li>Room Number: {{ apt.room_number }}</li>
        <li>Bed Number: {{ apt.bed_number }}</li>
        <li>Bath Number: {{ apt.bath_number }}</li>
        <li>Square Meters: {{ apt.square_meters }}</li>
        <li>Address: {{ apt.address }}</li>
        <li>Latitude: {{ apt.latitude }}</li>
        <li>Longitude: {{ apt.longitude }}</li>
    </ul>
    <h6>Additional Services</h6>
    <ul v-for="service in services">
        <li>Name: {{ service.name }}</li>
        <!-- <li>Description: {{ service.description }}</li> -->
    </ul>
</template>
  

<style scoped></style>
