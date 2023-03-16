import { createApp, markRaw } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import axios from 'axios'

// impostiamo interceptor di axios per far in modo che tutte le chiamate avvengono da questa base url 
axios.defaults.withCredentials = true;
axios.defaults.baseURL = "http://localhost:8000";

const pinia = createPinia(); // crea l'istanza di Pinia prima di definire l'istanza dell'app Vue.js
pinia.use(({ store}) =>{ //estendiamo lo store pinia per gestire il routing dell'applicazione. Quindi abbiamo accesso al router nel nostro store pinia.
    store.router = markRaw(router)
});
const app = createApp(App);

  /* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faBars, faHome, faUser, faUserSecret, faPlus, faBed, faCheck, faEye } from '@fortawesome/free-solid-svg-icons'

// import { faBars, faHome, faUser, faUserSecret, faPlus, faBed, faEyeSlash } from '@fortawesome/free-solid-svg-icons'


/* add icons to the library */
library.add(faUserSecret,faUser,faBars,faHome, faPlus, faBed, faCheck,faEye)


import 'bootstrap/dist/css/bootstrap.css'

import './assets/main.css'

app.use(pinia);
app.use(router);
// app.component('VueSpinner', VueSpinner)
app.component('font-awesome-icon', FontAwesomeIcon)
app.mount('#app');