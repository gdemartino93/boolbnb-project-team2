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
        },
        close(){

            this.isOpen = false;
        }
    },
    mounted() {
        this.authStore.getAptWithMsgs();
        console.log(this.authStore.aptMsg);
    },
}
</script>

<template>
<div class="container inbox">
    <div id="msgBox" class="row g-0">
            <a href="" id="msgBox-header" class="fs-3 list-group-item list-group-item-action">
            Messaggi in arrivo
        </a>
        <div class="col-md-4 bg-light message">
            <div class="list-group">

            <a v-for="(apartment, index) in authStore.aptMsg" :key="index" class="list-group-item list-group-item-action" @click="openMsg(apartment.id)">
                {{ apartment.title }}
                <span v-if="apartment.messages.length > 0" class="badge bg-danger rounded-pill">{{ apartment.messages.length }}</span>
            </a>
            <span class="fs-3 text-center my-3" v-if="authStore.aptMsg.length == 0">Non ci sono nuovi messaggi</span>
            </div>
        </div>
            <div class="col-md-8">
                <div id="messageContent" v-if="isOpen">
                    <div v-for="(message, index) in apartment.messages" :key="index" class="singleMsg">
                        <div class="header bot fs-6 fw-bold p-2">
                        Il tuo messaggio da <span style="color: #ff3d00">{{ message.name }}</span>
                        </div>
                        <div class="text p-2">
                        <p>{{ message.text }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style lang="scss" scoped>
.inbox{
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    .message{
        height: 60vh;
    }
    #messageContent{
        overflow-y: auto;
        height: 60vh;
    }
}
#msgBox{
    cursor: pointer;
    box-shadow: black 10px 10px 10px;
    #msgBox-header{
        background-color: #ff3d00;
        height: 5vh;
    }

}
.singleMsg{
    border: 1px solid black;
}
</style>