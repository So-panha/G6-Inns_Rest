<template>
  <div>
    <div class="container mt-4 mb-15">
      <h2 class="mb-4">Popular Booking</h2>
      <div class="position-relative">
        <div
          id="cards-container"
          class="d-flex overflow-auto"
          style="white-space: nowrap; scroll-behavior: smooth"
        >
          <div
            v-for="house in houses"
            :key="house.id"
            class="col-md-4 mb-4 mr-3 d-inline-block"
            id="scroll"
            style="width: 400px"
          >
            <div class="card h-100 position-relative">
              <div
                class="overflow-auto"
                :id="'scrollContainer-' + house.id"
                style="white-space: nowrap; scroll-behavior: smooth"
              >
                <div v-for="image in house.photos" :key="image.url" class="d-inline-block">
                  <img
                    :src="getImageUrl(image.url)"
                    class="card-img-top"
                    style="width: 400px; height: 200px; object-fit: cover"
                  />
                </div>
              </div>
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
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <span class="material-symbols-outlined">home_pin</span>
                  <a
                    :href="house.address"
                    target="_blank"
                    class="text-decoration-none"
                    @click.prevent="emitMarkerData(house)"
                  >
                    <p class="card-text mb-0 ms-2 text-truncate" :title="house.address">
                      {{ house.address }}
                    </p>
                  </a>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4">
                  <div class="d-flex">
                    <span class="material-symbols-outlined me-2">wifi</span>
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

  mounted() {
    this.fetchHouses()
  },
  methods: {
    async fetchHouses() {
      try {
        const response = await axiosInstance.get('/Guest_House')
        this.houses = response.data.data
        for (let i = 0; i < response.data.data.length; i++) {
          if (response.data.data[i].active === 0) {
            this.houses.splice(i, 1)
            i--
          }
        }
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
    emitMarkerData(house) {
      this.$emit('markerData', house)
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
  overflow-y: hidden;
  scroll-behavior: smooth;
  scrollbar-width: none;
}
#cards-container {
  display: none;
  -ms-overflow-style: none;
  scrollbar-width: none;
  scrollbar-color: transparent transparent;
}
</style>
