<script>
export default {
  props: ['apartment'],
  data() {
    return {
      isShow: false,
      showIndex: null,
      isHovering: false
    }
  },
  methods: {
    toggleShow() {
      this.isShow = !this.isShow;
    },
    toggleIndex(index) {
      this.showIndex = this.showIndex === index ? null : index;
    },
    // activate effect after 5ms on mouseenter on card
    handleMouseEnter() {
    this.hoverTimeout = setTimeout(() => {
      this.isHovering = true
    }, 500)
  },
  handleMouseLeave() {
    clearTimeout(this.hoverTimeout)
    this.isHovering = false
  }
  }
}
</script>


<template>
  <router-link :to="{name: 'show', params:{ id: `${apartment.id}` }}" class="card-link no-underline">
    <div class="card" @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave" :class="{ 'hover-effect': isHovering }">
      <img :src="apartment.img" class="card-img" :alt="apartment.img">
        <div class="d-flex gap-1 my-1 align-items-center view">
          <font-awesome-icon icon="fa-solid fa-eye" />
          <span>
            {{ apartment.views_count }}
          </span>
        </div>
      <div class="my-card-body">
          <!-- capitalizza il titolo -->
          <h2 class="card-title fs-5">{{ (apartment.title).charAt(0).toUpperCase() + apartment.title.slice(1) }}</h2>
        
        <p class="card-text">{{ apartment.description }}</p>

      </div>
    </div>
  </router-link>
</template>

<style lang="scss" scoped>
// .card-link {
//   box-sizing: border-box;
//   display: inline-block;
//   width: 23%;
//   margin-right: 2%;
//   margin-bottom: 1rem;
//   vertical-align: top;
// }

.card-link:nth-child(4n) {
  margin-right: 0;
}

.card {
  display: flex;
  flex-direction: column;
  width: 100%;
  height: 100%;
  border: none;
  overflow: hidden;
  position: relative;
  transition: all 0.3s ease-in-out;
  background-color: var(--white);
}

.card:hover {
  transform: scale(1.05);
  z-index: 1;
}

.card-img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.my-card-body {
  display: flex;
  flex-direction: column;
}

.card-title {
  font-size: 16px;
  // margin-bottom: 10px;
  color: black;
}

.card-text {
  font-size: 12px;
  margin-bottom: 10px;
  color: black;
}

.btn-primary {
  color: var(--white);
  background-color: var(--primary);
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 0.25rem;
}

.additional-services {
  list-style: none;
  margin-top: 1
}

.no-underline {
  text-decoration-line: none;
}
.view{
  font-size: 12px;
}


</style>

