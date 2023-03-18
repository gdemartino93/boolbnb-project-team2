<script>
import Nav from './Nav.vue';
export default{
    components: {Nav}
}
</script>

<template>

   <Nav /> 

    <section id="hero">
    
        <router-link id="heroBtn" class="btn btn-block text-uppercase rounded-pill shadow-sm p-3 mt-5 mx-2 fs-6"
            :to="{ name: 'advancedSearch' }">Vai alla ricerca 
            <font-awesome-icon icon="fa-solid fa-arrow-right" />
        </router-link>
    </section>
</template>

<style lang="scss" scoped>

#hero {

    width: 100%;
    height: 100vh;
    background-image: url('../assets/dream\ big..png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: 50%;
    position: relative;
    top: 0;
    left: 0;


    #heroBtn{
        
        position: absolute;
        top: 70%;
        right: 10%;
        border: 3px solid #ff3d00;
        color: #ff3d00;
        transition: .4s ease-in-out;
    
        &:hover {
    
            background-color: #ff3d00;
            color: #fff;
        }
    }
}


    


</style>