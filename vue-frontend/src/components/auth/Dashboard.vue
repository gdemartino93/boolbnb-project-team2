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
    <div class="dashboard d-flex">
        <div class="left col-7">
            <div class="container">
                <div class="box">
                    <div class="box-header text-center my-4">
                        <h2>Lista Appartamenti</h2>
                    </div>
                    <div class="box-body">
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo debitis voluptatibus repellendus neque voluptas a eveniet numquam quia. Alias totam officiis cupiditate quis error. Consectetur magnam atque omnis harum velit.l
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="right col-5"></div>
    </div>
</template>

<style lang="scss" scoped>
.dashboard {
    padding-top: 10vh;
    background-color: #bbc6c7;
    height: 100vh;
    // padding-bottom: ;
}
.right{
    background-image: url('/dash-img.png');
}
.box-body{
    height: 75vh;
    background-color: beige;
    overflow: auto;
}
</style>