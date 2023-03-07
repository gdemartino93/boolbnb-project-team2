<script>
import {useAuthStore} from '../stores/auth';
import axios from 'axios';
export default {
    data(){
        return{

            authStore: useAuthStore(),
            apts : [],
            services : []
        }
    },
    methods:{
        async getSingleAp(id){
            try {
               const response =  await axios.get('/api/v1/apartment/' + id )
               this.apts = response.data.response;
                this.services = response.data.response.additional_services;
               
                
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
    <div  v-for="apt in apts ">
       <div>{{ apt }}</div>
    </div>
    <div>
        <ul>lista add services
            <li v-for="service in services">
            {{ service.name }}
            </li>
        </ul>
    </div>
</template>

<style scoped></style>
