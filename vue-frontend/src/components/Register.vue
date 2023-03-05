<template>
    <div>
      <h1>login</h1>
      <form class="d-flex" @submit.prevent="authStore.handleRegister(form)">
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
      </form>
    </div>
</template>
  
<script>
import { ref } from 'vue';
import { useAuthStore } from '../stores/auth';


  export default {
    data() {
      return {
        authStore: useAuthStore(),
        form: ref({
          name: "",
          lastname: "",
          birthdate: "",
          email: "",
          password: "",
          password_confirmation: "",
        }),
      };
    },
    methods: {


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
  