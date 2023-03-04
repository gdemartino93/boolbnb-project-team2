import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import axios from 'axios'

// impostiamo interceptor di axios per far in modo che tutte le chiamate avvengono da questa base url 
axios.defaults.baseURL = "http://localhost:8000";
import './assets/main.css'

const pinia = createPinia(); // crea l'istanza di Pinia prima di definire l'istanza dell'app Vue.js

const app = createApp(App);

app.use(pinia);
app.use(router);

app.mount('#app');
