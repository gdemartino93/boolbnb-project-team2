<template>

  <section class="container">
    <div class="col-12 col-md-8 col-lg-6 mx-auto">
      <span v-if="authStore.errors.email" >
        <span class="text-danger">
          {{ (authStore.errors.email[0]) === 'These credentials do not match our records.' 
        ? 
        "Nessuna corrispondenza "
        : ""
         }}</span>
      </span>
      <v-form @submit.prevent="authStore.handleLogin(form)">
        <v-text-field
                  append-icon="mdi-at"
                  v-model="form.email"
                  :rules="emailRules"
                  label="E-mail"
                  required
        >
        </v-text-field>
        <v-text-field
              v-model="form.password"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[rules.required, rules.min]"
              :type="show1 ? 'text' : 'password'"
              name="input-10-1"
              label="Password"
              counter
              @click:append="show1 = !show1"
          ></v-text-field>
        <!-- da inserire dopo aver validato nel backend la lunghezza minima della password  -->
          <!-- hint="At least 8 characters" -->

        <v-btn type="submit" block class="mt-2">Submit</v-btn>
      </v-form>
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
      emailRules: [
      value => {
        if (value) return true

        return 'E-mail is requred.'
      },
      value => {
        if (/.+@.+\..+/.test(value)) return true

        return 'E-mail must be valid.'
      },
    ],
    show1: false,
      show2: true,
      password: 'Password',
      rules: {
        required: value => !!value || 'Required.',
        // da validare nel backend e poi scommentare

        // min: v => v.length >= 8 || 'Min 8 characters',
        // emailMatch: () => (`The email and password you entered don't match`),
      },
    };
  },
  methods: {
  }
};
</script>

<style lang="scss" scoped>
</style>