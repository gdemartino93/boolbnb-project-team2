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
        async storeData(e) {
            e.preventDefault();

            this.store.getCohordinates(this.form.address);

            this.form.latitude = this.store.latitude;
            this.form.longitude = this.store.longitude;
            await this.auth.getToken();

            console.log(this.form);

            try {
                
                await axios.post('/api/v1/apartment/store', this.form)
            } catch (error) {
                
                console.log(error)
            }
            
            this.$router.push('/');
        },
        async getServices(){
            try {
                
                const response = await axios.get('api/v1/services/all');
                this.services = response.data.response;
                console.log(this.services);
            } catch (error) {
                
                console.log(error);
            }
        },
        
    },
    mounted(){

        this.getServices();
    }

}
</script>

<template>
    <section v-if="auth.user">
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

            <!-- <label for="latitude">Latitude</label>
            <input type="number" name="latitude" v-model="form.latitude">
            <br>

            <label for="longitude">Longitude</label>
            <input type="number" name="longitude" v-model="form.longitude">
            <br> -->

            <label for="img">Image</label>
            <input type="text" name="img" v-model="form.img">
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