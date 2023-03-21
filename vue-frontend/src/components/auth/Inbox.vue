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

        <div id="box" class="container gap-5 bg-white p-2">
            <div id="header" class="text-white col-8 mx-auto fs-6 fw-bold p-1">Messaggi in arrivo</div>
            <ul class="col-8 mx-auto">
                <li v-for="(apartment, index) in authStore.aptMsg" :key="index" class="listItem col-11"
                @click="openMsg(apartment.id)">
                    <div v-for="(message, id) in apartment.messages" :key="id"
                        class="message d-flex align-items-center">
                        {{ apartment.id }}
                        <font-awesome-icon class="letter ms-2" icon="fa-solid fa-envelope" />
                        <div class="ms-2"><b>{{ message.mail }}</b></div>
                        <div class="date ms-auto">{{ message.created_at.slice(0, 16).replace('T', ' ') }}</div>
                    </div>
                </li>
                
                <div id="messageContent" v-if="isOpen">

                    <!-- <h3>Il tuo messaggio da {{ apartment.messages[1].name }}</h3>  -->
                    <div v-for="(message, index) in apartment.messages" :key="index">
                        <h3>Il tuo messaggio da {{ message.name }}</h3>

                        <div>
                            {{ message.text }}
                        </div>
                    </div>
                </div>
                
            </ul>
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

    #header {

        background-color: #ff3d00;
    }

    ul {
        list-style-type: none;
        border-left: 1px solid #2E3840;
        border-right: 1px solid #2E3840;
        border-bottom: 1px solid #2E3840;
        height: 90%;

        .listItem {

            cursor: pointer;

            .letter {
                color: #ff3d00;
            }
    
            .date {
    
                font-size: 10px;
            }
        }

    }
}

</style>