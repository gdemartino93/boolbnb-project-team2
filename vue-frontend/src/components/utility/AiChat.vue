<template>
    <div class="col-4">
      <span>{{ risposta }}</span>
      <form action="" method="post" @submit.prevent="getReply">
        <input class="form-control" type="text" placeholder="Default input" aria-label="default input example" v-model="message">
        
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
          console.log(this.risposta);
        
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
    width: 500px;
    border-radius: 10px;
  }
  </style>
  