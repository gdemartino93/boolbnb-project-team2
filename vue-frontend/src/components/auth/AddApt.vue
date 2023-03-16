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
    <section v-if="auth.user" class="my-container">
        <form method="POST" class="d-flex flex-wrap justify-content-around bg-white rounded-2 p-5">
            <div class="col-sm-11 col-md-5 col-lg-5">
                <label for="title">Title</label>
                <input type="text" name="title" v-model="form.title">
            </div>
            <div class="col-sm-11 col-md-5 col-lg-5">
                <label for="description">Description</label>
                <input type="text" name="description" v-model="form.description">
            </div>

            <div class="col-sm-11 col-md-5 col-lg-5">
                <label for="room_number">Room Number</label>
                <input type="number" name="room_number" v-model="form.room_number">
            </div>

            <div class="col-sm-11 col-md-5 col-lg-5">
                <label for="bed_number">Bed Number</label>
                <input type="number" name="bed_number" v-model="form.bed_number">
            </div>
            <div class="col-sm-11 col-md-5 col-lg-5">
                <label for="bath_number">Bath Number</label>
                <input type="number" name="bath_number" v-model="form.bath_number">
            </div>
            <div class="col-sm-11 col-md-5 col-lg-5">
                <label for="square_meters">Square Meters</label>
                <input type="number" name="square_meters" v-model="form.square_meters">
            </div>
            <div class="col-sm-11 col-md-5 col-lg-5">
                <label for="address">Address</label>
                <input type="text" name="address" v-model="form.address">
            </div>
            <div class="col-sm-11 col-md-5 col-lg-5">
                <label for="img">Image</label>
                <input type="file" name="img" @change="onFileChange">
            </div>
            <div class="d-flex flex-wrap ms-services">
                <div v-for="service in services.additional_service" :key="service.id"
                    class=" ms-col col-sm-12 col-md-3 col-lg-3 p-3">
                    <div>
                        <input type="checkbox" :id="service.id" :value="service.id" v-model="form.additional_services">

                        <label :for="service.name"> {{ service.name }} </label>
                    </div>
                </div>
                <input class="button btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2 mt-3"
                    @click="storeData" type="submit" value="Create New Apartment">
            </div>
        </form>
    </section>
    <section class="autenticato" v-else>
        <h1 class="text-danger">Non Autenticato</h1>
        <h2>Effettua il Login</h2>
    </section>
</template>

<style lang="scss" scoped>
.my-container {
    margin-top: 100px;

    form {
        width: 80%;
        margin: 0 auto;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
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

    .button {
        cursor: pointer;
        font-size: 16px;
        margin: 0 auto;
        width: 95%;
    }

    section {
        background-color: #f2f2f2;
    }

    .my-template {
        background-color: #f2f2f2;
    }

    .ms-col {
        border: 1px solid #e9ecef;
        border-radius: 5px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;

        &:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }
    }

    label {
        font-weight: bold;
        color: #333;
    }
}

.autenticato {
    width: 50%;
    text-align: center;
    margin: 100px auto 0 auto;
    position: relative;
    animation-name: animation;
    animation-duration: 0.5s;

    @keyframes animation {
        0% {
            top: 10px;
        }

        50% {
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



