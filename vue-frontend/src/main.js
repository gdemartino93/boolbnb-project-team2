import { createApp, markRaw } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import axios from 'axios'

// impostiamo interceptor di axios per far in modo che tutte le chiamate avvengono da questa base url 
axios.defaults.withCredentials = true;
axios.defaults.baseURL = "http://localhost:8000";
import './assets/main.css'

const pinia = createPinia(); // crea l'istanza di Pinia prima di definire l'istanza dell'app Vue.js
pinia.use(({ store}) =>{ //estendiamo lo store pinia per gestire il routing dell'applicazione. Quindi abbiamo accesso al router nel nostro store pinia.
    store.router = markRaw(router)
});
const app = createApp(App);

app.use(pinia);
app.use(router);

app.mount('#app');
