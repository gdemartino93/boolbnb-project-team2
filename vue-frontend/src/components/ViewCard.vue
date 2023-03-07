<script>
import {useAuthStore} from '../stores/auth';
import axios from 'axios';
export default {
    data(){
        return{

            authStore: useAuthStore(),
            apt : [],
            services : []
        }
    },
    methods:{
        async getSingleAp(id){
            try {
               const response =  await axios.get('/api/v1/apartment/' + id )
               this.apt = response.data.response;
                this.services = response.data.additional_services.response;
               
                
            } catch (error) {
                console.log(error)
            }
         
        }
    },
    mounted(){
        this.getSingleAp(this.$route.params.id);
        this.authStore.getUsersWithApt();
    }
}
</script>

<template>
    <!-- <div v-for="{id,title} in apts" >
      <div>ID: {{ id }}, Nome: {{ title }}</div>
    </div> -->

    <div>
        ID: {{ apt.id }}
        name: {{ apt.title }}
    </div>
    <!-- <div>
      <ul>lista add services
        <li v-for="service in services">{{ service.name }}</li>
      </ul>
    </div> -->
  </template>
  

<style scoped></style>
