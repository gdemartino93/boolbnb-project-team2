<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Nav from './components/Nav.vue';
</script>

<template>
 
 <header>
    <Nav />
 </header>

  <RouterView />
        <!-- <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink> -->
  <!-- <RouterView /> -->
</template>

<style scoped>


</style>
