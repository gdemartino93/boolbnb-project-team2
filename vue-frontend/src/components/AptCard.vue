<script>

export default {
    props: ['apartment'],
    data() {
        return {

        }
    },
    methods: {

    },
    mounted() {

    }
}
</script>

<template>
    <!-- <router-link
        :to="{ name: 'view', params: { 
            id: `${apartment.id}`, title: `${apartment.title}`, description: `${apartment.description}`, 
            room_number: `${apartment.room_number}`, bed_number: `${apartment.bed_number}`, 
            bath_number: `${apartment.bath_number}`, square_meters: `${apartment.square_meters}`, 
            address: `${apartment.address}`, latitude: `${apartment.latitude}`, longitude: `${apartment.longitude}`, 
            visible: `${apartment.visible}`, img: `${apartment.img}` } }"
        :apartment="apartment"> -->
        <router-link :to="{name: 'show', params:{
            id: `${apartment.id}`
        }}" >

<div>
            <h5>
                #{{ apartment.id }}
            </h5>

            <img :src="apartment.img" :alt="apartment.img">

            <h3>Nome: {{ apartment.title }}</h3>

            <h3>
                Additional services: {{ apartment.additional_services.length }}
            </h3>
        </div>
        
    


        </router-link>

    <!-- </router-link> -->
</template>

<style scoped></style>