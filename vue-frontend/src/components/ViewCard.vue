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
            isOpen: false
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
        async getView(id) {
            try {
                axios.post('/api/v1/apartment/' + id)
            } catch (error) {
                console.log(error)
            }
        },
        openSec(){

            this.isOpen = !this.isOpen;
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
    <div class="container-fluid" style="background-color: #FFD8A9;">
        <div class="container d-flex flex-wrap" style="background-color: #FFD8A9;">
            <div class=" my-left col-lg-5 mx-auto my-auto">
                <div class="img my-5">
                    <img :src="apt.img" :alt="apt.img">
                </div>
            </div>
            <div class="my-right d-flex flex-column justify-content-around col-md-12 col-lg-6 mx-auto my-5">
                <ul class="col-lg-12">
                    <li class="info m-2 p-2"><b class="mx-1 fs-5" style="color: #ff3d00">{{
                        apt.address
                    }}</b></li>
                    <li class="my-1 col-md-12 m-2 p-2 fs-1 text">
                        <b>{{ apt.title }}</b>
                    </li>
                    <li class="description m-2 p-2 "><b>{{ apt.description }}</b></li>
                    <ul
                        class="whiteBox d-flex flex-wrap col-xs-10 col-sm-12 col-md-10 col-lg-12 bg-light py-3 px-5 mx-auto">
                        <li class="info p-2 col-xs-5 col-sm-6 col-md-5 col-lg-6"><font-awesome-icon style="color: #ff3d00"
                                icon="fa-solid fa-house" /> <b class="mx-1">{{
                                    apt.room_number
                                }}
                                Stanze</b>
                        </li>
                        <li class="info p-2 col-xs-5 col-sm-6 col-md-5 col-lg-6"><font-awesome-icon style="color: #ff3d00"
                                icon="fa-solid fa-bed" /><b class="mx-1">{{ apt.bed_number
                                }}
                                Letti</b>
                        </li>
                        <li class="info p-2 col-xs-5 col-sm-6 col-md-5 col-lg-6"><font-awesome-icon style="color: #ff3d00"
                                icon="fa-solid fa-bath" /><b class="mx-1">{{ apt.bath_number
                                }}
                                Bagni</b>
                        </li>
                        <li class="info p-2 col-xs-5 col-sm-6 col-md-5 col-lg-6"><font-awesome-icon style="color: #ff3d00"
                                icon="fa-solid fa-ruler" /><b class="mx-1">{{
                                    apt.square_meters
                                }}
                                Metri
                                Quadrati</b>
                        </li>
                        
                        <button class="btn align-self-center p-2 m-2 rounded-pill text-white"
                            style="background-color: #ff3d00;" @click="openSec">
                            <b>Servizi
                                Aggiuntivi</b>
                        </button>

                        <div v-if="isOpen" class="addServices px-5">
                            
                            <ul class="services">
                                <li class="my-2" v-for="service in services">
                                    <b><font-awesome-icon class="check" icon="fa-solid fa-check" /> {{
                                        service.name }}</b>
                                </li>
                            </ul>
                        </div>
                    </ul>
                    
                </ul>

                <div class="ms-container d-flex col-lg-12 py-2" id="ms_container">

                    <button type="button" id="modalBtn" class="btn p-3 m-2 text-white fw-bold"
                        data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Invia
                        un
                        messaggio</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog m-auto">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Il tuo messaggio</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div v-if="msgSent" class="text-center">

                                        <font-awesome-icon id="check" class="bg-success p-3 rounded-circle fs-3 mx-auto"
                                            icon="fa-solid fa-check" />
                                        <h3>Messaggio inviato correttamente!</h3>
                                    </div>
                                    <form v-else method="post">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Mail:</label>
                                            <input type="text" class="form-control" name="recipient-name"
                                                v-if="this.authStore.user" v-model="authStore.user.email" disabled>
                                            <input type="text" class="form-control" name="recipient-name" v-else
                                                v-model="msgMail">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Nome:</label>
                                            <input type="text" class="form-control" name="name" v-if="this.authStore.user"
                                                v-model="authStore.user.name" disabled>
                                            <input type="text" class="form-control" name="name" v-else v-model="msgName">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Messaggio:</label>
                                            <textarea class="form-control" id="message-text" v-model="msgTxt"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn ms_close" data-bs-dismiss="modal">Chiudi</button>
                                    <button type="button" class="btn ms_send" @click="sendMessage"
                                        v-if="!msgSent">Invia</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- use v-if because value onmounted start as undefinied and app crash -->
            <div class="col-sm-10 col-md-11 col-lg-11 mx-auto">
                <b>Dove Siamo</b>
                <Map v-if="apt.latitude && apt.longitude" :center="{ lat: apt.latitude, lon: apt.longitude }"
                    :flats="flats" />
            </div>
        </div>
    </div>
</template>


  

<style lang="scss" scoped>
// @use '../assets/main.scss' as *;

.container {
    font-size: 14px;
    margin: 0 auto;
    padding: 20px 0;
    padding-top: 100px;
    background-color: #f8f9fa;

    .my-left {
        img {
            width: 100%;
        }
    }

    .my-right {
        margin: o auto;

        ul {
            list-style: none;
            
            .whiteBox {
    
                box-shadow: 3px 3px rgba(0, 0, 0, .2);
                transition: .4s ease-out;

                &:hover {

                    box-shadow: 6px 6px rgba(0, 0, 0, .3);
                }

                .addServices {

                    border: 1px solid #ff3d00;
                    
                    .services {

                        transition: .4s ease-in-out;
                    }

                    .check {
                        
                        color: #ff3d00;
                    }
                }
            }
        }


        .info {
            // border: 1px solid rgb(171, 171, 103);
            // border-radius: 10px;

            i {
                font-size: 30px;
                width: 40px;
                color: rgb(171, 171, 103);

            }
        }
    }

    #modalBtn {

        border-radius: 5px;
        background-image: linear-gradient(to right, #ff3d00, #FF5F00);
        box-shadow: 3px 3px rgba(0, 0, 0, .3);
    }

    .ms_close, .ms_send {

        border: 2px solid #ff3d00;
        color: #ff3d00;
        transition: .4s ease-in-out;

        &:hover {

            background-color: #ff3d00;
            color: #fff;
        }
    }
}
</style>
