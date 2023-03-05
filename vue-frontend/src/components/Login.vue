<template>
  <div>
    <h1>login</h1>
    <form @submit.prevent="authStore.handleLogin(form)">
      <label for="email">Email</label>
      <input type="text" name="email" v-model="form.email">
      <label for="password">Password</label>
      <input type="password" name="password" v-model="form.password">
      <button type="submit">Login</button>
    </form>
  </div>
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
