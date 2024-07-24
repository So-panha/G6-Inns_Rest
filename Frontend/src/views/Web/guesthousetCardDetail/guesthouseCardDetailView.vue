<template>
  <div>
    <!-- Navigation Bar -->
    <NavComponentViewVue />
    <!-- slide -->
    <div>
      <slideGuestHoustViewVue />
    </div>
    <div class="container mt-5 mb-5">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div>
            <h2 class="text-center mb-4">Trending Destinations</h2>
            <p class="text-center mb-5">Feel at home wherever you go</p>
          </div>

          <!-- Loop through each unique province -->
          <div v-for="(group, province) in groupedHouses" :key="province">
            <h2 class="mt-4 mb-3">{{ province }}</h2>
            <!-- Display each guest house under the same province -->
            <div v-for="guesthouse in group" :key="guesthouse.id" class="card mb-3">
              <div class="row g-0 align-items-center">
                <div class="col-md-4">
                  <!-- Carousel Container -->
                  <div class="carousel-container" :id="'carousel-' + guesthouse.id">
                    <div class="carousel-inner">
                      <div
                        v-for="(image, index) in guesthouse.photos"
                        :key="index"
                        class="carousel-item"
                        :class="{ active: index === 0 }"
                      >
                        <img
                          :src="getImageUrl(image.url)"
                          class="d-block w-100 img-fluid rounded"
                          alt="Slide"
                        />
                      </div>
                    </div>
                    <!-- Carousel Controls -->
                    <button
                      class="carousel-control-prev"
                      type="button"
                      @click="scrollLeft(guesthouse.id)"
                    >
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button
                      class="carousel-control-next"
                      type="button"
                      @click="scrollRight(guesthouse.id)"
                    >
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                </div>
                <div class="col-md-8 mt-3">
                  <!-- Guest House Details -->
                  <div class="card-body">
                    <h5 class="card-title">{{ guesthouse.name }}</h5>
                    <!-- Address and Amenities -->
                    <div class="d-flex justify-content-between align-items-center">
                      <p class="d-flex align-items-center">
                        <span class="material-symbols-outlined"> home_pin </span>
                        <a href="#" class="text-decoration-none" style="font-size: 13px">
                          <p class="card-text mb-0 ms-2 text-truncate">
                            {{ guesthouse.address }}
                          </p>
                        </a>
                      </p>
                      <div class="mt-2 mb-2 spec-1">
                        <span class="material-symbols-outlined me-2">wifi</span>
                        <span class="material-symbols-outlined">restaurant</span>
                      </div>
                    </div>
                    <div class="mt-2 mb-2 spec-1">
                      <div class="d-flex">
                        <!-- Ratings -->
                        <div class="ratings">
                          <div class="stars-container">
                            <span
                              class="material-symbols-outlined star"
                              :class="{ 'text-yellow-500': guesthouse.likesCount >= 10 }"
                            >
                              star
                            </span>
                            <span
                              class="material-symbols-outlined star"
                              :class="{ 'text-yellow-500': guesthouse.likesCount >= 20 }"
                            >
                              star
                            </span>
                            <span
                              class="material-symbols-outlined star"
                              :class="{ 'text-yellow-500': guesthouse.likesCount >= 30 }"
                            >
                              star
                            </span>
                            <span
                              class="material-symbols-outlined star"
                              :class="{ 'text-yellow-500': guesthouse.likesCount >= 40 }"
                            >
                              star
                            </span>
                            <span
                              class="material-symbols-outlined star"
                              :class="{ 'text-yellow-500': guesthouse.likesCount >= 50 }"
                            >
                              star
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Action Buttons -->
                    <div class="d-flex align-items-center justify-content-end">
                      <router-link
                        :to="{ name: 'show-room', params: { id: guesthouse.id } }"
                        class="btn btn-info btn-sm showroom"
                        >Explore Room</router-link
                      >
                      <button class="btn btn-outline-primary btn-sm ms-2" type="button">
                        Add to wishlist
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Scroll to Top Button -->
    <button class="scroll-to-top-btn" @click="scrollToTop" v-show="showScrollButton">
      <span class="material-symbols-outlined"> arrow_upward </span>
    </button>
  </div>

  <div>
    <FooterViewVue />
  </div>
</template>

<script>
import slideGuestHoustViewVue from './slideGuestHoustView.vue'
import FooterViewVue from '../Post/FooterView.vue'
// import NavComponentViewVue
import axiosInstance from '@/plugins/axios'
import NavComponentViewVue from '../Post/NavComponentView.vue'

