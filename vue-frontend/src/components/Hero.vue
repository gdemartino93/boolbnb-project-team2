<script>
export default{

}
</script>

<template>

    <div class="d-flex">

        <section id="hero">
    
        </section>
    
        <section>
    
            <router-link id="heroBtn" class="btn btn-block text-uppercase rounded-pill shadow-sm p-2 mt-5 mx-2"
            :to="{ name: 'advancedSearch' }">Vai alla ricerca</router-link>
        </section>
    </div>
</template>

<style lang="scss" scoped>

#hero {

    width: 50%;
    height: 70vh;
    background-image: url('../assets/xan-griffin-IM8AJKDavbk-unsplash.jpg');
    background-size: cover;
    background-repeat: no-repeat;

}

#heroBtn{

    border: 3px solid #FF6E31;
    color: #FF6E31;
    transition: .4s ease-in-out;

    &:hover {

        background-color: #FF6E31;
        color: #fff;
    }
}
</style>