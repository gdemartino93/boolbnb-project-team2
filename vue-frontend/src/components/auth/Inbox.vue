<script>
import { useAuthStore } from '../../stores/auth';

export default{
    data(){
        return{

            authStore: useAuthStore()
        }
    },
    methods: {

    },
    mounted(){

        this.authStore.getAptWithMsgs();
    }
}
</script>

<template>

    <h2>Messaggi ricevuti:</h2>

    <ul>
        <li v-for="apartment in authStore.aptMsg">
            
            {{ apartment.title }}

            <ul>
                <li v-for="message in apartment.messages">

                    <p>
                            
                        {{message.text}}
                    </p>
                </li>
            </ul>
        </li>
    </ul>
</template>

<style lang="scss" scoped>

</style>