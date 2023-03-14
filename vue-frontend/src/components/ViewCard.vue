<script>
import Map from './Map/Map.vue';
import { useAuthStore } from '../stores/auth';
import axios from 'axios';
export default {
    components: {
        Map
    },
    data() {
        return {
            authStore: useAuthStore(),
            apt: {},
            services: []
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
