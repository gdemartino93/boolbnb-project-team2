<template>
    <div class="container">
      <div class="col-5 mx-auto">
        <h2>Recupera password</h2>
        <div class="alert alert-success" role="alert" v-if="authStore.authStatus">
          Ti abbiamo inviato l'email per reimpostare la password. <br> Se non è presente nella Posta in entrata, controlla nella posta indesiderata.
        </div>
        <form action="POST" class="d-flex flex-column" @submit.prevent="authStore.handleForgotPassword(form.email)">
          <label for="email">Email</label>
          <input type="text" name="email" v-model="form.email">
          <div class="text-danger" v-if="authStore.errors.email">{{ authStore.errors.email[0] }}</div>

          <div class="my-2">
            <button type="submit" class="btn btn-success">Recupera password</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import { useAuthStore } from '../../stores/auth';
  import { ref } from 'vue';
  
  export default {
    setup() {
      const authStore = useAuthStore();
      const form = ref({ email: "" });
  
      return {
        authStore,
        form,
      };
    },
  };
  </script>
  
  <style lang="scss" scoped>
  
  </style>
  