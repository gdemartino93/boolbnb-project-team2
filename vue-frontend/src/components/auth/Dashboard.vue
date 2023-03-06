<script>
import { useAuthStore } from '../../stores/auth';

export default {
    data() {
        return {

            authStore: useAuthStore(),
        }
    },
    methods: {
    },
    mounted() {

        this.authStore.getUsersWithApt();
    }
}
</script>

<template>
    <!-- <RouterLink :to="{ name: 'addApt' }"> -->
    <a href="#">Aggiungi appartamento</a>

    <h2>CIAO SEI NELLA DASHBOARD {{ $route.params.id }}</h2>

    <h3>List of apartments</h3>

    <ul v-if="authStore.apartments">
        <li v-for="apartment in authStore.apartments"> {{ apartment.title }}</li>
    </ul>

    <h2>Form</h2>
    <form action="">
        <label for="title">Title</label>
        <input type="text" name="title">
        <br>

        <label for="description">Description</label>
        <input type="text" name="description">
        <br>

        <label for="room_number">Room Number</label>
        <input type="number" name="room_number">
        <br>

        <label for="bed_number">Bed Number</label>
        <input type="number" name="bed_number">
        <br>

        <label for="bath_number">Bath Number</label>
        <input type="number" name="bath_number">
        <br>

        <label for="square_meters">Square Meters</label>
        <input type="number" name="square_meters">
        <br>

        <label for="address">Address</label>
        <input type="text" name="address">
        <br>

        <label for="latitude">Latitude</label>
        <input type="number" name="latitude">
        <br>

        <label for="longitude">Longitude</label>
        <input type="number" name="longitude">
        <br>

        <label for="img">Image</label>
        <input type="url" name="img">
        <br>

        <label for="additional_services">Additional Services</label>
        <input type="text" name="additional_services">
        <br>
        <input @click="submit" type="submit" value="Create New Apartment">
    </form>

    <!-- </RouterLink> -->
</template>

<style scoped></style>