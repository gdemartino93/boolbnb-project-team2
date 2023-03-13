<template>
  <section class="container d-flex flex-column justify-content-center align-items-center">
    <h1 class="my-5">Login</h1>

    <v-sheet width="300" class="mx-auto">
      <v-form @submit.prevent="authStore.handleLogin(form)">
        <v-text-field
          v-model="form.email"
          :rules="rules"
          label="Email"
        >
        </v-text-field>
        <v-text-field
              v-model="form.password"
              :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[rules.required, rules.min]"
              :type="show2 ? 'text' : 'password'"
              name="input-10-2"
              label="Visible"
              hint="At least 8 characters"
              class="input-group--focused"
              @click:append="show2 = !show2"
            ></v-text-field>
        <v-btn type="submit" block class="mt-2">Submit</v-btn>
      </v-form>
    </v-sheet>


        <input type="password" name="password" v-model="form.password">

  
      <div class="d-flex align-items-center justify-content-between">
        <button type="submit" class="btn btn-success my-3">Login</button>
        <router-link :to="'/forgot-password'">Password Dimenticata</router-link>
      </div>


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
      }),
      show1: false,
      show2: true,
      password: 'Password',
      rules: {
        required: value => !!value || 'Required.',
        min: v => v.length >= 8 || 'Min 8 characters',
        emailMatch: () => (`The email and password you entered don't match`),
      },
      
    };
  },
  methods: {

  }
};
</script>

<style lang="scss" scoped>

</style>
