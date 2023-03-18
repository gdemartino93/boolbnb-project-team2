<script>
import { store } from '../stores/store';
import axios from 'axios';
import AptCard from './AptCard.vue';

export default {
    components: {
        AptCard
    },
    data() {
        return {
            store,
            queryValue: '',
            queryLatitude: '',
            queryLongitude: '',
            apartments: [],
            radius: 20,
            error: null,
            room_number: '',
            bed_number: '',
            isOpen: false,
        }
    },
    methods: {

        getCoordinates(e) {

            // Metodo da spada smart per aggirare le CORS policy

            e.preventDefault();

            var theUrl = `${this.store.geolocationUrl}` + this.queryValue + `.json?key=${this.store.apiKey}`;
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", theUrl, false);
            xmlHttp.send(null);
            var json = JSON.parse(xmlHttp.responseText);
            
            this.queryLatitude = parseFloat(json.results[0].position.lat);
            this.queryLongitude = parseFloat(json.results[0].position.lon);
            
            console.log(this.queryLatitude, this.queryLongitude);

            this.getApt();
        },
        getApt(){

            let formData = new FormData();
            formData.append("latitude", this.queryLatitude);
            formData.append("longitude", this.queryLongitude);
            formData.append("radius", this.radius);
            formData.append("room_number", this.room_number);
            formData.append("bed_number", this.bed_number);

            console.log(formData);

            axios.post("/api/v1/apartment/search", formData)
                .then(res => {
                    console.log("apSear", res);

                    this.apartments = res.data.apartments;
                    // teniamo traccia dell'aggiornamento dell array apartments per passarlo al componente madre
                    this.$emit('apartments-searched', this.apartments)
                    console.log(this.apartments);
                    if (this.apartments.length == 0) {
                        this.error = "nessun appartamento trovato";
                    }
                    else {
                        this.error = null
                    }
                })
       
        },
    },
    mounted() {

    }
}
</script>
<template>
    <div class="container" id="form">

        <form action="" method="post">

            <input type="search" name="searchBar" placeholder="Cosa stai cercando?" v-model="queryValue">

            <div class="button">
                <font-awesome-icon icon="fa-solid fa-filter" @click="isOpen = true"/>
                
                <div v-if="isOpen" class="menu">

                    <div>

                        <img src="../assets/noun-apartment-194955.png" alt="room number logo">
                        <input type="number" name="room_number" v-model="room_number" placeholder="Numero minimo di camere ...">
                    </div>
                    <div>

                        <font-awesome-icon icon="fa-solid fa-bed" id="bed"/>        
                        <input type="number" name="bed_number" v-model="bed_number" placeholder="Numero minimo di letti ...">
                    </div>
                    <div>

                        <label for="range">O in alternativa puoi cambiare il range di ricerca (il valore di default è di 20Km):</label>
                        <input type="range" name="range" min="20" max="100" step="20" v-model="radius">
                    </div>
                    
                    <div class="buttonClose" @click="isOpen = false">
                        Close
                    </div>
                </div>
            </div>
            

            <input type="submit" value="Search" @click="getCoordinates">
        </form>
    </div>

    <div class="container d-flex flex-wrap">

        <AptCard class="my-4 col-12 col-sm-6 col-md-4 col-lg-3" v-for="(apartment, index) in apartments"
                    :apartment="apartment" :key="index" />
    </div>

</template>

<style lang="scss" scoped>
#form {

    background-image: url('../assets/dream.png');
    background-size: cover;
    background-position-y: 25%;
    padding: 8rem 3rem;
    border-radius: 15px;
    color: white;
    position: relative;
    margin-top: 1rem;
    
    input[type=search]{
        
        position: absolute;
        bottom: 20px;
        border-radius: 15px 0 0 15px;
        width: 20%;
        padding: .3rem 1.5rem;
    }

    input[type=submit]{

        position: absolute;
        background-color: #FF6E31;
        bottom: 20px;
        left: 30%;
        outline: none;
        padding: .3rem .5rem;
        border-radius: 15px;
        color: white;
        appearance: none;
        outline: none;
        border: none;
    }

    .button {
        
        background-color: #FF6E31;
        width: 3%;
        border-radius: 0 15px 15px 0;
        position: absolute;
        bottom: 20px;
        left: 23.5%;
        padding: .4rem .7rem;
        cursor: pointer;

        .menu {

            background-color: #D1D1D1;
            height: 200px;
            width: 400px;
            position: absolute;
            z-index: 30;
            padding: 1rem;
            border-radius: 15px;

            img {
                width: 25px;
                margin-right: 1.3rem;
            }

            #bed {
                
                color: black;
                margin-right: 1.6rem;
            }

            input {

                width: 70%;
            }

            label{
                
                color: black;
            }

            .buttonClose{

                background-color: #FF6E31;
                border-radius: 15px;
                width: fit-content;
                padding: .3rem 1rem;
                position: absolute;
                right: 1rem;
            }
        }
    }

}
.searched{
    border: 1px solid red;
    min-height: 100px;
}




</style>