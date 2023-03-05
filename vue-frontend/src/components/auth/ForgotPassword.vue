<template>
    <div class="container">
        <div class="col-5 mx-auto">
            <h2>Recupera password</h2>
            <form action="" class="d-flex flex-column">
                <label for="email">Email</label>
                <input type="text" name="email">
                <a href>Recupera Password</a>
            </form>
        </div>
    </div>

</template>

<script>
import { useAuthStore } from '../../stores/auth';
import { ref } from 'vue';
    export default {
        data(){
            return{
                authStore : useAuthStore(),
                // form: ref({

                // })
            }
        }
        
    }
</script>

<style lang="scss" scoped>

</style>