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
    <div class="m-5">
        <ul class="list-unstyled">
            <li>
                <h2>{{ apt.title }}</h2>
            </li>

            <li class="img">
                <img :src="apt.img" :alt="apt.img">
            </li>

            <li class="description">{{ apt.description }} lorem et lorem et loremlorem et lorem et loremlorem et lorem et
                lorem et lorem et loremlorem et lorem et loremlorem e lorem etlorem et lorem et loremlorem et lorem et
                loremlorem et lorem et lorem</li>

            <li class="info"><b>Room number</b>: {{ apt.room_number }}</li>
            <li class="info"><b>Bed number</b>: {{ apt.bed_number }}</li>
            <li class="info"><b>Bath number</b>: {{ apt.bath_number }}</li>
            <li class="info"><b>Square meters</b>: {{ apt.square_meters }}</li>
            <li class="info"><b>Address</b>: {{ apt.address }}</li>

            <li><b>Additional Services</b>:
                <ul class="list-unstyled" v-for="service in services">
                    <li> {{ service.name }}</li>
                </ul>
            </li>
        </ul>

        <!-- use v-if because value onmounted start as undefinied and app crash -->
        <Map v-if="apt.latitude && apt.longitude" :center="{ lat: apt.latitude, lon: apt.longitude }" :flats="flats" />
    </div>
</template>
  

<style lang="scss" scoped>
@use '../assets/main.scss' as *;

ul {
    img {}

    li {
        h2 {
            margin-bottom: 30px;
        }

        img {
            width: 300px;
        }
    }
}
</style>
