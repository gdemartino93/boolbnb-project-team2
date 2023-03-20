<script>
import { ref } from 'vue';
import { useAuthStore } from '../../stores/auth';


export default {
  data() {
    return {
      authStore: useAuthStore(),
      form: ref({
        name: "",
        errName: false,
        lastname: "",
        birthdate: "",
        email: "",
        password: "",
        password_confirmation: "",
      }),
      regexEmail: "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"
    };
  },
  methods: {

  }
};
</script>
  
<style scoped></style>
<template>
  <div class="row">
    <div class="col-md-6">
      <div class="wrapper">
        <form class="d-flex flex-column mx-auto" @submit.prevent="authStore.handleRegister(form)">
          <div class="step d-flex flex-column align-items-start">
            <h3 style="margin-bottom: 20px; width: 100%;">Registrazione</h3>
            <div class="form-group">
              <input id="inputNome" type="text" placeholder="Nome" name="name" v-model="form.name"
                class="form-control rounded-pill border-0 shadow-sm px-4" :class="{ 'is-invalid': authStore.errors.name }">
              <div class="invalid-feedback" v-if="authStore.errors.name">
                {{ authStore.errors.name[0] }}
              </div>
            </div>
            <div class="form-group">
              <input type="text" placeholder="Cognome" name="lastname" v-model="form.lastname"
                class="form-control rounded-pill border-0 shadow-sm px-4"
                :class="{ 'is-invalid': authStore.errors.lastname }">
              <div class="invalid-feedback" v-if="authStore.errors.lastname">
                {{ authStore.errors.lastname[0] }}
              </div>
            </div>
            <div class="form-group">
              <input type="text" placeholder="Email" name="email" v-model="form.email"
                class="form-control rounded-pill border-0 shadow-sm px-4" :class="{ 'is-invalid': authStore.errors.email }">
              <div class="invalid-feedback" v-if="authStore.errors.email">
                {{ authStore.errors.email[0] }}
              </div>
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" name="password" v-model="form.password"
                class="form-control rounded-pill border-0 shadow-sm px-4"
                :class="{ 'is-invalid': authStore.errors.password }">
              <div class="invalid-feedback" v-if="authStore.errors.password">
                {{ authStore.errors.password[0] }}
              </div>
            </div>
            <div class="form-group">
              <input type="password" placeholder="Ripeti Password" name="password_confirmation"
                v-model="form.password_confirmation" class="form-control rounded-pill border-0 shadow-sm px-4"
                :class="{ 'is-invalid': authStore.errors.password_confirmation }">
              <div class="invalid-feedback" v-if="authStore.errors.password_confirmation">
                {{ authStore.errors.password_confirmation[0] }}
              </div>
            </div>
            <div class="form-group">
              <label for="birthdate">Data di nascita</label>
              <input type="date" name="birthdate" v-model="form.birthdate"
                class="form-control rounded-pill border-0 shadow-sm px-4"
                :class="{ 'is-invalid': authStore.errors.birthdate }">
              <div class="invalid-feedback" v-if="authStore.errors.birthdate">
                {{ authStore.errors.birthdate[0] }}
              </div>
            </div>
            <button class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm" type="submit"
              style="background-color:#0d6efd; font-size: 12px;">Registrati</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-6 bg-image">
    </div>
  </div>
</template>

<style>
body {
  overflow: hidden;
}


.wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}


.form-group {
  margin-bottom: 20px;
}

label {
  font-weight: bold;
  margin-bottom: 5px;
  text-align: left;
  display: block;
  width: 100%;
}

input {
  width: 100%;
  padding: 10px;
  border-radius: 3px;
  border: 1px solid #d0d0d0;
}

button {
  align-self: flex-start;
  margin-top: 20px;
  padding: 10px 20px;
  border-radius: 3px;
  border: none;
  background-color: #0d6efd;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  width: 100%;
}

.bg-image {
  background-image: url('/login.png');
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  height: 100vh;
}

</style>
