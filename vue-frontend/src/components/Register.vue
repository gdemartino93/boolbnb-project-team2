<template>
    <div>
      <h1>login</h1>
      <form class="d-flex" @submit.prevent="handleRegister">
        <label for="name">Nome</label>
        <input type="text" name="name" v-model="form.name">
  
        <label for="lastname">Cognome</label>
        <input type="text" name="lastname" v-model="form.lastname">
  
        <label for="date">Data di nascita</label>
        <input type="date" name="birthdate" v-model="form.birthdate" >
  
        <label for="email">Email</label>
        <input type="text" name="email" v-model="form.email" >
  
        <label for="email">Password</label>
        <input type="password" name="password" v-model="form.password">
  
        <label for="email">Repeat Password</label>
        <input type="password" name="password_confirmation" v-model="form.password_confirmation">
  
        <button type="submit" class="">Login</button>
        <button type="submit">stampa</button>
      </form>
    </div>
  </template>
  
  <script>
  import { useRouter } from 'vue-router';
  import { ref } from 'vue';
  import axios from 'axios';
  axios.defaults.baseURL = 'http://localhost:8000';
  axios.defaults.withCredentials = true;

  export default {
    data() {
      return {
        form: {
          name: "",
          lastname: "",
          birthdate: "",
          email: "",
          password: "",
          password_confirmation: "",
        },
      };
    },
    methods: {
      async handleRegister() {
        await this.getToken();
        await axios.post('/register',{
            name : this.form.name,
            lastname : this.form.lastname,
            email : this.form.email,
            birthdate : this.form.birthdate,
            password : this.form.password,
            password_confirmation : this.form.password_confirmation
        });
        this.$router.push('/');
      },
      async getToken() {
        await axios.get('/sanctum/csrf-cookie');
      },
    },
  };
  </script>
  
  <style scoped>
  .d-flex {
    display: flex;
    flex-direction: column;
    width: 500px;
    margin: 0 auto;
  }
  </style>
  