<template>
    <Loader v-if="isLoading" />

    <section v-else style="background-color: #f8f9fa;">
        <!-- div ref to scrollintoview -->
        <div ref="first" class="top-page"></div>

        <div class="container" style="background-color: #f8f9fa;">
            <router-link class="btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2 mt-5 mx-2"
                :to="{ name: 'advancedSearch' }">Vai alla ricerca</router-link>
            <div class="row justify-content-center d-flex ">
                <AptCard class="my-4 col-12 col-sm-6 col-md-4 col-lg-3" v-for="(apartment, index) in apartments"
                    :apartment="apartment" :key="index" />
            </div>
            <div class="my-4">
                <button class="btn btn-primary btn-block text-uppercase rounded-pill shadow-sm mx-2 mt-3"
                    @click="goToFirst(index)">TOP
                </button>
                <button class="btn btn-primary btn-block text-uppercase rounded-pill shadow-sm mx-2 mt-3"
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
export default {
    name: 'HomePage',
    components: {
        AptCard,
        Map,
        Loader
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
        }
    },
    mounted() {
        this.authStore.getUser(); //check if user is validated
        this.apartmentPrint(); //èrin result
    },
};
</script>

<style lang="scss" scoped>
.toppage {
    position: absolute;
    top: 0;
}
</style>