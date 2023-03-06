<<<<<<< HEAD
<script >
import axios from 'axios';

export default {
    data() {
        return {
            // title: [],
            // description: [],
            // room_number: [],
            // bed_number: [],
            // bath_number: [],
            // square_meters: [],
            // address: [],
            // latitude: [],
            // longitude: [],
            // img: [],
            // additional_services_id: [],
        }
    },

    methods: {


    },

    mounted() {
        // this.updateData();
    }
};
=======
<script>
import { useAuthStore } from '../../stores/auth';

export default{
    data(){
        return{

            authStore : useAuthStore(),
        }
    },
    methods: {
    },
    mounted(){

        this.authStore.getUsersWithApt();
    }
}
>>>>>>> listOfApt
</script>

<template>
    <RouterLink :to="{ name: 'addApt' }">
        <a href="#">Aggiungi appartamento</a>
        <br>
        <form action="">
            <label for="title">title</label>
            <input type="text" name="title">
            <br>

<<<<<<< HEAD
            <label for="description">description</label>
            <input type="text" name="description">
            <br>
=======
    <h2>CIAO SEI NELLA DASHBOARD {{$route.params.id}}</h2>

    <h3>List of apartments</h3>

    <ul v-if="authStore.apartments">
    <li v-for="apartment in authStore.apartments"> {{ apartment.title }}</li>
    </ul> 
>>>>>>> listOfApt

            <label for="room_number">room number</label>
            <input type="number" name="room_number">
            <br>

            <label for="bed_number">bed number</label>
            <input type="number" name="bed_number">
            <br>

            <label for="bath_number">bath number</label>
            <input type="number" name="bath_number">
            <br>

            <label for="square_meters">square meters</label>
            <input type="number" name="square_meters">
            <br>

            <label for="address">address</label>
            <input type="text" name="address">
            <br>

            <label for="latitude">latitude</label>
            <input type="number" name="latitude">
            <br>

            <label for="longitude">longitude</label>
            <input type="number" name="longitude">
            <br>

            <label for="img">img</label>
            <input type="url" name="img">
            <br>

            <label for="additional_services_id">additional services id</label>
            <input type="text" name="additional_services_id">
            <br>
        </form>

    </RouterLink>
</template>

<style scoped></style>