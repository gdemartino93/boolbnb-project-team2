<template>
    <div class="box col-4">
      <form action="" method="post" @submit.prevent="getResponse">
        <input type="text" v-model="message">
        <span>{{ risposta }}</span>
        <button class="btn btn-success">Invia</button>
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
        async getResponse() {
    //   const apiKey = process.env.OPENAI_API_KEY;
      const model = 'text-davinci-003';
      const prompt = 'Say this is a test';
      const maxTokens = 7;
      const temperature = 0;

      try {
        const response = await axios.post('https://api.openai.com/v1/completions', {
          model,
          prompt,
          max_tokens: maxTokens,
          temperature: temperature,
        }, {
          headers: {
            'Authorization': 'Bearer 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',
            'Content-Type': 'application/json',
          }
        });

        this.response = response.data.choices[0].text;
        // console.log(response.data)
      } catch (error) {
        console.error(error);
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
  