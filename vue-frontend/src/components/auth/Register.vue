<template>
    <div class="container col-6">
      <h1>registrazione</h1>
      <form class="d-flex flex-column mx-auto" @submit.prevent="authStore.handleRegister(form)">
        <div class="d-flex flex-column">
          <label for="name">Nome</label>
        <input type="text" name="name" v-model="form.name">
        <!-- gestione errore -->
        <div v-if="authStore.errors.name">
          <span class="text-danger">{{ authStore.errors.name[0] }}</span>
        </div>
  
        <label for="lastname">Cognome</label>
        <input type="text" name="lastname" v-model="form.lastname">
        <!-- gestione errore -->
        <div v-if="authStore.errors.lastname">
          <span class="text-danger">{{ authStore.errors.lastname[0] }}</span>
        </div>
  
        <label for="date">Data di nascita</label>
        <input type="date" name="birthdate" v-model="form.birthdate" >
        <!-- gestione errore -->
        <div v-if="authStore.errors.birthdate">
          <span class="text-danger">{{ authStore.errors.birthdate[0] }}</span>
        </div>
  
        <label for="email">Email</label>
        <input type="text" name="email" v-model="form.email" >
        <!-- gestione errore -->
        <div v-if="authStore.errors.email">
          <span class="text-danger">{{ authStore.errors.email[0] }}</span>
        </div>        
  
        <label for="email">Password</label>
        <input type="password" name="password" v-model="form.password">
        
  
        <label for="email">Repeat Password</label>
        <input type="password" name="password_confirmation" v-model="form.password_confirmation">
        <!-- gestione errore -->
        <div v-if="authStore.errors.password">
          <span class="text-danger">{{ authStore.errors.password[0] }}</span>
        </div>          
      </div>
      <div>
        <button type="submit" class="btn btn-success my-3">Register</button>
      </div>

      </form>
    </div>
</template>
  
<script>
import { ref } from 'vue';
import { useAuthStore } from '../../stores/auth';


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
    beforeRouteLeave(to,from,next){
      alert("Stai lasicando la pagina");
      next();
    }
  };
  </script>
  
<style scoped>

</style>
  