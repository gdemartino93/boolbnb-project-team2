import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth",{
    // nello state si ineriscono le variabili
    state: () => ({
        authUser: null,
        authErrors: []
    }),
    // nei getters si calcola il valore derivante dallo stato dell'applicazione per non ripetre codice.
    getters: {
        user: (state) => state.authUser,
        errors: (state) => state.authErrors,
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
            this.authErrors = [];
            await this.getToken();
            try {
                await axios.post("/login", {
                    email: data.email,
                    password: data.password,
                });
            this.router.push("/")    
            } catch (error) {
                if(error.response.status === 422){
                    this.authErrors = error.response.data.errors
                }
            }



          },
        //   gestione registrazione
        async handleRegister(data) {
            this.authErrors = [];
            await this.getToken();
            // usiamo trycatch per la gestione degli errori ed evitare crash dell'applicazione e gestione degli errori
            try {
                await axios.post('/register',{
                    name : data.name,
                    lastname : data.lastname,
                    email : data.email,
                    birthdate : data.birthdate,
                    password : data.password,
                    password_confirmation : data.password_confirmation
                });        
                this.router.push('/')    
            } catch (error) {
                if ( error.response.status === 422){
                    this.authErrors = error.response.data.errors
                }
            }
          },
        // gestiamo il logout
        async handleLogout(){
            await axios.post('/logout');
            this.authUser = null;
        },
        // async handleForgetPassword(email){
        //     this.authErrors = [];
        //     this.getToken();
        //     try {
        //         awai
        //     } catch (error) {
                
        //     }
        // }


    }
})