<script>
import { useAuthStore } from '../../stores/auth';

export default {
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

        <div id="box" class="container d-flex gap-5 bg-white p-2">
            <ul class="col-10 mx-auto">
                <li v-for="(apartment, index) in authStore.aptMsg" :key="index">
                    <div v-for="message in apartment.messages"
                        class="message d-flex align-items-center border border-danger rounded my-2">
                        <font-awesome-icon class="letter ms-2" icon="fa-solid fa-envelope" />
                        <div class="ms-2"><b>{{ message.mail }}</b></div>
                        <div class="date ms-auto">{{ message.created_at.slice(0, 16).replace('T', ' ') }}</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.container {
    padding-top: 60px;
}

ul {
    list-style-type: none;

    .letter {
        color: orange;
    }
}
</style>