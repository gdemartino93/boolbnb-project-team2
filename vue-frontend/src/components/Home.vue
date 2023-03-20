<template>
    <Hero />

    <Loader v-if="isLoading" />

    <section id="content" v-else style="background-color: #bbc6c7;">
        <!-- div ref to scrollintoview -->
        <div ref="first" class="top-page"></div>

        <div class="container" style="background-color: #bbc6c7;">

            <div class="row justify-content-center d-flex ">

                
                <div class="text-center my-5 " v-if="apartments.length == 0">
                    <span  class="text-danger fs-3 fw-bold">Nessun appartamento trovato che soddisfa i tuoi requisiti </span> <br>
                    <button class="btn btn-success" @click="apartmentPrint">Carica tutti</button>
                </div>

                <AptCard class="my-4 col-12 col-sm-6 col-md-4 col-lg-3" v-for="(apartment, index) in apartments"
                    :apartment="apartment" :key="index" />
            </div>
            <div class="my-4" v-if="apartments.length > 0">
                <button class="btn btn-block text-uppercase rounded-pill shadow-sm mx-2 mt-3"
                    @click="goToFirst(index)">TOP
                </button>
                <button class="btn btn-block text-uppercase rounded-pill shadow-sm mx-2 mt-3"
                    @click="loadMore">CARICA
                    ALTRI
                </button>
            </div>

        </div>

        <!-- div ref to scrollintoview -->
        <div ref="loadmore" class="top-page"></div>
    </section>
</template>
  
<script>
import axios from 'axios';
import { useAuthStore } from '../stores/auth';
import AptCard from './AptCard.vue';
import Loader from '../components/utility/Loader.vue'
import Hero from './Hero.vue';
export default {
    name: 'HomePage',
    components: {
        AptCard,
        Map,
        Loader,
        Hero
    },
    data() {
        return {
            // declare istance of authstore
            authStore: useAuthStore(),
            apartments: [],
            // set current page to 1 by default. If you wanna change the results for page you must be change them on apicontroller
            currentPage: 1,
            isLoading: true
        };
    },
    methods: {
        async loadMore() {
            // increase current page on click
            this.currentPage++;

            this.isLoading = true;
            // print results
            await this.apartmentPrint(this.currentPage);
            // wait resultas has been printed then scrollintoview
            this.isLoading = false;
            this.$refs.loadmore.scrollIntoView({ behavior: 'smooth' });
        },
        async apartmentPrint(page) {
            this.isLoading = true
            try {
                const response = await axios.get(`/api/v1/apartment/all?page=${page}`);
                const res = response.data.response.apartments;
                // we need to concat results either we ll have only X apt in page because they ll overwrite
                this.apartments = this.apartments.concat(res.data);
                this.isLoading = false;
            } catch (error) {
                console.log(error);
            }
            this.isLoading = false
        },
        async goToFirst() {
            this.$refs.first.scrollIntoView({ behavior: 'smooth' });
        },
        updateApt(searchedApt){
            this.apartments = searchedApt
        }
    },
    mounted() {
        this.authStore.getUser(); //check if user is validated
        this.apartmentPrint(); //èrin result
    },
};
</script>

<style lang="scss" scoped>
// .toppage {
//     position: absolute;
//     top: 0;
// }

.btn {

    border: 2px solid #ff3d00;
    color: #ff3d00;
    font-weight: bold;
    transition: .4s ease-in-out;

    &:hover {

        background-color: #ff3d00;
        color: #fff;
    }
}
</style>