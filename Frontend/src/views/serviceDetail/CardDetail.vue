<template>
  <div class="container">
    
    <div class="card mb-3 m-8" v-for="(listImage, index) in ListImages" :key="listImage.id" style="width: 98%">
      <div class="row p-5">
        <!-- Image Section -->
        <div class="col-md-4">
          <div class="card h-100 position-relative">
            <div class="overflow-auto" :id="'scrollContainer-' + listImage.id"
              style="white-space: nowrap; scroll-behavior: smooth">
              <div v-for="image in listImage.images" :key="image.url" class="d-inline-block"
                style="width: 430px; height: 320px; position: relative">
                <img :src="getImage(image.url)" class="card-img" alt="Room Image"
                  style="width: 100%; height: 100%; object-fit: cover" />
                <button class="position-absolute top-20 start-15 translate-middle-y heart-button" :class="{
                  'btn-outline-light': !listImage.isFavorite,
                  'btn-danger': listImage.isFavorite
                }" @click="toggleFavorite(index)"></button>
              </div>
              <button @click="scrollLeft(listImage.id)"
                class="position-absolute top-50 start-0 translate-middle-y btn btn-outline-dark border-0">
                <span class="material-symbols-outlined">chevron_left</span>
              </button>
              <button @click="scrollRight(listImage.id)"
                class="position-absolute top-50 end-0 translate-middle-y btn btn-outline-dark border-0">
                <span class="material-symbols-outlined">chevron_right</span>
              </button>
            </div>
          </div>
        </div>

        <!-- Details Section -->
        <div class="col-md-7">
          <div class="card-body">
            <h5 class="card-title">{{ listImage.name }}</h5>
           
            <div v-if="bookings.length > 0">
              <div v-if="bookings[index] !== undefined">
                <p v-if="bookings[index].number_rooms > 0" class="text-green-500">
                  {{ bookings[index].number_rooms }} available rooms.
                </p>
                <p v-if="bookings[index].number_rooms == 0" class="text-red-500">
                  This room is fully booked.
                </p>
              </div>
              <div v-else>
                <p class="text-orange-500">No bookings available.</p>
              </div>
            </div>
            <div v-if="bookings.success == false">
              <p class="text-orange-500">No bookings available.</p>
            </div>

            <p>Type room : <span style="text-decoration: underline;">{{ listImage.type_of_room.name }}</span></p>
            <h6 >{{ listImage.description }}</h6><br>

            <p class="card-text">
              <span class="locate material-symbols-outlined" style="font-size: 40px">home_pin</span>
              <small class="text-muted">5 minute walk from University in Phnom Penh</small>
            </p>
            <div class="d-flex justify-content-between align-items-center ml-1">
              <div class="flex">
                <span class="home material-symbols-outlined" style="font-size: 30px">home</span>
                <p class="card-text mt-1 ml-4">{{ listImage.bed_type.name }}</p>
              </div>
              <div class="flex">
                <span class="wifi material-symbols-outlined" style="font-size: 30px">wifi</span>
                <p class="card-text mt-1 ml-4">WiFi</p>
              </div>
              <h5 class="card-text mb-0">${{ listImage.price }} USD total</h5>
            </div>

            <div v-if="bookings.length > 0">
              <div class="d-flex justify-content-end mt-5">
                <div v-if="bookings[index] !== undefined">
                  <button v-if="bookings[index].number_rooms > 0" class="btn btn-primary"
                    @click="openBookingModal(index, listImage)">
                    Booking Rooms
                  </button>
                  <button v-else style="background-color: #bfdbfe" class="btn text-white">
                    Booking Rooms
                  </button>
                </div>
                <div v-else>
                  <button class="btn btn-primary" @click="openBookingModal(index, listImage)">
                    Booking Rooms
                  </button>
                </div>
              </div>
            </div>
            <div v-if="bookings.success == false">
              <div class="d-flex justify-content-end mt-5">
                <button class="btn btn-primary" @click="openBookingModal(index, listImage)">
                  Booking Rooms
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for booking user -->
    <div v-if="showBookingModal" class="modal" tabindex="-1" style="display: block">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Booking Room</h5>
            <button type="button" class="btn-close" @click="closeBookingModal"></button>
          </div>
          <div class="modal-body">
            <BookingUserView @close="closeBookingModal" @submit="handleFormSubmit" :selectedImage="selectedImage"
              :ListImages="ListImages" :selectedRoomId="selectedRoomId" :startDate="startDate" :endDate="endDate" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import BookingUserView from '@/views/Web/Booking/BookingUserView.vue'