export default {
  components: {
    slideGuestHoustViewVue,
    FooterViewVue,
    NavComponentViewVue
  },

  data() {
    return {
      houses: [],
      groupedHouses: {}, // To store grouped houses by province
      showScrollButton: false, // Flag to show/hide scroll-to-top button
      likeRoom: {},
      idGuesthouse: null
    }
  },

  mounted() {
    this.fetchHouses()
    window.addEventListener('scroll', this.handleScroll)
  },

  destroyed() {
    window.removeEventListener('scroll', this.handleScroll)
  },

  methods: {
    async fetchLikeRoom(guesthouseId) {
      try {
        const response = await axiosInstance.get(`/like/${guesthouseId}`)
        const countLikes = response.data.count_likes
        const houseToUpdate = this.houses.find((house) => house.id === guesthouseId)
        if (houseToUpdate) {
          houseToUpdate.likesCount = countLikes
        }
      } catch (error) {
        console.error('Error fetching likes:', error)
      }
    },

    async fetchHouses() {
      try {
        const response = await axiosInstance.get('/guest_house/list')
        this.houses = response.data.data.filter((house) => house.active !== 0)
        this.groupedHouses = this.groupHousesByProvince(this.houses)
        this.houses.forEach((house) => {
          this.fetchLikeRoom(house.id)
        })
      } catch (error) {
        console.error(error)
      }
    },

    // Method to group houses by province using address
    groupHousesByProvince(houses) {
      const grouped = {}
      houses.forEach((guesthouse) => {
        // Extract province from the address
        const province = this.extractProvinceName(guesthouse.address)

        // Initialize array for the province if not exists
        if (!grouped[province]) {
          grouped[province] = []
        }

        // Push guesthouse to the corresponding province array
        grouped[province].push(guesthouse)
      })
      return grouped
    },

    // Method to extract province name from the address
    extractProvinceName(address) {
      // List of provinces to check against
      const provinces = [
        'Phnom Penh',
        'Siem Reap',
        'Battambang',
        'Kampong Cham',
        'Kampong Chhnang',
        'Kampong Speu',
        'Kampong Thom',
        'Kampot',
        'Kandal',
        'Koh Kong',
        'Kratié',
        'Mondulkiri',
        'Oddar Meanchey',
        'Pailin',
        'Pursat',
        'Preah Sihanouk',
        'Preah Vihear',
        'Prey Veng',
        'Ratanakiri',
        'Stung Treng',
        'Svay Rieng',
        'Takéo',
        'Tboung Khmum'
      ]

      // Convert address to lowercase for case-insensitive comparison
      const lowerCaseAddress = address.toLowerCase()

      // Find the first matching province in the address
      const foundProvince = provinces.find((province) =>
        lowerCaseAddress.includes(province.toLowerCase())
      )

      // Return the province name if found, otherwise return a fallback
      if (foundProvince) {
        return foundProvince
      } else {
        // Fallback: Split address by comma and return the first part as province
        const parts = address.split(',')
        if (parts.length > 1) {
          // Trim to remove any leading or trailing spaces
          return parts[0].trim()
        } else {
          // Return full address if splitting by comma doesn't work
          return address
        }
      }
    },

    // Method to get image URL
    getImageUrl(url) {
      // Adjust URL slicing as per your image path
      return `http://127.0.0.1:8000${url.slice(16)}`
    },

    // Method to scroll carousel left
    scrollLeft(guesthouseId) {
      const carousel = new bootstrap.Carousel(document.getElementById(`carousel-${guesthouseId}`))
      carousel.prev()
    },

    // Method to scroll carousel right
    scrollRight(guesthouseId) {
      const carousel = new bootstrap.Carousel(document.getElementById(`carousel-${guesthouseId}`))
      carousel.next()
    },

    // Method to handle scroll event and show/hide scroll-to-top button
    handleScroll() {
      const scrollTop = window.scrollY
      this.showScrollButton = scrollTop > 300 // Adjust scroll position as needed
    },

    // Method to scroll to top
    scrollToTop() {
      window.scrollTo({ top: 0, behavior: 'smooth' })
    }
  }
}
</script>

<style>
/* Custom styles */
.carousel-container {
  position: relative;
  width: 100%;
  overflow: hidden;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.carousel-item {
  transition: opacity 0.5s ease-in-out;
  border-radius: 8px;
}

.carousel-item.active {
  opacity: 1;
}

.carousel-control-prev,
.carousel-control-next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 10;
}

.card {
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card-body {
  padding: 1.25rem; /* Adjust padding as needed */
}

.card-title {
  font-size: 1.25rem;
}

.spec-1 {
  font-size: 14px;
}

.img-fluid {
  padding: 10px;
  border-radius: 8px;
}

.scroll-to-top-btn {
  position: fixed;
  bottom: 20px;
  right: 20px;
  display: none;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  font-size: 20px;
  cursor: pointer;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.scroll-to-top-btn:hover {
  background-color: #0056b3;
}
</style>
