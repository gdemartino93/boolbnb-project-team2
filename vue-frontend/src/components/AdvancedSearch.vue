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
            bed_number: ''
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
                    // this.onSearch = true;

                    this.apartments = res.data.apartments;
                    // this.apartmentsGeoSponsored = res.data.apartmentsSponsored;
                    console.log(this.apartments);
                    if (this.apartments.length == 0) {
                        this.error = "nessun appartamento trovato";
                    }
                    else {
                        this.error = null
                    }
                })
       
        }
        
    },
    mounted() {

    }
}
</script>
<template>
    <div class="container">

        <form action="" method="post">

            <input type="search" name="searchBar" placeholder="Cosa stai cercando?" v-model="queryValue">
            <br>
            
            <label for="room_number">Numero minimo di camere:</label>
            <input type="number" name="room_number" v-model="room_number">
            <br>

            <label for="bed_number">Numero minimo di letti:</label>
            <input type="number" name="bed_number" v-model="bed_number">
            <br>

            <label for="range">O in alternativa puoi cambiare il range di ricerca (il valore di default è di 20Km):</label>
            <input type="range" name="range" min="20" max="100" step="20" v-model="radius">

            <input type="submit" value="Search" @click="getCoordinates">
        </form>
    </div>

    <div class="container d-flex flex-wrap">

        <AptCard v-if="apartments" class="col-3" v-for="apartment in apartments" :apartment="apartment" />

        <p v-else>{{ error }}</p>
    </div>

</template>

<style lang="scss" scoped>
.container {
    margin-top: 150px;

    input {
        width: 80%;
        margin-left: 2rem;
        padding-left: .5rem;
        border-radius: 16px 0 16px 0;
        background: none;
        background-color: rgba(255, 255, 255, .35);
        transition: 0.4s;

        &:focus {
            border-radius: 0 16px 0 16px;
            background-color: rgba(255, 255, 255, .75);
        }



    &:focus {
        border-radius: 0 16px 0 16px;
        background-color: rgba(255, 255, 255, .75);

    }

    button {
        margin-left: 2rem;
        padding: 0.5rem;
        appearance: none;
        border: none;
        outline: none;
        border-radius: 16px 0 16px 0;
        transition: 0.4s;

        &:hover {
            border-radius: 0 16px 0 16px;
        }
    }
}
}




</style>