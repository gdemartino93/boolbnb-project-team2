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
    methods:{
      // goTo(){
        
      // }
    }
  };
  </script>
  
<style scoped>

</style>
<template>
 <div class="test col-12">
    <form class="d-flex flex-column mx-auto" @submit.prevent="authStore.handleRegister(form)">
      <!-- <div class="d-flex flex-column"> -->
        <!-- Step 1 -->
        <div class="step d-flex justify-content-center align-items-center">
          <label for="name">Nome</label>
          <input type="text" name="name" v-model="form.name">
          <button class="btn btn-success mx-2" type="button" @click="this.$refs.lastname.scrollIntoView({behavior: 'smooth'})">next</button>
          <!-- Gestione errore -->
          <div v-if="authStore.errors.name">
            <span class="text-danger">{{ authStore.errors.name[0] }}</span>
          </div>
        </div>
        <!-- Step 2 -->
        <div class="step d-flex justify-content-center align-items-center" >
          <label for="lastname">Cognome</label>
          <input type="text" name="lastname" v-model="form.lastname" ref="lastname">
          <button class="btn btn-success mx-2" type="button" @click="this.$refs.dateOB.scrollIntoView({behavior: 'smooth'})">next</button>
          <!-- Gestione errore -->
          <div v-if="authStore.errors.lastname">
            <span class="text-danger">{{ authStore.errors.lastname[0] }}</span>
          </div>
        </div>
        <!-- Step 3 -->
        <div class="step d-flex justify-content-center align-items-center">
          <label for="birthdate">Data di nascita</label>
          <input type="date" name="birthdate" v-model="form.birthdate" ref="dateOB">
          <button class="btn btn-success mx-2" type="button" @click="this.$refs.email.scrollIntoView({behavior: 'smooth'})">next</button>
          <!-- Gestione errore -->
          <div v-if="authStore.errors.birthdate">
            <span class="text-danger">{{ authStore.errors.birthdate[0] }}</span>
          </div>
        </div>
          <!-- step 4 -->
          <div class="step d-flex justify-content-center align-items-center">
            <label for="email">Email</label>
            <input type="text" name="email" v-model="form.email" ref="email">
            <button class="btn btn-success mx-2" type="button" @click="()=>{ this.$refs.password.scrollIntoView({behavior: &quot;smooth&quot;})}">next</button>
            <!-- gestione errore -->
            <div v-if="authStore.errors.email">
              <span class="text-danger">{{ authStore.errors.email[0] }}</span>
            </div>        
          </div>

          <!-- step 5 -->
          <div class="step d-flex justify-content-center align-items-center">
            <label for="password">Password</label>
            <input type="password" name="password" v-model="form.password" ref="password">
            <button class="btn btn-success mx-2" type="button" @click="()=>{ this.$refs.password_confirmation.scrollIntoView({behavior: &quot;smooth&quot;})}">next</button>
            <!-- gestione errore -->
            <div v-if="authStore.errors.password">
              <span class="text-danger">{{ authStore.errors.password[0] }}</span>
            </div>          
          </div>

          <!-- step 6 -->
          <div class="step d-flex justify-content-center align-items-center">
            <label for="password_confirmation">Repeat Password</label>
            <input type="password" name="password_confirmation" v-model="form.password_confirmation" ref="password_confirmation">
            <button class="btn btn-success mx-2" type="submit">Register</button>
            <!-- gestione errore -->
            <div v-if="authStore.errors.password_confirmation">
              <span class="text-danger">{{ authStore.errors.password_confirmation[0] }}</span>
            </div>          
          </div>
        <!-- </div> -->
      </form>
    </div>
</template>
  

<style>
.step{
  min-height: 100vh;
  background: bisque;
  
}
.test{
  height: 100vh;
  overflow: hidden;
}
</style>