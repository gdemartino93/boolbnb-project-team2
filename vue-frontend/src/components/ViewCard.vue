<script>
import axios from 'axios';


export default {
    props: ['apartment'],
    data() {
        return {

            apartments: [],
            thisApartment: {

            }
        }
    },
    methods: {

        async getAllData() {

            try {
                const response = await axios.get('/api/v1/apartment/all');
                this.apartments = response.data.response.apartments;
                console.log(this.apartments);
            } catch (error) {
                // bisogna gestire l'errore della chiamata API
                // console.log(error);
            }
        },

        destinationId() {

            return parseInt(this.$route.params.id)
        },
        destination() {

            return this.apartments.find(x => apartment.id === this.apartment.id)
        },
        fillObj() {

            return this.thisApartment = this.destination();
        }
    },
    mounted() {
        this.destinationId();
        this.destination();
        this.getAllData();
    }


}
</script>

<template>
    <h3>Id: {{ $route.params.id }}</h3>
    <ul>
        <img :src="$route.params.img" alt="apartment image">

        <li>Title: {{ $route.params.title }}</li>
        <li>Description: {{ $route.params.description }}</li>
        <li>Room Number: {{ $route.params.room_number }}</li>
        <li>Bed Number: {{ $route.params.bed_number }}</li>
        <li>Bath Number: {{ $route.params.bath_number }}</li>
        <li>Square Meters: {{ $route.params.square_meters }}</li>
        <li>Address: {{ $route.params.address }}</li>
        <li>Latitude: {{ $route.params.latitude }}</li>
        <li>Longitude: {{ $route.params.longitude }}</li>
        <!-- <li>Visible: {{ $route.params.visible }}</li> -->
    </ul>
</template>

<style scoped></style>
