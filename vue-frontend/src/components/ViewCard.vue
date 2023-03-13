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
                <h2>{{ apt.title }}</h2>
            </li>

            <li class="img">
                <img :src="apt.img" :alt="apt.img">
            </li>

            <li class="description">{{ apt.description }}</li>

            <li class="info"><i class="fa-solid fa-house-chimney-window"></i> <b>Room number</b>: {{ apt.room_number }}</li>
            <li class="info"><i class="fa-solid fa-bed"></i> <b>Beds number</b>: {{ apt.bed_number }}</li>

            <li class="info"><i class="fa-solid fa-bath"></i> <b>Baths number</b>: {{ apt.bath_number }}</li>

            <li class="info"><i class="fa-solid fa-ruler"></i> <b>Square meters</b>: {{ apt.square_meters }}</li>

            <li class="info"><i class="fa-solid fa-map-location-dot"></i> <b>Address</b>: {{ apt.address }}</li>

            <ul class="services-ul list-unstyled"><b>Additional services</b>:
                <li v-for="service in services">{{ service.name }}</li>
            </ul>
        </ul>

        <!-- use v-if because value onmounted start as undefinied and app crash -->
        <Map v-if="apt.latitude && apt.longitude" :center="{ lat: apt.latitude, lon: apt.longitude }" :flats="flats" />
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
        }

        img {
            width: 400px;
        }

        img,
        .description {
            margin-bottom: 10px;
        }

        .services-ul {
            margin-bottom: 40px;

            li {
                margin-left: 20px;
            }

        }
    }

}
</style>
