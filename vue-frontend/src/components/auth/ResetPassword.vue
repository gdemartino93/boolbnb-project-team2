<template>
    <div class="container">
        <div class="col-5 mx-auto">
            <h2>Resetta password password</h2>
            <form action="" class="d-flex flex-column" @submit.prevent="authStore.handleResetPassword(form)">
                <label for="password">Scegli nuova password</label>
                <input type="password" name="password" v-model="form.password" >
                <label for="newPassword">Conferma nuova newPassword</label>
                <input type="password" name="newPassword" v-model="form.password_confirmation" >
                <div class="col-6 my-2">
                    <button class="btn btn-success">Conferma nuova password</button>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
import { ref } from 'vue';
import { useAuthStore } from '../../stores/auth';
import { useRoute } from 'vue-router';

export default {
    data() {
        return {
            authStore: useAuthStore(),
            form: ref({
            password: '',
            password_confirmation: '',
            email: useRoute().query.email, //passiamo email come richiesto dalla chiamata api per cambio password
            token: useRoute().params.token,//passiamo token come richiesto dalla chiamata api per cambio password
            }),
        };
    },
}
</script>

<style lang="scss" scoped>

</style>