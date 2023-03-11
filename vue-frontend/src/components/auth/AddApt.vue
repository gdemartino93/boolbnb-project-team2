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
            services: [],
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
        async getServices() {
            try {
                const response = await axios.get('api/v1/services/all');
                this.services = response.data.response;
                console.log(this.services);
            } catch (error) {
                console.log(error);
            }
        },
        onFileChange(e) {
            const file = e.target.files[0];
            this.form.img = file;
        },
        async storeData(e) {
            e.preventDefault();
            await this.auth.getToken();
            this.store.getCohordinates(this.form.address);
            this.form.latitude = this.store.latitude;
            this.form.longitude = this.store.longitude;
            try {
                const formData = new FormData();
                formData.append('title', this.form.title);
                formData.append('description', this.form.description);
                formData.append('room_number', this.form.room_number);
                formData.append('bed_number', this.form.bed_number);
                formData.append('bath_number', this.form.bath_number);
                formData.append('square_meters', this.form.square_meters);
                formData.append('address', this.form.address);
                formData.append('latitude', this.form.latitude);
                formData.append('longitude', this.form.longitude);
                formData.append('img', this.form.img);
                formData.append('additional_services', this.form.additional_services);
                await axios.post('/api/v1/apartment/store', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
            } catch (error) {
                console.log(error)
            }
            this.$router.push('/');
        },
        
    },
    mounted() {
        this.getServices();
    }
}
</script>

<template>
    <section v-if="auth.user">
        <h2>Form</h2>
        <form action="" method="POST" enctype="multipart/form-data">
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

            <label for="img">Image</label>
            <input type="file" name="img" v-on:change="onFileChange" ref="img" accept="image/*">
            <br>

            <div v-for="service in services.additional_service" :key="service.id">

                <input type="checkbox" :id="service.id" :value="service.id" v-model="form.additional_services">

                <label :for="service.name"> {{ service.name }} </label>
            </div>

            <br>

            <!-- <router-link :to="{name: 'home'}" > -->
            <input @click="storeData" type="submit" value="Create New Apartment">
            <!-- </router-link> -->
        </form>
    </section>
    <section v-else>
        <h1 class="text-danger">NON AUTENTICATO</h1>
    </section>
</template>

<style scoped></style>