import axios from 'axios'

export default {
  name: 'CardDetail',
  props: {
    ListImages: {
      type: Array,
      required: true
    },
    startDate: {
      type: String,
      default: null
    },
    endDate: {
      type: String,
      default: null
    },
    bookings: {
      type: Array,
      default: null
    }
  },
  setup(props) {
    // Check if selectedImage is defined
    if (!props.selectedImage) {
      console.error('selectedImage is not defined');
    }

    // Safely access properties of selectedImage
    const selectedImageId = props.selectedImage?.id;
    if (selectedImageId) {
      console.log('Selected Image ID:', selectedImageId);
    } else {
      console.error('Selected Image ID is not available');
    }

    return {
      // Return any reactive variables or methods here
    };
  },

  components: {
    BookingUserView
  },
  data() {
    return {
      urlImage: 'http://127.0.0.1:8000',
      showBookingModal: false,
      selectedImage: null,
      selectedRoomId: null,
      profileImageUrl: '',
      name: ''
    }
  },
  mounted() {
    this.fetchRoomDetails()
    this.getUserProfile()
  },
  methods: {
    async fetchRoomDetails() {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/guest_house/show/1`)
        if (response.data.meeesager) {
          this.ListImages = response.data.rooms
        } else {
          console.error('No rooms data found in the response')
        }
      } catch (error) {
        console.error('Error fetching room details:', error)
      }
    },
    async getUserProfile() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/user/show/1')
        this.profileImageUrl = `http://127.0.0.1:8000/storage/${response.data.user.profile}`
        this.name = response.data.user.name
      } catch (error) {
        console.error('Error fetching user data:', error)
      }
    },
    toggleFavorite(index) {
      this.ListImages[index].isFavorite = !this.ListImages[index].isFavorite
    },
    openBookingModal(index, listImage) {
      this.selectedImage = this.ListImages[index]
      this.selectedRoomId = listImage
      this.showBookingModal = true
      console.log('Opening modal for:', listImage)
    },
    closeBookingModal() {
      this.showBookingModal = false
    },
    handleFormSubmit(formData) {
      console.log('Form submitted with data:', formData)
      this.closeBookingModal()
    },
    getImage(image) {
      return this.urlImage + image.slice(16)
    },
    scrollLeft(imageId) {
      const scrollContainer = document.getElementById(`scrollContainer-${imageId}`)
      scrollContainer.scrollBy(-400, 0)
    },
    scrollRight(imageId) {
      const scrollContainer = document.getElementById(`scrollContainer-${imageId}`)
      scrollContainer.scrollBy(400, 0)
    }
  }
}
</script>

<style scoped>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1050;
}

.modal-dialog {
  max-width: 50%;
  margin: 0 auto;
}

.img-fluid {
  align-items: center;
  height: 70vh;
}

.wifi {
  color: rgb(0, 149, 166);
}

.home,
.locate {
  color: rgb(65, 0, 126);
}

.heart-button {
  position: relative;
  width: 30px;
  height: 30px;
  background: transparent;
  border: none;
  cursor: pointer;
}

.heart-button::before,
.heart-button::after {
  content: '';
  position: absolute;
  top: 0;
  left: 15px;
  width: 15px;
  height: 24px;
  border-radius: 15px 15px 0 0;
  background: #ff0000;
  transform: rotate(-45deg);
  transform-origin: 0 100%;
}

.heart-button::after {
  left: 0;
  transform: rotate(45deg);
  transform-origin: 100% 100%;
}

.btn-outline-light::before,
.btn-outline-light::after {
  background: transparent;
  border: 2px solid #ffffff;
}

.btn-danger::before,
.btn-danger::after {
  background: #ff0000;
}

.booking {
  background-color: #06166e;
}

.bookorganize {
  background-color: #97004a;
}
</style>
