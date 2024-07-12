<template>
  <div>
    <div class="container mt-2 mb-15">
      <h2 class=" ml-3">Popular Booking</h2>
      <p class="mb-13 ml-3">Find the Gest House that near your here</p>
      <div class="position-relative">
        <div
          id="cards-container"
          class="d-flex overflow-auto"
          style="white-space: nowrap; scroll-behavior: smooth">
          <div
            v-for="house in housesWithMapAddress"
            :key="house.id"
            class="col-md-4 mb-4 d-inline-block"
            style="width: 400px"
          >
            <div class="card h-100 position-relative border-0">
              <div
                class="overflow-auto"
                :id="'scrollContainer-' + house.id"
                style="white-space: nowrap; scroll-behavior: smooth"
              >
                <!-- Display images here -->
                <div v-for="image in house.photos" :key="image.url" class="d-inline-block">
                  <img
                    :src="getImageUrl(image.url)"
                    class="card-img-top"
                    style="width: 400px; height: 200px; object-fit: cover"
                  />
                </div>
              </div>
              <!-- Buttons for scrolling images -->
              <button
                @click="scrollLeft(house.id)"
                class="position-absolute top-50 start-0 translate-middle-y btn btn-outline-dark border-0"
              >
                <span class="material-symbols-outlined">chevron_left</span>
              </button>
              <button
                @click="scrollRight(house.id)"
                class="position-absolute top-50 end-0 translate-middle-y btn btn-outline-dark border-0"
              >
                <span class="material-symbols-outlined">chevron_right</span>
              </button>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="card-title">{{ house.name }}</h6>
                  <div class="d-flex">
                    <!-- Star ratings -->
                    <span v-for="n in 5" :key="n" class="material-symbols-outlined">star</span>
                  </div>
                </div>
                <!-- Guest house address with link -->
                <div class="d-flex align-items-center">
                  <span class="material-symbols-outlined">home_pin</span>
                  <a href="#" class="text-decoration-none" @click.prevent="showOnMap(house)">
                    <p class="card-text mb-0 ms-2 text-truncate" :title="house.address">
                      {{ house.address }}
                    </p>
                  </a>
                </div>
                <!-- Icons and button -->
                <div class="d-flex align-items-center justify-content-between mt-4">
                  <div class="d-flex">
                    <span class="material-symbols-outlined me-2">wifi</span>
                    <span class="material-symbols-outlined">restaurant</span>
                  </div>
                  <router-link :to="{ name: 'show-room', params: { id: house.id } }" class="btn btn-info btn-sm showroom">Explore Room</router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axiosInstance from '@/plugins/axios'

export default {
  data() {
    return {
      houses: []
    }
  },

  computed: {
    housesWithMapAddress() {
      return this.houses.filter((house) => house.latitude && house.longitude)
    }
  },

  mounted() {
    this.fetchHouses()
  },

  methods: {
    async fetchHouses() {
      try {
        const response = await axiosInstance.get('/guest_house/list')
        this.houses = response.data.data.filter((house) => house.active !== 0)
      } catch (error) {
        console.error(error)
      }
    },

    getImageUrl(url) {
      return `http://127.0.0.1:8000${url.slice(16)}`
    },

    scrollLeft(houseId) {
      const scrollContainer = document.getElementById(`scrollContainer-${houseId}`)
      scrollContainer.scrollBy(-400, 0)
    },

    scrollRight(houseId) {
      const scrollContainer = document.getElementById(`scrollContainer-${houseId}`)
      scrollContainer.scrollBy(400, 0)
    },

    showOnMap(house) {
      this.$emit('showOnMap', house)
    }
  }
}
</script>

<style scoped>
.text-truncate {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  max-width: 200px;
}

#cards-container {
  display: none;
  transition: display 0.3s ease-in-out;
  width: 100%;
  overflow-x: auto;
  scroll-behavior: smooth;
  scrollbar-width: thin;
  scrollbar-color: transparent transparent;
}
.col-md-4 {
  display: inline-block;
}

.card {
  margin-right: 10px;
}
.showroom{
  background-color: #124400;
  color: white;
  padding: 7px;
  border-radius: 6px;
  border: none;
}
</style>
