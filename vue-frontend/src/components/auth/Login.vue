<template>
  <section class="col-4 mx-auto">
    <h1>login</h1>
    <form @submit.prevent="authStore.handleLogin(form)">
      <span v-if="authStore.errors.email" >
        <span class="text-danger">
          {{ (authStore.errors.email[0]) === 'These credentials do not match our records.' 
        ? 
        "Nessuna corrispondenza "
        : ""
         }}</span>
      </span>
      <div class="d-flex flex-column">
        <label for="email">Email</label>
        <input type="text" name="email" v-model="form.email">
        <div v-if="authStore.errors.email">
        <span class="text-danger">{{ (authStore.errors.email[0]) === 'These credentials do not match our records.' ? "" : authStore.errors.email[0] }}</span>
        </div>
        <label for="password">Password</label>
        <input type="password" name="password" v-model="form.password">
        <div v-if="authStore.errors.password">
        <span class="text-danger">{{ authStore.errors.password[0] }}</span>
        </div>
      </div>
      <div class="d-flex align-items-center justify-content-between">
        <button type="submit" class="btn btn-success my-3">Login</button>
        <router-link :to="'/forgot-password'">Password Dimenticata</router-link>
      </div>

    </form>
  </section>
</template>

<script>
import { useAuthStore } from '../../stores/auth';
import { ref } from 'vue';

export default {
  data() {
    return {
      authStore: useAuthStore(),
      form: ref({
        email: "",
        password: ""
      })
    };
  },
  methods: {

  }
};
</script>

<style lang="scss" scoped>
</style>
