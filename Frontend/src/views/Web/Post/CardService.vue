<template>

  <div>
    <div class="container mt-2 mb-10 group_text flex items-center justify-between">
      <div>
        <h2 class=" ml-3">Popular Booking</h2>
        <p class="mb-13 ml-3">Find the Gest House that near your here</p>
      </div>

      <div class="flex items-center">
        <!-- Search Input -->
        <div
          class="max-w-md mx-auto px-4 py-3 mb-5 rounded-md border border-blue-200 flex items-center shadow-md"
          id="input"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 192.904 192.904"
            width="20px"
            class="fill-gray-600 mr-3"
            style="transform: scaleX(-1)"
          >
            <path
              d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"
            ></path>
          </svg>

          <input
            type="text"
            v-model="searchQuery"
            placeholder="Search for a house..."
            @input="searchHouses"
            @focus="showSuggestions = true"
            @blur="hideSuggestions"
            class="form-control"
          />

          <!-- Auto-complete Suggestions -->
          <ul v-if="showSuggestions && suggestions.length" class="suggestions-list">
            <li
              v-for="suggestion in suggestions"
              :key="suggestion"
              @mousedown.prevent="selectSuggestion(suggestion)"
              class="suggestion-item"
            >
              {{ suggestion }}
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="position-relative">
      <div
        id="cards-container"
        class="d-flex overflow-auto"
        style="white-space: nowrap; scroll-behavior: smooth"
      >
        <div
          v-for="house in filteredHouses"
          :key="house.id"
          class="col-md-4 mb-15 ml-3 d-inline-block"
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
                <span class="material-symbols-outlined"> home_pin </span>
                <a
                  href="#"
                  class="text-decoration-none"
                  @click.prevent="showOnMap(house)"
                  style="font-size: 13px"
                >
                  <p class="card-text mb-0 ms-2 text-truncate" :title="house.address">
                    {{ house.address }}
                  </p>
                </a>
              </div>

              <!-- Guest house description-->
              <div class="d-flex align-items-center">
                <p class="card-text mb-0 ms-2 text-truncate">
                  {{ house.description }}
                </p>
              </div>
              <!-- Icons and button -->
              <div class="d-flex align-items-center justify-content-between mt-4">
                <div class="d-flex">
                  <span class="material-symbols-outlined me-2">wifi</span>
                  <span class="material-symbols-outlined">restaurant</span>
                </div>
                <router-link
                  :to="{ name: 'show-room', params: { id: house.id } }"
                  class="btn btn-info btn-sm showroom"
                  >Explore Room</router-link
                >
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
      houses: [],
      searchQuery: '',
      showSuggestions: false,
      userLocation: null
    }
  },

  computed: {
    housesWithMapAddress() {
      return this.houses.filter((house) => house.latitude && house.longitude)
    },
    filteredHouses() {
      const filtered = this.housesWithMapAddress.filter((house) => {
        const query = this.searchQuery.toLowerCase()
        const inCurrentCity = this.userLocation ? this.isInCurrentCity(house) : true // If user location is not available, show all houses

        return (
          (house.name.toLowerCase().includes(query) ||
            house.address.toLowerCase().includes(query)) &&
          inCurrentCity
        )
      })

      if (this.userLocation) {
        filtered.forEach((house) => {
          house.distance = this.calculateDistance(
            house.latitude,
            house.longitude,
            this.userLocation.latitude,
            this.userLocation.longitude
          )
        })
        return filtered.sort((a, b) => a.distance - b.distance)
      }

      return filtered
    },
    suggestions() {
      if (!this.searchQuery) return []
      const query = this.searchQuery.toLowerCase()

      const suggestionsSet = new Set()
      this.housesWithMapAddress.forEach((house) => {
        if (house.name.toLowerCase().includes(query)) {
          suggestionsSet.add(house.name)
        }
        if (house.address.toLowerCase().includes(query)) {
          suggestionsSet.add(house.address)
        }
      })
      return Array.from(suggestionsSet).slice(0, 5)
    }
  },

  mounted() {
    this.fetchHouses()
    this.getUserLocation()
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
    },

    searchHouses() {
      this.searchQuery = this.searchQuery.trim()
      this.showSuggestions = true
    },

    onSearch(address) {
      this.$emit('searchHouseOnTheMaps', address)
    },

    getUserLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            this.userLocation = {
              latitude: position.coords.latitude,
              longitude: position.coords.longitude
            }
            console.log('User location:', this.userLocation)
          },
          (error) => {
            console.error('Error getting user location:', error)
          }
        )
      } else {
        console.log('Geolocation is not supported by this browser.')
      }
    },

    calculateDistance(lat1, lon1, lat2, lon2) {
      const R = 6371 // Radius of the Earth in kilometers
      const dLat = ((lat2 - lat1) * Math.PI) / 180
      const dLon = ((lon2 - lon1) * Math.PI) / 180
      const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos((lat1 * Math.PI) / 180) *
          Math.cos((lat2 * Math.PI) / 180) *
          Math.sin(dLon / 2) *
          Math.sin(dLon / 2)
      const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a))
      const distance = R * c // Distance in kilometers
      return distance
    },

    selectSuggestion(suggestion) {
      this.searchQuery = suggestion
      this.showSuggestions = false
      this.onSearch(suggestion)
    },

    hideSuggestions() {
      setTimeout(() => {
        this.showSuggestions = false
      }, 200) // Delay to allow click event to register
    },

    isInCurrentCity(house) {
      if (!this.userLocation) return false // If user location is not available, return false

      // Example logic: Compare user's location with house's location
      const userLat = this.userLocation.latitude
      const userLon = this.userLocation.longitude
      const houseLat = house.latitude
      const houseLon = house.longitude

      // Example: Calculate distance between user and house
      const distance = this.calculateDistance(userLat, userLon, houseLat, houseLon)

      // Example: Set a threshold for distance, e.g., 50 km
      const maxDistance = 50 // Adjust as needed

      // Example: Determine if the house is within the user's current city based on distance
      return distance <= maxDistance
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

.suggestions-list {
  list-style-type: none;
  padding: 0;
  margin: 0;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: white;
  max-height: 200px;
  overflow-y: auto;
  position: absolute;
  z-index: 10;
}

.suggestion-item {
  padding: 8px;
  cursor: pointer;
}

.suggestion-item:hover {
  background-color: #f0f0f0;
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

.showroom {
  background-color: #124400;
  color: white;
  padding: 7px;
  border-radius: 6px;
  border: none;
}

#input {
  padding: 10px;
  border: none;
  width: 450px;
}
</style>
