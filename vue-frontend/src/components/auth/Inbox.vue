<script>
import { useAuthStore } from '../../stores/auth';

export default{
    data() {
        return {
            authStore: useAuthStore()
        };
    },
    methods: {},
    mounted() {
        this.authStore.getAptWithMsgs();
        console.log(this.authStore.aptMsg);
    },
}
</script>

<template>
    
    <div id="inboxContainer" class="container">

        <div id="box" class="container d-flex flex-wrap gap-5 mt-5 bg-white p-2">
            <ul class="w-75 mx-auto">
                <li v-for="(apartment, index) in authStore.aptMsg" :key="index">
                    <div v-for="message in apartment.messages" class="message d-flex p-1 mb-1">

                        <font-awesome-icon class="letter me-1" icon="fa-solid fa-envelope" />
                        <div><b>{{ message.mail }}</b></div>
                        <div class="date ms-auto">{{ message.created_at.slice(0, 16).replace('T', ' ') }}</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</template>

<style lang="scss" scoped>

#inboxContainer {

    padding-top: 5rem;
    height: 100vh;

    #box {
        height: 50vh;
        overflow-y: auto;
    }

    ul {

        list-style-type: none;

        .message {

            background-color: #D8D8D8;

            .letter {
    
                color: #ff3d00;
                font-size: 20px;
            }

            .date {

                font-size: 10px;
            }
        }
        
    }

}
</style>