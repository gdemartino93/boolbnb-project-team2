<script>
import { ref } from 'vue';
import { store } from '../../stores/store';
import { useAuthStore } from '../../stores/auth';
import axios from 'axios';

export default {
  data() {
    return {
      auth: useAuthStore(),
      store,
      apt: {},
      adservices: [],
      services: [],
      adds: [],
    }
  },
  methods: {
    async updateData() {

      this.store.getCohordinates(this.apt.address);
      this.apt.latitude = this.store.latitude;
      this.apt.longitude = this.store.longitude;
      
      await this.auth.getToken();
      try {
        // await axios.post('/api/v1/apartment/update/' + this.apt.id, this.apt);
        const formData = new FormData();
        formData.append('title', this.apt.title);
        formData.append('description', this.apt.description);
        formData.append('room_number', this.apt.room_number);
        formData.append('bed_number', this.apt.bed_number);
        formData.append('bath_number', this.apt.bath_number);
        formData.append('square_meters', this.apt.square_meters);
        formData.append('address', this.apt.address);
        formData.append('latitude', this.apt.latitude);
        formData.append('longitude', this.apt.longitude);
        formData.append('img', this.apt.img);
        formData.append('additional_services', this.adservices);

        await axios.post('/api/v1/apartment/update/' + this.apt.id, formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          },
        });

      } catch (error) {
        console.log(error);
      }

      this.$router.push('/');
    },
    onFileChange(e) {
      const file = e.target.files[0];
      this.apt.img = file;
    },
    async getServices() {
      try {
        const response = await axios.get('api/v1/services/all');
        this.adds = response.data.response;
      } catch (error) {
        console.log(error);
      }
    },
    async getSingleAp(id) {
      try {
        const response = await axios.get('/api/v1/apartment/' + id);
        this.apt = response.data.response;
      } catch (error) {
        console.log(error);
      }
    },
    getAdServices(value) {
      this.adservices.push(value);
    },
    checkCheckboxes(apartment, addService) {
      for (let x = 0; x < apartment.additional_services.length; x++) {
        const apartmentAdds = apartment.additional_services[x];
        if (apartmentAdds.id == addService.id) {
          this.adservices.push(apartmentAdds.id);
          return true;
        }
      }
      return false;
    }
  },
  mounted() {
    this.getSingleAp(this.$route.params.id);
    this.getServices();
  }
}
</script>


<template>
  <section v-if="auth.user">
    <h2>Form</h2>
    <form action="" method="POST">
      <label for="title">Title</label>
      <input type="text" name="title" v-model="apt.title">
      <br>

      <label for="description">Description</label>
      <input type="text" name="description" v-model="apt.description">
      <br>

      <label for="room_number">Room Number</label>
      <input type="number" name="room_number" v-model="apt.room_number">
      <br>

      <label for="bed_number">Bed Number</label>
      <input type="number" name="bed_number" v-model="apt.bed_number">
      <br>

      <label for="bath_number">Bath Number</label>
      <input type="number" name="bath_number" v-model="apt.bath_number">
      <br>

      <label for="square_meters">Square Meters</label>
      <input type="number" name="square_meters" v-model="apt.square_meters">
      <br>

      <label for="address">Address</label>
      <input type="text" name="address" v-model="apt.address">
      <br>

      <label for="latitude">Latitude</label>
      <input type="number" name="latitude" v-model="apt.latitude">
      <br>

      <label for="longitude">Longitude</label>
      <input type="number" name="longitude" v-model="apt.longitude">
      <br>

      <label for="img">Image</label>
      <input type="file" name="img" @change="onFileChange">
      <br>

      <div v-for="service in adds.additional_service" :key="service.id">
        <input type="checkbox" :id="service.id" @change="getAdServices(service.id)"
          :checked="checkCheckboxes(apt, service)">
        <label :for="service.name"> {{ service.name }} </label>
      </div>

      <br>

      <button type="button" @click="updateData(apt)">Update Apartment</button>
    </form>
  </section>
  <section v-else>
    <h1 class="text-danger">NON AUTENTICATO</h1>
  </section>
</template>
  

<style scoped></style>