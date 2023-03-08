<script>
import { ref } from 'vue';
import { store } from '../../stores/store'
import { useAuthStore } from '../../stores/auth';
import axios from 'axios';

export default {
    data() {
        return {
            auth: useAuthStore(),
            store,
            apt: {},
            services: [],
            // inserimento nuovo appartamento
            // form: ref({
            //     title: "",
            //     description: "",
            //     room_number: undefined,
            //     bed_number: undefined,
            //     bath_number: undefined,
            //     square_meters: undefined,
            //     address: "",
            //     latitude: undefined,
            //     longitude: undefined,
            //     img: "",
            //     additional_services: []
            // }),

        }
    },
    methods: {
        async storeData(e) {
            e.preventDefault();
            await this.auth.getToken();
            try {

                await axios.post('/api/v1/apartment/store', this.form)
            } catch (error) {

                console.log(error)
            }

            this.$router.push('/');
        },
        async getServices() {
            try {

                const response = await axios.get('api/v1/services/all');
                this.services = response.data.response;
                console.log(this.services);
            } catch (error) {

                console.log(error);
            }
        },
        async getSingleAp(id) {
            try {
                const response = await axios.get('/api/v1/apartment/' + id)
                this.apt = response.data.response;
                this.services = response.data.response.additional_services;


            } catch (error) {
                console.log(error)
            }

        },
    },
    mounted() {
        this.getSingleAp(this.$route.params.id);
        this.getServices();
    }

}
</script>

<template>
    <h2>Form</h2>
    <form action="" method="POST">
        <label for="title">Title</label>
        <input type="text" name="title" :value="apt.title">
        <br>

        <label for="description">Description</label>
        <input type="text" name="description" :value="apt.description">
        <br>

        <label for="room_number">Room Number</label>
        <input type="number" name="room_number" :value="apt.room_number">
        <br>

        <label for="bed_number">Bed Number</label>
        <input type="number" name="bed_number" :value="apt.bed_number">
        <br>

        <label for="bath_number">Bath Number</label>
        <input type="number" name="bath_number" :value="apt.bath_number">
        <br>

        <label for="square_meters">Square Meters</label>
        <input type="number" name="square_meters" :value="apt.square_meters">
        <br>

        <label for="address">Address</label>
        <input type="text" name="address" :value="apt.address">
        <br>

        <label for="latitude">Latitude</label>
        <input type="number" name="latitude" :value="apt.latitude">
        <br>

        <label for="longitude">Longitude</label>
        <input type="number" name="longitude" :value="apt.longitude">
        <br>

        <label for="img">Image</label>
        <input type="text" name="img" :value="apt.img">
        <br>
        <!-- <p>{{ apt.additional_services }}</p> -->
        <div v-for="(service, index) in services.additional_service" :key="service.id">

            <input type="checkbox" :id="service.id" :value="service.id" v-model="services.additional_services">

            <label :for="service.name"> {{ service.name }} </label>

        </div>

        <br>

        <!-- <router-link :to="{name: 'home'}" > -->
        <input @click="" type="submit" value="Update Apartment">
        <!-- </router-link> -->
    </form>
</template>

<style scoped></style>