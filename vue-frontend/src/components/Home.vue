<template>
    <div>
        <input type="search" name="searchBar" placeholder="Cosa stai cercando?">
        <button>Search</button>
        <div v-if="authStore.user">
            <h2 class="mt-5"> Welcome {{ authStore.user.name }} {{ authStore.user.lastname }}</h2>
        </div>
        <div v-else class="mt-5">Go to login</div>

        <div class="container">
            <AptCard v-for="apartment in apartments" :apartment="apartment" />
        </div>
        <button class="btn btn-success" @click="loadMore" ref="loadmore">CARICA ALTRI</button>
    </div>
</template>
  
<script>
import axios from 'axios';
import { useAuthStore } from '../stores/auth';
import AptCard from './AptCard.vue';

export default {
    name: 'HomePage',
    components: {
        AptCard,
        Map
    },
    data() {
        return {
            // dichiariamo un istanza di useAuthstore 
            authStore: useAuthStore(),
            apartments: [],
            currentPage: 1
        };
    },
    methods: {
        async loadMore(){
            this.currentPage++;
            await this.apartmentPrint(this.currentPage);
            
        },
        async apartmentPrint(page) {
            try {
                const response = await axios.get(`/api/v1/apartment/all?page=${page}`);
                const res = response.data.response.apartments;
                this.apartments = this.apartments.concat(res.data);
            } catch (error) {
                
                console.log(error);
            }
        },
    },
    mounted() {

        this.authStore.getUser(); //uso la funzione dello store di pinia
        this.apartmentPrint();
    },
};
</script>

<style lang="scss" scoped>
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

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
  