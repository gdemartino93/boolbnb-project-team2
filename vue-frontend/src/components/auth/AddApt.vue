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
            // inserimento nuovo appartamento
            form: ref({
                title: "",
                description: "",
                room_number: undefined,
                bed_number: undefined,
                bath_number: undefined,
                square_meters: undefined,
                address: "",
                latitude: undefined,
                longitude: undefined,
                img: "",
                additional_services: []
            }),

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
        }
    }

}
</script>

<template>
    <h2>Form</h2>
    <form action="" method="POST">
        <label for="title">Title</label>
        <input type="text" name="title" v-model="form.title">
        <br>

        <label for="description">Description</label>
        <input type="text" name="description" v-model="form.description">
        <br>

        <label for="room_number">Room Number</label>
        <input type="number" name="room_number" v-model="form.room_number">
        <br>

        <label for="bed_number">Bed Number</label>
        <input type="number" name="bed_number" v-model="form.bed_number">
        <br>

        <label for="bath_number">Bath Number</label>
        <input type="number" name="bath_number" v-model="form.bath_number">
        <br>

        <label for="square_meters">Square Meters</label>
        <input type="number" name="square_meters" v-model="form.square_meters">
        <br>

        <label for="address">Address</label>
        <input type="text" name="address" v-model="form.address">
        <br>

        <label for="latitude">Latitude</label>
        <input type="number" name="latitude" v-model="form.latitude">
        <br>

        <label for="longitude">Longitude</label>
        <input type="number" name="longitude" v-model="form.longitude">
        <br>

        <label for="img">Image</label>
        <input type="text" name="img" v-model="form.img">
        <br>

        <div v-for="service in store.additional_services" :key="service.id">

            <input type="checkbox" :id="service.id" :value="service.id" v-model="form.additional_services">

            <label :for="service.name"> {{ service.name }} </label>
        </div>

        <br>
        <input @click="storeData" type="submit" value="Create New Apartment">
    </form>
</template>

<style scoped></style>