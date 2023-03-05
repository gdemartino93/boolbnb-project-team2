<script>

export default{
    props: ['apartment'],
    data(){
        return{

        }
    },
    methods: {

    },
    mounted() {

    }
}
</script>

<template>

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
</template>

<style scoped>
</style>