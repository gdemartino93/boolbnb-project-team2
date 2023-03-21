<script>
import { useAuthStore } from '../../stores/auth';
import axios from 'axios';
// import Messages from './Messages.vue';

export default {
    // components: {Messages},
    data() {
        return {
            authStore: useAuthStore(),
            isOpen: false,
            apartment: {}
        }
    },
    methods: {

        async openMsg(id){

            this.isOpen = true;
            // console.log(index);

            try {
                
                const response = await axios.get('api/apartment/' + id);
                this.apartment = response.data.apartment;
                console.log(this.apartment);
            } catch (error) {
                
                console.log(error);
            }
        }
    },
    mounted() {
        this.authStore.getAptWithMsgs();
        console.log(this.authStore.aptMsg);
    },
}
</script>

<template>
    <div id="inboxContainer" class="container">

        <div id="box" class="container gap-5 p-2">
            <div class="header text-white col-8 mx-auto fs-6 fw-bold p-1">Messaggi in arrivo</div>
            <div id="msgBox" class="col-8 mx-auto bg-white">
                <div v-for="(apartment, index) in authStore.aptMsg" :key="index" class="listItem col-11"
                @click="openMsg(apartment.id)">
                    <p>Appartamento: <span style="color: #ff3d00">{{ apartment.title }}</span></p>
                    <ul>

                        <li v-if="apartment.messages.length > 0" v-for="(message, id) in apartment.messages" :key="id"
                            class="message d-flex align-items-center">
                            <font-awesome-icon class="letter ms-2" icon="fa-solid fa-envelope" />
                            <p class="mail ms-2"><b>{{ message.mail }}</b></p>
                            <p class="date ms-auto">{{ message.created_at.slice(0, 16).replace('T', ' ') }}</p>
                        </li>

                        <li v-else>
                            <p> Non hai messaggi per questo appartamento!</p>
                        </li>
                    </ul>
                </div>
                
            </div>
                
            <div id="messageContent" v-if="isOpen" class="col-8 mx-auto p-1">

            
                <!-- <h3>Il tuo messaggio da {{ apartment.messages[1].name }}</h3>  -->
            
                <div v-for="(message, index) in apartment.messages" :key="index">
            
                    <div class="header bot col-10 mx-auto fs-6 fw-bold p-1">Il tuo messaggio da <span style="color: #ff3d00">{{ message.name }}</span></div>

            
                    <div class="bg-white col-10 mx-auto mb-2 p-1">
            
                        {{ message.text }}
            
                        <button class="btn rounded-pill fw-bold">Rispondi</button>
                    </div>

            
                </div>
            
            </div>
                
        </div>
    </div>
</template>

<style lang="scss" scoped>
#inboxContainer {
    padding-top: 60px;
    height: 100vh;
    
    #box {

        height: 500px;
        overflow-y: auto;
        margin-top: 5%;
    }

    .header {

        background-color: #ff3d00;
    }

    #msgBox {
        border-left: 1px solid #2E3840;
        border-right: 1px solid #2E3840;
        border-bottom: 1px solid #2E3840;
        height: 50%;
        overflow-y: auto;

        .listItem {

            cursor: pointer;
            padding: 1rem;

            ul {
                list-style-type: none;
                .message {

                    border: 1px solid #2E3840;
                    border-radius: 20px;
                    padding: .2rem .5rem;
                    margin-bottom: .5rem;

                    .mail {

                        margin-top: 10px;
                    }

                    .letter {
                        color: #ff3d00;
                        font-size: 20px;
                    }
            
                    .date {
            
                        font-size: 10px;
                        margin-top: 10px;
                    }
                }


            }

        }

    }

    #messageContent {

        background-color: #ff3d00;
        height: 50%;
        overflow-y: auto;

        .bot {

            background-color: #fff;
            color: #2E3840;
        }

        .btn {

            border: 2px solid #ff3d00;
            color: #ff3d00;
            transition: .4s ease-in-out;

            &:hover {

                background-color: #ff3d00;
                color: #fff;
            }
        }
    }
}

</style>