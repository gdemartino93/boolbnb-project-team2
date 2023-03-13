import { createApp, markRaw } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

// impostiamo interceptor di axios per far in modo che tutte le chiamate avvengono da questa base url 
axios.defaults.withCredentials = true;
axios.defaults.baseURL = "http://localhost:8000";

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './assets/main.css'

const pinia = createPinia(); // crea l'istanza di Pinia prima di definire l'istanza dell'app Vue.js
pinia.use(({ store}) =>{ //estendiamo lo store pinia per gestire il routing dell'applicazione. Quindi abbiamo accesso al router nel nostro store pinia.
    store.router = markRaw(router)
});
const app = createApp(App);

const vuetify = createVuetify({
    components,
    directives,
  })

app.use(vuetify);
app.use(pinia);
app.use(router);

app.mount('#app');