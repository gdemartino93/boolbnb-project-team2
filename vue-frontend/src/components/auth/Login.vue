<template>
  <div class="container-fluid">
          <div class="row no-gutter">
             
              <div class="col-md-6 d-none d-md-flex bg-image"></div>
              
              <div class="col-md-6 bg-light">
                  <div class="login d-flex align-items-center py-5">
                     
                      <div class="container">
                          <div class="row">
                              <div class="col-lg-10 col-xl-7 mx-auto">
                                  <h3 class="fs-1">Benvenuto su AirBnb</h3>
                                  <p class="text-muted mb-4">Accedi e trova un appartamento per un soggiorno indimenticabile</p>
                                  <form>
                                      <div class="mb-3">
                                          <input id="inputEmail" type="email" placeholder="Email address" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4" />
                                      </div>
                                      <div class="mb-3">
                                          <input id="inputPassword" type="password" placeholder="Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary" />
                                      </div>
                                      <div class="form-check">
                                          <input id="customCheck1" type="checkbox" checked class="form-check-input" />
                                          <label for="customCheck1" class="form-check-label">Remember password</label>
                                      </div>
                                      <div class="d-grid gap-2 mt-2">
                                      <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign in</button>
                                      </div>
                                      
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
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
<style>
    .login,
    .image {
      min-height: 100vh;
    }
    .bg-image {
      background-image: url('/login.png');
      background-size: cover;
      background-position: center center;
    }
</style>