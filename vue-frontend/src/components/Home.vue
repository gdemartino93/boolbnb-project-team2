<template>
    <div class="container">
        <div v-if="authStore.user">
            <h2 class="mt-5" ref="first"> Welcome {{ authStore.user.name }} {{ authStore.user.lastname }}</h2>
        </div>
        <div v-else class="mt-5">Go to login</div>

        <router-link :to="{ name: 'advancedSearch' }">Vai alla ricerca</router-link>

        <div class="apt">
            <AptCard v-for="(apartment, index) in apartments" :apartment="apartment" :key="index" />
        </div>
        <button class="btn btn-info" @click="goToFirst(index)">TOP</button>
        <button class="btn btn-success my-5" @click="loadMore" ref="loadmore">CARICA ALTRI</button>
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
            // declare istance of authstore
            authStore: useAuthStore(),
            apartments: [],
            // set current page to 1 by default. If you wanna change the results for page you must be change them on apicontroller
            currentPage: 1
        };
    },
    methods: {
        async loadMore() {
            // increase current page on click
            this.currentPage++;
            // print results
            await this.apartmentPrint(this.currentPage);
            // wait resultas has been printed then scrollintoview
            this.$refs.loadmore.scrollIntoView({ behavior: 'smooth' });


        },
        async apartmentPrint(page) {
            try {
                const response = await axios.get(`/api/v1/apartment/all?page=${page}`);
                const res = response.data.response.apartments;
                // we need to concat results either we ll have only X apt in page because they ll overwrite
                this.apartments = this.apartments.concat(res.data);
            } catch (error) {
                console.log(error);
            }
        },
        async goToFirst() {
            this.$refs.first.scrollIntoView({ behavior: 'smooth' });
        }
    },
    mounted() {

        this.authStore.getUser(); //check if user is validated
        this.apartmentPrint(); //??rin result
    },
};
</script>

<style lang="scss" scoped>
.container {
    margin-top: 150px;

    .apt {
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
    }
}
</style>
  