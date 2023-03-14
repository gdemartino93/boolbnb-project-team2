<template>
    <v-card
      class="mx-auto"
      
    >
      <v-img
        :src="apartment.img"
        height="200px"
        :alt="apartment.img"
        cover
      ></v-img>
  
      <v-card-title>
        {{ apartment.title }}
      </v-card-title>
  
      <v-card-subtitle>
       {{apartment.address}}
      </v-card-subtitle>
  
      <v-card-actions>
        <v-btn
          color="orange-lighten-2"
          variant="text"
        >
          Explore
        </v-btn>
  
        <v-spacer></v-spacer>
  
        <v-btn
          :icon="show ? 'mdi-chevron-up' : 'mdi-chevron-down'"
          @click="show = !show"
        ></v-btn>
      </v-card-actions>
  
      <v-expand-transition>
        <div v-show="show">  
          <v-card-text>
            <ul>
               <li v-for="additional_services in apartment.additional_services">
                    {{ additional_services.name }}
                </li>
            </ul>
          </v-card-text>
        </div>
      </v-expand-transition>
    </v-card>
  </template>
  <script>
  export default {
    props: ['apartment'],
    data: () => ({
      show: false,
    }),
  }
</script>
<style>
ul{
    list-style: none;
}
</style>