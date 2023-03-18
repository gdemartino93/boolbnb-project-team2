<template>
    <div class="box col-4">
      <form action="" method="post" @submit.prevent="getReply">
        <input type="text" v-model="message">
        <span>{{ risposta }}</span>
        <button class="btn btn-success" type="submit">Invia</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { useAuthStore } from '../../stores/auth';
  
  export default {
    data() {
      return {
        message: '',
        risposta: '',
        authStore: useAuthStore()
      };
    },
    methods: {
      async getReply(){
        try {
          let response = await axios.post('/api/v1/chat', {message: this.message})
          this.risposta = response.data.result
        
        } catch (error) {
          console.log(error);
        }
      }


    }
}
  </script>
  
  <style lang="scss" scoped>
  .box {
    background-color: beige;
    min-height: 400px;
    border: 1px solid black;
  }
  </style>
  