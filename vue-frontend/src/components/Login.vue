<template>
  <section class="col-4 mx-auto">
    <h1>login</h1>
    <form @submit.prevent="authStore.handleLogin(form)">
      <div class="d-flex flex-column">
        <label for="email">Email</label>
        <input type="text" name="email" v-model="form.email">
        <label for="password">Password</label>
        <input type="password" name="password" v-model="form.password">
      </div>
      <button type="submit" class="btn btn-success my-3">Login</button>
    </form>
  </section>
</template>

<script>
import { useAuthStore } from '../stores/auth';
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
