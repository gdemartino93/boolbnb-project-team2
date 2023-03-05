<script>
import axios from 'axios';


export default{
props:['apartment'],
data(){
    return{

        apartments: [],
        thisApartment : {
            
        }
    }
},
methods:{

    async getAllData(){

        try {
            const response = await axios.get('/api/v1/apartment/all');
            this.apartments = response.data.response.apartments;
            console.log(this.apartments);
        } catch (error) {
                // bisogna gestire l'errore della chiamata API
                // console.log(error);
        }
    },
    
    destinationId(){
    
        return parseInt(this.$route.params.id)
    },
    destination(){
    
        return this.apartments.find(x => apartment.id === this.apartment.id) 
    },
    fillObj(){

        return this.thisApartment = this.destination();
    }
},
mounted() {
    this.destinationId();
    this.destination();
    this.getAllData();
}


}
</script>

<template>

    <h3>ciao {{ $route.params.id }}</h3>
    <!-- <p>{{ $route.params.title }}</p> -->
    <p>{{ thisApartment.title }}</p>

</template>

<style scoped>
</style>
