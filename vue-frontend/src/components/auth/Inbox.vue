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
        console.log(this.authStore.aptMsg);
    },
}
</script>

<template>

    <h2>Messaggi ricevuti:</h2>
    
    <div class="container d-flex flex-wrap gap-5 mt-5">

        <Messages v-for="apartment in authStore.aptMsg" :apartment="apartment" />
    </div>
</template>

<style lang="scss" scoped>

</style>