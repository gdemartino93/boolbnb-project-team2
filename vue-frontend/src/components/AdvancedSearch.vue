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
            isFilled: false
        }
    },
    methods: {

        getCoordinates(e) {

            // Metodo da spada smart per aggirare le CORS policy
            e.preventDefault();

            this.isFilled = true;
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
    <div class="search">
            <div class="container" id="form">
            <form action="" method="post">
                <div class="button">
                    <div class="wrap-ricerca d-flex">
                        <div class="d-flex box-ricerca align-items-center">
                        <input type="search" name="searchBar" placeholder="Cosa stai cercando?" v-model="queryValue" id="ricerca">
                        <font-awesome-icon icon="fa-solid fa-filter" @click="isOpen = true" id="icona-ricerca"/>
                    </div>
                    <div>
                        <input class="btn mx-2" type="submit" value="Cerca" @click="getCoordinates" id="cerca">
                    </div>
                    </div>

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

            </form>
        </div>

        <img v-if="isFilled" id="phrase" src="../assets/dreams-here.png" alt="">

        <div class="slider container d-flex gap-2">

            <AptCard class="searchCard my-4 col-12 col-sm-6 col-md-4 col-lg-3" v-for="(apartment, index) in apartments"
                        :apartment="apartment" :key="index" />
        </div>
    </div>
    

</template>

<style lang="scss" scoped>
.search{
    padding-top: 10vh;
    height: 100vh;
    background-image: url('../assets/bg.png');
    position: relative;

    #phrase {

        width: 20%;
        position: absolute;
        left: 45%;
        top: 9%;
    }

    .slider {

        position: absolute;
        bottom: 5%;
        width: 1000px;
        overflow-x: auto;

        .searchCard {

            width: calc(100% / 3);
        }
    }
}
#form {

    padding: 8rem 3rem;
    border-radius: 15px;
    color: white;
    margin-top: 1rem;

    #cerca{
        border-radius: 10px;
        border: 3px solid #ff3d00;
        padding: .5rem 1rem;
        color: #ff3d00;
        font-weight: 900;
        font-size: 10px;
        transition: .4s ease-in-out;

        &:hover {

            background-color: #ff3d00;
            color: #fff;
        }
    }

    .button {
    
        .menu {

            background-color: rgba($color: #D1D1D1, $alpha: 0.9);
            height: 200px;
            width: 400px;
            position: absolute;
            top: 22%;
            z-index: 30;
            padding: 1rem;
            border-radius: 15px;
            cursor: pointer;

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

                background-color: #ff3d00;
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
.wrap-ricerca{
    position: absolute;
    top: 15%;
    display: flex;
    align-items: center;
    cursor: pointer;
}
.box-ricerca{

    background-color:#ff3d00;
    border-radius: 10px;
    width: 400px;
    
    input{
        border-radius: 10px 0 0 10px;
        padding: 5px;
        width: 90%;
        margin-right: 2.5%;
    }
}



</style>