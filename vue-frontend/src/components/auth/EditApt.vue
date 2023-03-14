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

      this.store.getCoordinates(this.apt.address);
      this.apt.latitude = this.store.latitude;
      this.apt.longitude = this.store.longitude;

      await this.auth.getToken();

      try {

        this.apt.additional_services = [...this.adservices];
        await axios.post('/api/v1/apartment/update/' + this.apt.id, this.apt, {
          headers: {

            'Content-Type': 'multipart/form-data'
          }
        })
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

      if (!this.adservices.includes(value)) {

        this.adservices.push(value);
      } else {

        const index = this.adservices.indexOf(value);
        this.adservices.splice(index, 1);
      }
    },
    checkCheckboxes(element) {

      for (let x = 0; x < this.apt.additional_services.length; x++) {
        const apartmentAdds = this.apt.additional_services[x];
        if (apartmentAdds.id == element.id) {
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


<template class="my-template">
  <section v-if="auth.user" class="container">
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

      <label for="img">Image</label>
      <input type="file" name="img" @change="onFileChange">
      <br>

      <div class="row">
        <div v-for="service in adds.additional_service" :key="service.id" class="col-md-3">
          <div class="col">
            <input type="checkbox" :id="service.id" @change="getAdServices(service.id)"
              :checked="checkCheckboxes(service)">
            <label :for="service.name"> {{ service.name }} </label>
          </div>
        </div>
      </div>

      <br>

      <button type="button" @click="updateData(apt)">Update Apartment</button>
    </form>
  </section>
  <section class="autenticato" v-else>
    <h1 class="text-danger">Non Autenticato</h1>
    <h2>Effettua il Login</h2>
  </section>
</template>

  

<style lang="scss" scoped>
.container {
  margin-top: 150px;

  form {
    display: flex;
    flex-direction: column;
    width: 100%;
    margin: 0 auto;
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  }

  h2 {
    margin-top: 0;
  }

  label {
    display: block;
    margin-bottom: 10px;
    color: #333;
  }

  input[type="text"],
  input[type="number"],
  input[type="file"] {
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 16px;
    width: 100%;
    margin-bottom: 20px;
  }

  input[type="checkbox"] {
    margin-right: 10px;
  }

  button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
  }

  button:hover {
    background-color: #3e8e41;
  }

  .text-danger {
    color: #FF0000;
  }

  section {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f2f2f2;
    max-width: 75%;
    margin: 0 auto;
  }

  .my-template {

    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f2f2f2;
  }


  .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .col-md-3 {
    flex: 0 0 31%;
    margin-bottom: 1rem;
    padding: 1rem;
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 5px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease-in-out;
  }


  .col-md-3:hover {
    transform: translateY(-2px);
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
  }

  input[type="checkbox"] {
    margin-right: 0.5rem;
  }

  label {
    font-weight: bold;
    color: #333;
  }

  .autenticato {
    width: 50%;
    text-align: center;
    margin: 0 auto;
    position: relative;
    animation-name: animation;
    animation-duration: 0.5s;

    @keyframes animation {
      0% {
        // background-color: red;
        top: 10px;
      }

      50% {
        // background-color: red;
        top: 0px;
      }

      75% {

        top: 10px;
      }

      100% {

        top: 0px;
      }
    }
  }
}
</style>