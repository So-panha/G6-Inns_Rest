<template>
  <div class="container mt-4 mb-15">
    <h2 class="mb-4">Popular Booking</h2>
    <div class="position-relative">
      <div id="cards-container" class="d-flex overflow-auto" style="white-space: nowrap; scroll-behavior: smooth">
        <div v-for="house in houses" :key="house.id" class="col-md-4 mb-4 mr-3 d-inline-block " style="width: 400px;">
          <div class="card h-100 position-relative">
            <div class="overflow-auto" :id="'scrollContainer-' + house.id" style="white-space: nowrap; scroll-behavior: smooth">
              <div v-for="image in house.images" :key="image" class="d-inline-block">
                <img :src="image" :alt="house.name" class="card-img-top" style="width: 400px; height: 200px; object-fit: cover" />
              </div>
            </div>
            <button
              @click="scrollLeft(house.id)"
              class="position-absolute top-50 start-0 translate-middle-y btn btn-outline-dark"
            >
              <span class="material-symbols-outlined">arrow_back</span>
            </button>
            <button
              @click="scrollRight(house.id)"
              class="position-absolute top-50 end-0 translate-middle-y btn btn-outline-dark"
            >
              <span class="material-symbols-outlined">arrow_forward</span>
            </button>
            <div class="card-body">
              <div class="flex">
                <h6 class="card-title">{{ house.name }}</h6>
                <div class="flex ml-40">
                  <span class="material-symbols-outlined">star</span>
                  <span class="material-symbols-outlined">star</span>
                  <span class="material-symbols-outlined">star</span>
                  <span class="material-symbols-outlined">star</span>
                  <span class="material-symbols-outlined">star</span>
                </div>
              </div>
              <div class="location flex">
                <span class="material-symbols-outlined">home_pin</span>
                <p class="card-text">Some quick example text to build on</p>
              </div>
              <div class="mt-4 flex">
                <div class="mr-60">
                  <span class="material-symbols-outlined mr-4">wifi</span>
                  <span class="material-symbols-outlined">restaurant</span>
                </div>
                <router-link to="/service-detail">
                  <button type="button" class="btn btn-outline-success">Detail</button>
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CardService",
  props: {
    houses: {
      type: Array,
      required: true
    }
  },
  methods: {
    scrollLeft(id) {
      const container = document.getElementById(`scrollContainer-${id}`)
      if (container) {
        container.scrollBy({
          left: -400, // Adjust the value to control the scroll amount
          behavior: 'smooth'
        })
      }
    },
    scrollRight(id) {
      const container = document.getElementById(`scrollContainer-${id}`)
      if (container) {
        container.scrollBy({
          left: 400, // Adjust the value to control the scroll amount
          behavior: 'smooth'
        })
      }
    }
  }
}
</script>

<style scoped>
/* Add your styles here if necessary */
</style>
