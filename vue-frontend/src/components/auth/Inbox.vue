<script>
import { useAuthStore } from '../../stores/auth';
import Messages from './Messages.vue';

export default{
    components: { Messages },
    data() {
        return {
            authStore: useAuthStore()
        };
    },
    methods: {},
    mounted() {
        this.authStore.getAptWithMsgs();
    },
}
</script>

<template>
    
    <div id="inboxContainer">

        <div class="container" id="header">
            <h3>

                Posta in arrivo.
            </h3>
        </div>
        
        <div class="container d-flex flex-wrap gap-5 mt-5">
    
            <Messages v-for="apartment in authStore.aptMsg" :apartment="apartment"  v-if="authStore.messages.length > 0"/>
            <div v-else class="d-flex justify-center">
                <span>Non hai messaggi</span>
            </div>
        </div>
    </div>

</template>

<style lang="scss" scoped>

#inboxContainer {

    padding-top: 7rem;
    background-color: #bbc6c7;
    height: 100vh;
    overflow-y: auto;

    #header {

        background-image: linear-gradient(to right, #ff3d00, #FF5F00, #ff3d00);
        color: #fff;
        padding: .5rem;
        border-radius: 10px;
        font-weight: bold;
    }
}
</style>