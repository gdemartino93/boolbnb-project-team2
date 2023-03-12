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

        <router-link class="card col-4" :to="{name: 'show', params:{
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

<style lang="scss" scoped>
.card{
    img{
        width: 50px;
    }
}

</style>