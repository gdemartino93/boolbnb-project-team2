import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth",{
    // nello state si ineriscono le variabili
    state: () => ({
        authUser: null
    }),
    // nei getters si calcola il valore derivante dallo stato dell'applicazione per non ripetre codice.
    getters: {
        user: (state) => state.authUser
    },
    // qui ci vanno le funzioni tra cui le chiamate API
    actions:{
        // funzione per ottenere il token
        async getToken(){
            await axios.get('/sanctum/csrf-cookie');
        },
        // otteniamo le informazioni dell'user
        // gestiamo con il trycatch per evitare di far crashare l'applicazione quando l'utente non è loggato.
        async getUser(){
            try {
                await this.getToken();
                const response = await axios.get('/api/user');
                this.authUser = response.data;
            } catch (error) {
                console.log("Errore get user" + error)
            }
        }
        ,
        // gestione login
        async handleLogin(data) {
            await this.getToken();
            await axios.post("/login", {
              email: data.email,
              password: data.password,
            });
            this.router.push("/")

          },
        //   gestione registrazione
        async handleRegister(data) {
            // usiamo trycatch per la gestione degli errori ed evitare crash dell'applicazione
            try {
                await this.getToken();
                await axios.post('/register',{
                    name : data.name,
                    lastname : data.lastname,
                    email : data.email,
                    birthdate : data.birthdate,
                    password : data.password,
                    password_confirmation : data.password_confirmation
                });            
            } catch (error) {
                console.log("Errore registrazione: " + error);
            }
            this.router.push('/')
          },

    }
})