<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Nav from './components/Nav.vue';
</script>

<template>
 
 <header>
    <Nav />
 </header>
 <main>
      <RouterView />
 </main>


</template>

<style scoped>
@use '../assets/main.css';
main{
      background-color: var(--lb-2);
}

</style>
