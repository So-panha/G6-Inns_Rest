<template>
  <div class="container">
    <div
      class="card mb-3 m-8"
      v-for="(listImage, index) in ListImages"
      :key="listImage.id"
      style="width: 98%"
    >
      <div class="row p-5">
        <div class="col-md-4">
          <div class="card h-100 position-relative">
            <div
              class="overflow-auto"
              :id="'scrollContainer-' + listImage.id"
              style="white-space: nowrap; scroll-behavior: smooth"
            >
              <div
                v-for="image in listImage.images"
                :key="image.url"
                class="d-inline-block"
                style="width: 430px; height: 320px; object-fit: cover; position: relative"
              >
                <img
                  :src="getImage(image.url)"
                  class="card-img"
                  alt="Room Image"
                  style="width: 100%; height: 100%; object-fit: cover"
                />
                <button
                  class="position-absolute top-20 start-15 translate-middle-y heart-button"
                  :class="{
                    'btn-outline-light': !listImage.isFavorite,
                    'btn-danger': listImage.isFavorite
                  }"
                  @click="toggleFavorite(index)"
                ></button>
              </div>
              <button
                @click="scrollLeft(listImage.id)"
                class="position-absolute top-50 start-0 translate-middle-y btn btn-outline-dark border-0"
              >
                <span class="material-symbols-outlined">chevron_left</span>
              </button>
              <button
                @click="scrollRight(listImage.id)"
                class="position-absolute top-50 end-0 translate-middle-y btn btn-outline-dark border-0"
              >
                <span class="material-symbols-outlined">chevron_right</span>
              </button>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="card-body">
            <h5 class="card-title">{{ listImage.name }}</h5>
            <p class="card-text">Type Room :</p>
            <p class="card-text">
              <span class="locate material-symbols-outlined" style="font-size: 40px">home_pin</span>
              <small class="text-muted">5 minute walk from University in Phnom Penh</small>
            </p>
            <div class="d-flex justify-content-between align-items-center ml-1">
              <div class="flex">
                <span class="home material-symbols-outlined" style="font-size: 30px">home</span>
                <p class="card-text mt-1 ml-4"></p>
              </div>
              <div class="flex">
                <span class="wifi material-symbols-outlined" style="font-size: 30px">wifi</span>
                <p class="card-text mt-1 ml-4">WiFi</p>
              </div>
              <h5 class="card-text mb-0">${{ listImage.price }} USD total</h5>
            </div>
            <div class="d-flex justify-content-end mt-5">
              <button class="btn btn-danger mr-2 bookorganize">Booked</button>
              <button class="btn btn-primary" @click="openBookingModal(index,listImage.id)">Booking</button>
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
            <BookingUserView
              @close="closeBookingModal"
              @submit="handleFormSubmit"
              :selectedImage="selectedImage"
              :ListImages="ListImages"
              :roomId="selectedRoomId"

            />
          </div>
        </div>
      </div>
    </div>

    {{ selectedRoomId }}
  </div>
</template>

<script>
import BookingUserView from '@/views/Web/Booking/BookingUserView.vue'

export default {
  name: 'CardDetail',
  props: {
    ListImages: {
      type: Array,
      required: true
    }
  },
  components: {
    BookingUserView
  },
  data() {
    return {
      urlImage: 'http://127.0.0.1:8000',
      showBookingModal: false,
      selectedImage: null,
      selectedRoomId:null
    }
  },
  methods: {
    toggleFavorite(index) {
      this.ListImages[index].isFavorite = !this.ListImages[index].isFavorite
    },
    openBookingModal(index,roomId) {
      this.selectedImage = this.ListImages[index]
      this.selectedRoomId = roomId
      this.showBookingModal = true
      console.log(this.selectedRoomId)
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
