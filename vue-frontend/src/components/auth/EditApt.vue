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
  <section v-if="auth.user" class="my-container">
    <form method="POST" class="my-form d-flex flex-wrap justify-content-around bg-white rounded-2 p-5">
      <div class="col-sm-11 col-md-5 col-lg-5">
        <label for="title">Nome</label>
        <input type="text" name="title" v-model="apt.title">
      </div>

      <div class="col-sm-11 col-md-5 col-lg-5">
        <label for="description">Descrizione</label>
        <input type="text" name="description" v-model="apt.description">
      </div>

      <div class="col-sm-11 col-md-5 col-lg-5">
        <label for="room_number">Numero di stanze</label>
        <input type="number" name="room_number" v-model="apt.room_number">
      </div>

      <div class="col-sm-11 col-md-5 col-lg-5">
        <label for="bed_number">Numero di letti</label>
        <input type="number" name="bed_number" v-model="apt.bed_number">
      </div>

      <div class="col-sm-11 col-md-5 col-lg-5">
        <label for="bath_number">Numero di bagni</label>
        <input type="number" name="bath_number" v-model="apt.bath_number">
      </div>


      <div class="col-sm-11 col-md-5 col-lg-5">
        <label for="square_meters">m<sup>2</sup></label>
        <input type="number" name="square_meters" v-model="apt.square_meters">
      </div>


      <div class="col-sm-11 col-md-5 col-lg-5">
        <label for="address">Indirizzo</label>
        <input type="text" name="address" v-model="apt.address">
      </div>


      <div class="col-sm-11 col-md-5 col-lg-5">
        <label for="img">Foto</label>
        <input type="file" name="img" @change="onFileChange">
      </div>


      <div class="d-flex flex-wrap ms-services">
        <div v-for="service in adds.additional_service" :key="service.id" class="ms-col col-sm-12 col-md-3 col-lg-3 p-3">
          <div>
            <input type="checkbox" :id="service.id" @change="getAdServices(service.id)"
              :checked="checkCheckboxes(service)">
            <label :for="service.name"> {{ service.name }} </label>
          </div>
        </div>
      </div>

      <button type="button" class="button btn btn-primary btn-block text-uppercase rounded-pill shadow-sm p-2 mt-3"
        @click="updateData(apt)">AGGIORNA APPARTAMENTO</button>
    </form>
  </section>
  <section class="autenticato" v-else>
    <h1 class="text-danger">Non Autenticato</h1>
    <h2>Effettua il Login</h2>
  </section>
</template>

  

<style lang="scss" scoped>
.my-container {
  padding-top: 15vh;

  .my-form {
    width: 80%;
    margin: 0 auto;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
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

  .button {
    cursor: pointer;
    font-size: 16px;
    margin: 0 auto;
    width: 30%;
    color: #fff;
    background-image: linear-gradient(to right, #ff3d00, #FF5F00);
    transition: .4s ease-in-out;

      &:hover {

        transform: scale(1.2);
      }
  }

  section {
    background-color: #f2f2f2;
  }

  .my-template {
    background-color: #f2f2f2;
  }

  .ms-col {
    border: 1px solid #e9ecef;
    border-radius: 5px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease-in-out;

    &:hover {
      transform: translateY(-2px);
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }
  }

  label {
    font-weight: bold;
    color: #333;
  }
}

.autenticato {
  width: 50%;
  text-align: center;
  margin: 100px auto 0 auto;
  position: relative;
  animation-name: animation;
  animation-duration: 0.5s;

  @keyframes animation {
    0% {
      top: 10px;
    }

    50% {
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
</style>