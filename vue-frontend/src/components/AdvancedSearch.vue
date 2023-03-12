<script>
import {store} from '../stores/store';
import axios from 'axios';

import AptCard from './AptCard.vue';

export default{
    components: {
        AptCard
    },
    data(){
        return{
            store,
            queryValue: '',
            queryLatitude: undefined,
            queryLongitude: undefined,
            apartments: [],
            queryResults: []
        }
    },
    methods: {

        queryCoordinates(){
            
            // Funzione per prendere le coordinate dato un indirizzo deciso dall'input dell'utente, attraverso chiamata API a TomTom
            this.store.getCohordinates(this.queryValue);
            this.queryLatitude = this.store.latitude;
            this.queryLongitude = this.store.longitude;

            console.log(this.queryLatitude, this.queryLongitude);

            // Si svuota l'array di risultati per evitare che vi siano risultati della precedente ricerca
            this.queryResults = [];

            this.getApartmentsWithinRadius(this.apartments, this.queryLatitude, this.queryLongitude, 20);
        },
        async apartmentPrint() {
            
            try {
            
                const response = await axios.get('/api/v1/apartment/all');
                this.apartments = response.data.response.apartments.data;
                console.log(this.apartments);
            } catch (error) {
                
                console.log(error);
            }
        },
        getApartmentsWithinRadius(apartments, centerLat, centerLon, radius) {
            
            // Calcolare la distanza dall'input dell'utente in un raggio di 20 km
            
            const R = 6371; // Raggio della Terra in chilometri

            // Si fa un foreach sull'array apartments che contiene tutti gli appartamenti presenti in DB
            apartments.forEach((apartment) => {
                
                // Assegnazione delle proprietà di latitude e longitude a due variabili d'appoggio
                const aptLat = apartment.latitude;
                const aptLon = apartment.longitude;

                // Variabili distanceLatitude e distanceLongitude, avanzatissimi calcoli che non saprei spiegare ma funzionano giuro
                const dLat = this.toRad(aptLat - centerLat);
                const dLon = this.toRad(aptLon - centerLon);

                // Altri avanzatissimi calcoli che non saprei spiegare
                const a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(this.toRad(centerLat)) *
                    Math.cos(this.toRad(aptLat)) *
                    Math.sin(dLon / 2) *
                    Math.sin(dLon / 2);

                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

                // d rappresenta la distanza dell'appartamento dall'input dell'utente ed è uguale a R (raggio) moltiplicato per c, perchè? Non ne ho idea, ma funziona
                const d = R * c;

                // Se la distanza è minore o uguale al raggio della ricerca si può pushare l'appartamento nell'array dei risultati
                if (d <= radius) {
                    
                    // qui si assegna invece all'oggetto apartment una variabile chiamata distance che servirà per ordinare i risultati in ordine crescente in base alla loro distanza dall'input
                    apartment['distance'] = d;
                    this.queryResults.push(apartment);
                }
            });
            
        },
        toRad(value) {
            
            return (value * Math.PI) / 180;
        }
    },
    mounted(){
        
        this.apartmentPrint();
        
    }
}
</script>

<template>
    <input type="search" name="searchBar" placeholder="Cosa stai cercando?" v-model="queryValue">
    <button @click="queryCoordinates">Search</button>

    <div class="container d-flex">

        <!-- <ul>
            <li v-for="apartment in queryResults">
                {{ apartment.title }}
            </li>
        </ul> -->

        <AptCard v-for="apartment in queryResults" :apartment="apartment"/>
    </div>
</template>

<style lang="scss" scoped>
input {
    width: 80%;
    margin-left: 2rem;
    padding-left: .5rem;
    border-radius: 16px 0 16px 0;
    // appearance: none;
    // border: none;
    // outline: none;
    background: none;
    background-color: rgba(255, 255, 255, .35);
    transition: 0.4s;

    &:focus {
        border-radius: 0 16px 0 16px;
        background-color: rgba(255, 255, 255, .75);
    }

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
</style>