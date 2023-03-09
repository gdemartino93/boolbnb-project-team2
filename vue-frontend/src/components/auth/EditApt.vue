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
            adds: [],
            formUpdate: {}

        }
    },
    methods: {
        async updateData(apartment) {
            await this.auth.getToken();
            try {
                console.log(this.apt);
                this.formUpdate = this.apt;
                await axios.post('api/v1/apartment/update/' + apartment.id, this.formUpdate)
            } catch (error) {

                console.log(error)
            }

            this.$router.push('/');
        },
        async getServices() {
            try {

                const response = await axios.get('api/v1/services/all');
                this.adds = response.data.response;
            } catch (error) {

                console.log(error);
            }
        },
        async getSingleAp(id) {
            try {
                const response = await axios.get('/api/v1/apartment/' + id)
                this.apt = response.data.response;

                console.log(this.apt);
            } catch (error) {
                console.log(error)
            }

        },
        checkCheckboxes(apartment, addService){

            // Ciclo for che verifica ad ogni iterazione se l'elemento x dell'array additional_services in apartment ha id uguale a quello del singolo servizio, sono state usate due variabili generiche apartment e addService 
            for(let x = 0; x < apartment.additional_services.length; x++ ){

                const apartmentAdds = apartment.additional_services[x];

                if(apartmentAdds.id == addService.id){

                    return true;
                }
            }

            return false;
        }
    },
    mounted() {
        this.getSingleAp(this.$route.params.id);
        this.getServices();
        
    }

}
</script>

<template>  
    <section v-if="auth.user">
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
            <input type="number" name="bath_number" :value="apt.bath_number" >
            <br>

            <label for="square_meters">Square Meters</label>
            <input type="number" name="square_meters" :value="apt.square_meters" >
            <br>

            <label for="address">Address</label>
            <input type="text" name="address" :value="apt.address" >
            <br>

            <label for="latitude">Latitude</label>
            <input type="number" name="latitude" :value="apt.latitude" >
            <br>

            <label for="longitude">Longitude</label>
            <input type="number" name="longitude" :value="apt.longitude" >
            <br>

            <label for="img">Image</label>
            <input type="text" name="img" :value="apt.img" >
            <br>        
            
            <div v-for="service in adds.additional_service" :key="service.id">
                <input type="checkbox" :id="service.id" :value="service.id" :checked="checkCheckboxes(apt, service)">
                <label :for="service.name"> {{ service.name }} </label>
            </div>

            <br>

            <input @click.prevent="updateData(apt)" type="submit" value="Update Apartment">
        </form>
    </section>
    <section v-else>
        <h1 class="text-danger">NON AUTENTICATO</h1>
    </section>


</template>

<style scoped></style>