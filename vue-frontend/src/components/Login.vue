<template>
    <div>
      <h1>login</h1>
      <form @submit.prevent="handleLogin">
        <label for="email">Email</label>
        <input type="text" name="email" v-model="email">
        <label for="password">Password</label>
        <input type="password" name="password" v-model="password">
        <button type="submit" class="">Login</button>
      </form>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  axios.defaults.baseURL = 'http://localhost:8000';
  axios.defaults.withCredentials = true;
  
  export default {
    data() {
      return {
        email: '',
        password: '',
      };
    },
    methods: {
      async handleLogin() {
        await this.getToken();
        await axios.post('/login', {
          email: this.email,
          password: this.password,
        });
        this.$router.push('/');
      },
      async getToken() {
        await axios.get('/sanctum/csrf-cookie');
      },
    },
  };
  </script>
  
  <style lang="scss" scoped>
  </style>
  