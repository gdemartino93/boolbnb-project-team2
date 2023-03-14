<template>
  <router-link :to="{name: 'show', params:{
  id: `${apartment.id}`
  }}" >
    <div class="card">
      <img :src="apartment.img" class="card-img-top" :alt="apartment.img">
      <div class="card-body">
        <span class="fw-bold">{{ (apartment.title).charAt(0).toUpperCase() + apartment.title.slice(1) }}</span>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <!-- quando leggi questo commento avvisami che devo fixare una roba -->
        <button class="btn-primary btn" @click="toggleShow">{{ isShow ? 'Nascondi' : 'Mostra' }}</button>
        <ul>
          <li v-for="(additional_service, index) in apartment.additional_services" :key="index" v-if="showIndex === index || isShow">
            {{ additional_service.name }}
          </li>
        </ul>
      </div>
    </div>
  </router-link>
</template>

<script>
export default {
  props: ['apartment'],
  data() {
    return {
      isShow: false,
      showIndex: null
    }
  },
  methods: {
    toggleShow() {
      this.isShow = !this.isShow;
    },
    toggleIndex(index) {
      this.showIndex = this.showIndex === index ? null : index;
    }
  }
}
</script>

<style lang="scss" scoped>
@use '../assets/main.css';

ul {
  list-style: none;
}

a{
  text-decoration: none !important;
  color: inherit !important;
}
.card-body{
  background: var(--b-1);
}
</style>
