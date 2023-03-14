<template>
  <div class="card" style="width: 18rem;">
  <img :src="apartment.img" class="card-img-top" :alt="apartment.img">
  <div class="card-body">
    <!-- creiamo funzione per capitalizzare -->
    <span class="fw-bold">{{ (apartment.title).charAt(0).toUpperCase() + apartment.title.slice(1) }}</span>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <span @click="toggleShow">Mostra v</span>
    <ul>
      <li v-if="isShow" v-for="additional_services in apartment.additional_services">
                    {{ additional_services.name }}
      </li>
    </ul>
  </div>
</div>
</template>
  <script>
  export default {
    props: ['apartment'],
    data(){
      return{
        isShow : false,
      }
    },
    methods:{
      toggleShow(){
        this.isShow = !this.isShow
      }
    }
  }
</script>
<style>
ul{
    list-style: none;
}
</style>