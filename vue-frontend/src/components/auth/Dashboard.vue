<script>
import { useAuthStore } from '../../stores/auth';
import axios from 'axios';

export default {
    data() {
        return {
            authStore: useAuthStore(),
            isShow: true

        }
    },
    methods: {

        deleteApartment(apartment) {
            axios.delete('/api/v1/apartment/delete/' + apartment.id)
                .then(res => {

                    const data = res.data;
                    const success = data.success;

                    if (success) {
                        this.authStore.getUsersWithApt();
                    }
                })
                .catch(err => console.log);
        },
        async toggleVisibility(index, id) {
              try {
                await axios.get(`/api/v1/apartment/${id}/visibility`);
                this.authStore.apartments[index].isShow = !this.authStore.apartments[index].isShow;
              } catch (error) {
                console.log(error);
              }
          }
    },
    mounted() {
        this.authStore.getUsersWithApt();
    }
}
</script>

<template>
    <div class="dashboard d-flex">
      <div class="left col- col-lg-7">
        <div class="container">
          <div class="box">
            <div class="box-header text-center my-4">
              <h2>Lista Appartamenti</h2>
            </div>
            <div class="box-body">
                <RouterLink :to="{ name: 'addApt' }">
                    <a href="#" class="btn btn-primary text-uppercase rounded-pill shadow-sm d-inline-block">Aggiungi appartamento</a>
                </RouterLink>
              <ul v-if="authStore.apartments" class="apartments-list">
                <li v-for="(apartment,index) in authStore.apartments" class="apartment-item">
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="apartment-title">{{ apartment.title }}</span>
                    <div class="d-flex align-items-center">
                      <button
                        class="delete-button btn btn-primary text-uppercase rounded-pill shadow-sm p-1 mx-1"
                        @click="deleteApartment(apartment)"
                      >
                        Elimina
                      </button>
                      <router-link
                        class="edit-link"
                        :to="{ name: 'editApt', params: { id: `${apartment.id}` } }"
                      >
                        <button
                          class="edit-button btn btn-primary text-uppercase rounded-pill shadow-sm p-1 mx-1"
                        >
                          Modifica
                        </button>
                      </router-link>
                      <button
                        class="visible-button btn btn-primary text-uppercase rounded-pill shadow-sm p-1 mx-1"
                         @click="toggleVisibility(index, apartment.id)"
                      >
                      {{ apartment.isShow ? 'Nascondi' : 'Mostra' }}
                      </button>
                    </div>
                  </div>
                  <Map :address="apartment.address" />
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="right col-5 d-none d-md-block"></div>
    </div>
</template>

<style lang="scss" scoped>
.container{
    width: 90%;
}
.dashboard {
  padding-top: 9vh;
  background-color: #bbc6c7;
  height: 100vh;
}
.right {
  background-image: url('/dash-img.png');
}

.box-body {
  height: 75vh;
  overflow: auto;
  a{
    text-decoration: none;
  }
}
.apartment-item {
  border-bottom: 1px solid #faf5f5;
  margin-bottom: 15px;
  padding-bottom: 10px;
}
.delete-button,
.edit-button,
.visible-button {
  font-size: 0.8rem;
}

.btn{
    background-color: #ff3d00;
    display: flex;
    align-content: center;
    font-size: 11px;
    padding: 5px !important;
    margin-bottom: 10px;
}
ul{
  list-style: none;
}
</style>
