<script>
import { useAuthStore } from '../../stores/auth';
import axios from 'axios';
import { ref } from 'vue';

export default {
    data() {
        return {
            authStore: useAuthStore(),

        }
    },
    methods: {

        deleteApartment(apartment) {
            axios.delete('/api/v1/apartment/delete/' + apartment.id)
                .then(res => {

                    const data = res.data;
                    const success = data.success;

                    if (success) {
                        this.authStore.getUsersWithApt();
                    }
                })
                .catch(err => console.log);
        },
        async toggleVisibility(id) {
            try {
                await axios.get(`/api/v1/apartment/${id}/visibility`)
            } catch (error) {
                console.log(error)
            }
        }
    },
    mounted() {
        this.authStore.getUsersWithApt();
    }
}
</script>

<template>
    <div class="container dashboard d-flex">
        <div class="left col-6">sx</div>
        <div class="right col-6">dx</div>
    </div>
</template>

<style lang="scss" scoped>
.dashboard {
    padding-top: 12vh;
    background-color: #bbc6c7;
    height: 100vh;
}
</style>