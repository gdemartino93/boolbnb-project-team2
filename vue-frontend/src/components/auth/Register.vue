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
        regexEmail : "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"
      };
    },
    methods:{

    }
  };
  </script>
  
<style scoped>

</style>
<template>
  <div class="row">
    <div class="col-md-6">
      <div class="test">
        <form class="d-flex flex-column mx-auto" @submit.prevent="authStore.handleRegister(form)">
          <div class="step d-flex flex-column align-items-start">
            <h3>Registrazione</h3>
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" v-model="form.name" class="form-control" :class="{'is-invalid': authStore.errors.name}">
                <div class="invalid-feedback" v-if="authStore.errors.name">
                    {{ authStore.errors.name[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="lastname">Cognome</label>
                <input type="text" name="lastname" v-model="form.lastname" class="form-control" :class="{'is-invalid': authStore.errors.lastname}">
                <div class="invalid-feedback" v-if="authStore.errors.lastname">
                  {{ authStore.errors.lastname[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="birthdate">Data di nascita</label>
                <input type="date" name="birthdate" v-model="form.birthdate" class="form-control" :class="{'is-invalid': authStore.errors.birthdate}">
                <div class="invalid-feedback" v-if="authStore.errors.birthdate">
                  {{ authStore.errors.birthdate[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" v-model="form.email" class="form-control" :class="{'is-invalid': authStore.errors.email}">
                <div class="invalid-feedback" v-if="authStore.errors.email">
                  {{ authStore.errors.email[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" v-model="form.password" class="form-control" :class="{'is-invalid': authStore.errors.password}">
                <div class="invalid-feedback" v-if="authStore.errors.password">
                  {{ authStore.errors.password[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Ripeti password</label>
                <input type="password" name="password_confirmation" v-model="form.password_confirmation" class="form-control" :class="{'is-invalid': authStore.errors.password_confirmation}">
                <div class="invalid-feedback" v-if="authStore.errors.password_confirmation">
                  {{ authStore.errors.password_confirmation[0] }}
                </div>
            </div>
            <button class="btn btn-success mt-3" type="submit" style="background-color:#ef2759; font-size: 15px;">Registrati</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-6">
      <img src="https://images.unsplash.com/photo-1476900543704-4312b78632f8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="Immagine" class="img-fluid">
    </div>
  </div>
</template>

<style>

.col-md-6 {
  padding: 0;
}

.test {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}

.step {
  width: 90%;
  max-width: 400px;
  margin: 0 auto;
  border-radius: 5px;
  padding: 30px;
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
  background-color: #ef2759;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
}

img {
  display: block;
  margin: 0 auto;
}



</style>
