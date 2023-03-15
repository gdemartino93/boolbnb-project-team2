<script>
import Map from './Map/Map.vue';
import { useAuthStore } from '../stores/auth';
import axios from 'axios';
import { ref } from 'vue';
export default {
    components: {
        Map
    },
    data() {
        return {
            authStore: useAuthStore(),
            apt: {},
            services: [],
            form:ref({
                name : "",
                mail :"",
                text : ""
            })
        }
    },
    methods: {
        async getSingleAp(id) {
            try {
                const response = await axios.get('/api/v1/apartment/' + id)
                this.apt = response.data.response;
                this.services = response.data.response.additional_services;


            } catch (error) {
                console.log(error)
            }

        },
        getForm(){
            let formData = new FormData();
     
            if(this.authStore.user){
                this.form.name = this.authStore.user.name;
                this.form.mail = this.authStore.user.email;
            }
            formData.append('name', this.form.name);
            formData.append('mail', this.form.mail);
            formData.append('text', this.form.text);

            formData.append('apartment_id', this.apt.id)
        }
    },
    mounted() {
        this.getSingleAp(this.$route.params.id);
        this.authStore.getUsersWithApt();
       
    }
}
</script>

<template>
    <div class="container">
        <ul class="list-unstyled">
            <li>
                <h2 class="d-inline-block"> {{ apt.title }} </h2>
                <h4 class="d-inline-block"> ({{ apt.address }}) </h4>
            </li>

            <li class="img">
                <img :src="apt.img" :alt="apt.img">
            </li>

            <li class="description">{{ apt.description }}</li>

            <li class="info"><i class="fa-solid fa-house-chimney-window"></i> <b>{{ apt.room_number }}</b> rooms</li>
            <li class="info"><i class="fa-solid fa-bed"></i> <b>{{ apt.bed_number }} </b> beds</li>

            <li class="info"><i class="fa-solid fa-bath"></i> <b>{{ apt.bath_number }} </b> baths</li>

            <li class="info"><i class="fa-solid fa-ruler"></i> <b>{{ apt.square_meters }}</b> square meters</li>

            <li class="info"><i class="fa-solid fa-map-location-dot"></i> <b>{{ apt.address }}</b></li>

            <ul class="services-ul list-unstyled"><b>Additional services</b>
                <li v-for="service in services"><i class="fa-solid fa-check"></i> {{ service.name }}</li>
            </ul>
        </ul>
        <div>
            <form action="" method="POST" class="d-flex flex-column col-3 mx-auto" @submit.prevent="getForm">
                <label for="name">Nome</label>
                <input type="text" name="name" v-model="authStore.user.name" v-if="authStore.user" disabled>
                <input type="text" name="name" v-model="form.name" v-else>

                <label for="email">Email</label>
                <input type="email" name="email" v-model="authStore.user.email" v-if="authStore.user" disabled>

                <input type="email" name="email" v-model="form.mail" v-else>


                <label for="text">Testo</label>
                <textarea rows="4" cols="50" type="textarea" name="text" v-model="form.text" />

                <button type="submit" class="my-2 btn btn-primary">Invia</button>


            </form>
        </div>
        <!-- use v-if because value onmounted start as undefinied and app crash -->
        <div class="map">
            <b class="d-inline-block">Where is it</b>
            <Map v-if="apt.latitude && apt.longitude" :center="{ lat: apt.latitude, lon: apt.longitude }" :flats="flats" />
        </div>
    </div>
</template>
  

<style lang="scss" scoped>
@use '../assets/main.scss' as *;

.container {
    font-size: 14px;
    margin: auto;
    padding: 20px 0;
    margin-top: 100px;

    ul {
        h2 {
            margin-bottom: 30px;
            margin-right: 15px;
        }


        img {
            width: 400px;
        }

        img,
        .description {
            margin-bottom: 10px;
        }

        i {
            color: rgb(171, 171, 103);

        }

        .info {
            margin-bottom: 20px;
            padding: 10px 15px;
            border: 1px solid rgb(171, 171, 103);
            border-radius: 10px;

            i {
                font-size: 30px;
                margin-right: 10px;
                width: 40px;
            }
        }

        .services-ul {
            display: inline-block;
            margin-bottom: 40px;
            padding: 10px 15px;
            border: 1px solid rgb(171, 171, 103);
            border-radius: 10px;
        }

    }

    .map {
        padding-bottom: 20px;

        b {
            margin-bottom: 7px;
        }
    }
}
</style>
