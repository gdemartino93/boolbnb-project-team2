<script>
import Map from './Map/Map.vue';
import { useAuthStore } from '../stores/auth';
import axios from 'axios';
export default {
    components: {
        Map
    },
    data() {
        return {
            authStore: useAuthStore(),
            apt: {},
            services: [],
            msgMail: '',
            msgName: '',
            msgTxt: '',
            msgSent: false,
        }
    },
    methods: {
        async getSingleAp(id) {
            try {
                const response = await axios.get('/api/v1/apartment/' + id)
                this.apt = response.data.response;
                this.services = response.data.response.additional_services;


            } catch (error) {
                console.log(error)
            }

        },
        sendMessage() {
            let formData = new FormData();
                if (!this.authStore.user) {
                    formData.append('mail', this.msgMail);
                    formData.append('name', this.msgName);
                } else {
                    formData.append('mail', this.authStore.user.email);
                    formData.append('name', this.authStore.user.name);
                }
            formData.append('text', this.msgTxt);
            formData.append('apartment_id', this.apt.id);
            console.log(formData);
            axios.post('/api/v1/apartment/message', formData)
                .then(res => {
                console.log(res.data);
                this.msgSent = true;
                })
        },
        async getView(id){
            try {
                axios.post('/api/v1/apartment/' + id)
            } catch (error) {
                console.log(error)
            }
        }
        

    },
    mounted() {
        this.getSingleAp(this.$route.params.id);
        this.authStore.getUsersWithApt();
        this.getView(this.$route.params.id)
        // this.authStore.getUser();
    }
}
</script>

<template>
    <div class="container">
        <ul class="list-unstyled">
            <li>
                <h2 class="d-inline-block"> {{ apt.title }} </h2>
            </li>

            <li class="img">
                <img :src="apt.img" :alt="apt.img">
            </li>
        
            <li class="description my-3">{{ apt.description }}</li>

            <li class="info"><i class="fa-solid fa-house-chimney-window"></i> <b>{{ apt.room_number }}</b> stanze</li>
            <li class="info"><i class="fa-solid fa-bed"></i> <b>{{ apt.bed_number }} </b> letti</li>

            <li class="info"><i class="fa-solid fa-bath"></i> <b>{{ apt.bath_number }} </b> bagni</li>

            <li class="info"><i class="fa-solid fa-ruler"></i> <b>{{ apt.square_meters }}</b> metri quadrati</li>

            <li class="info"><i class="fa-solid fa-map-location-dot"></i> <b>{{ apt.address }}</b></li>
            
            <div class="container d-flex" id="ms_container">
                
                <ul class="services-ul list-unstyled"><b>Servizi aggiuntivi:</b>
                    <li v-for="service in services"><i class="fa-solid fa-check"></i> {{ service.name }}</li>
                </ul>

                <button type="button" id="modalBtn" class="btn btn-primary align-self-center p-4 m-auto rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Manda un messaggio al proprietario</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog m-auto">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Il tuo messaggio</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div v-if="msgSent" class="text-center">
                            
                            <font-awesome-icon id="check" class="bg-success p-3 rounded-circle fs-3 mx-auto" icon="fa-solid fa-check"/>
                            <h3>Messaggio inviato correttamente!</h3>
                        </div>
                        <form v-else method="post">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Mail:</label>
                                <input type="text" class="form-control" name="recipient-name"
                                v-if="this.authStore.user" v-model="authStore.user.email" disabled>
                                <input type="text" class="form-control" name="recipient-name"
                                v-else v-model="msgMail">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Nome:</label>
                                <input type="text" class="form-control" name="name" 
                                v-if="this.authStore.user" v-model="authStore.user.name" disabled>
                                <input type="text" class="form-control" name="name"
                                v-else v-model="msgName">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Messaggio:</label>
                                <textarea class="form-control" id="message-text" v-model="msgTxt"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        <button type="button" class="btn btn-primary" @click="sendMessage" v-if="!msgSent">Invia</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </ul>

        <!-- use v-if because value onmounted start as undefinied and app crash -->
        <div class="map">
            <b class="d-inline-block">Where is it</b>
            <Map v-if="apt.latitude && apt.longitude" :center="{ lat: apt.latitude, lon: apt.longitude }" :flats="flats" />
        </div>
    </div>
</template>
  

<style lang="scss" scoped>
// @use '../assets/main.scss' as *;

.container {
    font-size: 14px;
    margin: auto;
    padding: 20px 0;
    margin-top: 100px;
    background-color: #f8f9fa;

    ul {
        h2 {
            margin-bottom: 30px;
            margin-right: 15px;
        }


        img {
            width: 400px;
        }

        img,


        i {
            color: rgb(171, 171, 103);

        }

        .info {
            margin-bottom: 20px;
            padding: 10px 15px;
            border: 1px solid rgb(171, 171, 103);
            border-radius: 10px;

            i {
                font-size: 30px;
                margin-right: 10px;
                width: 40px;
            }
        }

        .services-ul {
            display: inline-block;
            margin-bottom: 40px;
            padding: 10px 15px;
            border: 1px solid rgb(171, 171, 103);
            border-radius: 10px;
        }

        #ms_container{

            margin-top: 20px;

            
            #modalBtn{
    
                background: rgb(236,146,109);
                background: linear-gradient(90deg, rgba(236,146,109,1) 0%, rgba(255,110,49,1) 50%, rgba(255,76,0,1) 100%);
            }

            #check {

                color: #fff;
            }
        }

    }

    .map {
        padding-bottom: 20px;

        b {
            margin-bottom: 7px;
        }
    }
}
</style>
