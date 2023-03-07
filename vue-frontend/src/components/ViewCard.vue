<script>
import {useAuthStore} from '../stores/auth';

export default {
    data(){
        return{

            authStore: useAuthStore()
        }
    },
    mounted(){

        this.authStore.getUsersWithApt();
    }
}
</script>

<template>
    <h3>Id: {{ $route.params.id }}</h3>
    <ul>
        <img :src="$route.params.img" alt="apartment image">

        <li>Title: {{ $route.params.title }}</li>
        <li>Description: {{ $route.params.description }}</li>
        <li>Room Number: {{ $route.params.room_number }}</li>
        <li>Bed Number: {{ $route.params.bed_number }}</li>
        <li>Bath Number: {{ $route.params.bath_number }}</li>
        <li>Square Meters: {{ $route.params.square_meters }}</li>
        <li>Address: {{ $route.params.address }}</li>
        <li>Latitude: {{ $route.params.latitude }}</li>
        <li>Longitude: {{ $route.params.longitude }}</li>

        <ul>
            <li v-for="service in authStore.apartments.additional_services">
                {{ service.name }}
            </li>
        </ul>
    </ul>
</template>

<style scoped></style>
