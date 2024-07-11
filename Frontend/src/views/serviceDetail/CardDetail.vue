<template>
  <div>
    <div class="card mb-3 m-8" v-for="(listImage, index) in ListImages" :key="listImage.id">
      <div class="row p-5">
        <div class="col-md-4">
          <img
            :src="listImage.images[0]"
            class="card-img"
            alt="Room Image"
            id="roomImage"
            @click="showImage(index)"
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

        <div class="col-md-7">
          <div class="card-body">
            <h5 class="card-title">Inns Rest Environment</h5>
            <p class="card-text">Quality bad, Comfortable room and bathroom</p>
            <p class="card-text">
              <span class="locate material-symbols-outlined" style="font-size: 40px">
                home_pin
              </span>
              <small class="text-muted">5 minute walk from University in Phnom Penh</small>
            </p>
            <div class="d-flex justify-content-between align-items-center ml-1">
              <div class="flex">
                <span class="home material-symbols-outlined" style="font-size: 30px"> home </span>
                <p class="card-text mt-1 ml-4">1 bed</p>
              </div>
              <div class="flex">
                <span class="wifi material-symbols-outlined" style="font-size: 30px"> wifi </span>
                <p class="card-text mt-1 ml-4">WiFi</p>
              </div>
              <h5 class="card-text mb-0">$25 USD total</h5>
            </div>
            <div class="d-flex justify-content-end mt-5">
              <button class="btn btn-danger mr-2">Booked</button>
              <!-- pop up user booking -->
              
              <button class="btn btn-primary">Booking</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row p-5 additional-details" style="display: none">
        <div class="col-md-12">
          <div class="card-body">
            <h5 class="card-title">Additional Details</h5>
            <p class="card-text">
              This is where you can display the additional details like the image you provided.
            </p>
            <!-- Add more content here -->
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for displaying image slideshow -->
    <div v-if="selectedIndex !== null" class="modal" tabindex="-1" style="display: block">
      <div class="modal-dialog">
        <div class="modal-content modal-xl mt-10">
          <div class="modal-header">
            <h5 class="modal-title">Bedroom</h5>
            <button type="button" class="btn-close" @click="closeModal"></button>
          </div>
          <div class="modal-body">
            <img :src="currentImage" class="img-fluid" alt="Selected Room Image" />
            <div class="text-center mt-3">
              <button
                class="position-absolute top-50 start-0 translate-middle-y btn btn-outline-dark"
                @click="previousImage"
              >
                <span class="material-symbols-outlined">arrow_back</span>
              </button>
              <button
                class="position-absolute top-50 end-0 translate-middle-y btn btn-outline-dark"
                @click="nextImage"
              >
                <span class="material-symbols-outlined">arrow_forward</span>
              </button>
            </div>
            <p class="text-center mt-2 mb-0">
              {{ currentImageIndex + 1 }} / {{ ListImages[selectedIndex].images.length }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CardDetail',
  props: {
    ListImages: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      selectedIndex: null, // Index of the selected image set
      currentImageIndex: 0 // Index of the current image in the selected set
    }
  },
  computed: {
    currentImage() {
      if (this.selectedIndex !== null) {
        return this.ListImages[this.selectedIndex].images[this.currentImageIndex]
      }
      return null
    }
  },
  methods: {
    showImage(index) {
      this.selectedIndex = index
      this.currentImageIndex = 0
    },
    closeModal() {
      this.selectedIndex = null
    },
    nextImage() {
      if (this.selectedIndex !== null) {
        const images = this.ListImages[this.selectedIndex].images
        this.currentImageIndex = (this.currentImageIndex + 1) % images.length
      }
    },
    previousImage() {
      if (this.selectedIndex !== null) {
        const images = this.ListImages[this.selectedIndex].images
        this.currentImageIndex = (this.currentImageIndex - 1 + images.length) % images.length
      }
    },
    toggleFavorite(index) {
      this.ListImages[index].isFavorite = !this.ListImages[index].isFavorite
    }
  }
}
</script>

<style>
/* Add necessary styles for modal */
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
  width: 30px; /* Adjust size as needed */
  height: 30px; /* Adjust size as needed */
  background: transparent;
  border: none;
  cursor: pointer;
}

.heart-button::before,
.heart-button::after {
  content: "";
  position: absolute;
  top: 0;
  left: 15px;
  width: 15px; /* Adjust size as needed */
  height: 24px; /* Adjust size as needed */
  border-radius: 15px 15px 0 0;
  background: #ff0000; /* Default color for heart */
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
</style>
