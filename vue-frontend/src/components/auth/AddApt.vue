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
            this.store.getCoordinates(this.form.address);

            this.form.latitude = this.store.latitude;
            this.form.longitude = this.store.longitude;

            await this.auth.getToken();
            try {

                await axios.post('/api/v1/apartment/store', this.form, {
                    headers: {

                        'Content-Type': 'multipart/form-data'
                    }
                })
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
        onFileChange(e) {
            const file = e.target.files[0];
            this.form.img = file;
        },
    },
    mounted() {

        this.getServices();
    }

}
</script>

<template class="my-template">
    <section v-if="auth.user" class="container">
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

            <label for="img">Image</label>
            <input type="file" name="img" @change="onFileChange">
            <br>
            <div class="row">
                <div v-for="service in services.additional_service" :key="service.id" class="col-md-3">
                    <div class="col">
                        <input type="checkbox" :id="service.id" :value="service.id" v-model="form.additional_services">

                        <label :for="service.name"> {{ service.name }} </label>
                    </div>
                </div>
                <input class="button" @click="storeData" type="submit" value="Create New Apartment">

            </div>
        </form>
    </section>
    <section class="autenticato" v-else>
        <h1 class="text-danger">Non Autenticato</h1>
        <h2>Effettua il Login</h2>
    </section>
</template>

<style lang="scss" scoped>
.container {
    margin-top: 150px;

    form {
        display: flex;
        flex-direction: column;
        width: 100%;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    h2 {
        margin-top: 0;
    }

    label {
        display: block;
        margin-bottom: 10px;
        color: #333;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 16px;
        width: 100%;
        margin-bottom: 20px;
    }

    input[type="checkbox"] {
        margin-right: 10px;
    }

    .button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 20px;
        margin: 0 auto;
        width: 95%;

        &:hover {
            background-color: #3e8e41;
        }
    }

    .text-danger {
        color: #FF0000;
    }

    section {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f2f2f2;
        max-width: 75%;
        margin: 0 auto;
    }

    .my-template {

        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f2f2f2;
    }


    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .col-md-3 {
        flex: 0 0 31%;
        margin-bottom: 1rem;
        padding: 1rem;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 5px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;
    }


    .col-md-3:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }

    input[type="checkbox"] {
        margin-right: 0.5rem;
    }

    label {
        font-weight: bold;
        color: #333;
    }
}

.autenticato {
    width: 50%;
    text-align: center;
    margin: 0 auto;
    position: relative;
    animation-name: animation;
    animation-duration: 0.5s;

    @keyframes animation {
        0% {
            // background-color: red;
            top: 10px;
        }

        50% {
            // background-color: red;
            top: 0px;
        }

        75% {

            top: 10px;
        }

        100% {

            top: 0px;
        }
    }
}
</style>
