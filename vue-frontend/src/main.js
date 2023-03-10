import { createApp, markRaw } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import { createVuetify } from 'vuetify'

import { aliases, mdi } from 'vuetify/iconsets/mdi'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader

// impostiamo interceptor di axios per far in modo che tutte le chiamate avvengono da questa base url 
axios.defaults.withCredentials = true;
axios.defaults.baseURL = "http://localhost:8000";
// import 'vuetify/styles'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './assets/main.css'

const pinia = createPinia(); // crea l'istanza di Pinia prima di definire l'istanza dell'app Vue.js
pinia.use(({ store}) =>{ //estendiamo lo store pinia per gestire il routing dell'applicazione. Quindi abbiamo accesso al router nel nostro store pinia.
    store.router = markRaw(router)
});
const app = createApp(App);

const vuetify = createVuetify({
  icons: {
    defaultSet: 'mdi',
    aliases,
    sets: {
      mdi,
    }
  },
    components,
    directives,

  })

  /* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUser, faUserSecret } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret,faUser)


app.use(vuetify);
app.use(pinia);
app.use(router);
app.component('font-awesome-icon', FontAwesomeIcon)
app.mount('#app');