<template>
  <div>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-white">
      <div class="flex mt-2 mb-2 ml-2">
        <router-link to="/home">
          <span class="material-symbols-outlined" style="font-size: 30px">arrow_back</span>
        </router-link>
        <h4 class="pt-2 pl-1"></h4>
      </div>
    </nav>

    <!-- Carousel Header -->
    <div id="carouselExampleIndicators" class="carousel slide mr-2 ml-2" data-ride="carousel">
      <ol class="carousel-indicators">
        <li v-for="(image, index) in images" :key="index" :data-target="'#carouselExampleIndicators'" :data-slide-to="index" :class="{ active: index === currentIndex }"></li>
      </ol>
      <div class="carousel-inner">
        <div v-for="(image, index) in images" :key="index" :class="['carousel-item', { active: index === currentIndex }]">
          <img :src="image" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <div class="overlay-form d-flex">
              <div class="w-auto">
                <div class="px-2 formDate ml-5.2 mr-2">
                  <label class="text-lg font-semibold" style="color: black">Select Date Range</label>
                  <br />
                  <div class="flex items-center space-x-6">
                    <flat-pickr
                      v-model="startDate"
                      :config="startConfig"
                      class="border-2 border-gray-300 rounded px-3 py-2 w-56 date text-black"
                      placeholder="Start Date"
                    ></flat-pickr>

                    <flat-pickr
                      v-model="endDate"
                      :config="endConfig"
                      class="border-2 border-gray-300 rounded px-3 py-2 w-56 date text-black"
                      placeholder="End Date"
                    ></flat-pickr>
                    <button
                      class="btn btn-primary"
                      :disabled="!isValidDateRange(startDate, endDate)"
                      @click="submitForm"
                    >
                      Check
                    </button>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Container -->
    <div class="container">
      <div class="text-center mt-15 mb-15">
        <h1>Inns Rest Environment</h1>
        <h6>
          It is a long established fact that a reader will be distracted by the readable content of
          a page when
        </h6>
        <h6>looking at its layout.</h6>
      </div>
      <!-- Card Detail Component -->
      <ListRoom :startDate="startDate" :endDate="endDate" :bookings="bookings" :daysBetween="daysBetween" />
      <UserComment />
    </div>
    <!-- Footer Layout -->
    <FooterView />
  </div>
</template>

<script>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import axios from 'axios';
import { differenceInDays, parseISO } from 'date-fns';
import FooterView from '../Web/Post/FooterView.vue';
import ListRoom from './ListRoom.vue';
import UserComment from './UserComment.vue';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

import image1 from '@/assets/image1.jpg';
import image2 from '@/assets/image2.jpg';
import image3 from '@/assets/image3.jpg';
import image4 from '@/assets/image4.jpg';
import image5 from '@/assets/image5.jpg';

export default {
  name: 'ServiceDetail',
  components: {
    ListRoom,
    UserComment,
    FooterView,
    flatPickr,
  },
  setup() {
    const images = [image1, image2, image3, image4, image5];
    const currentIndex = ref(0);
    const currentImage = ref(images[currentIndex.value]);
    const bookings = ref([]);

    // Set default start and end dates
    const today = new Date();
    const tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);

    const startDate = ref(today.toISOString().split('T')[0]); // Default to today
    const endDate = ref(tomorrow.toISOString().split('T')[0]); // Default to tomorrow

    let intervalId;

    const startImageCarousel = () => {
      intervalId = setInterval(() => {
        currentIndex.value = (currentIndex.value + 1) % images.length;
        currentImage.value = images[currentIndex.value];
      }, 3000); // Change image every 3 seconds
    };

    const startConfig = {
      dateFormat: 'Y-m-d',
      defaultDate: startDate.value, // Ensure this is set
    };

    const endConfig = {
      dateFormat: 'Y-m-d',
      defaultDate: endDate.value, // Ensure this is set
    };

    const isValidDate = (date) => {
      return date instanceof Date && !isNaN(date);
    };

    const isValidDateRange = (startDate, endDate) => {
      return startDate && endDate && new Date(startDate) <= new Date(endDate);
    };

    const validateDates = () => {
      // Trigger validation logic if needed
    };

    const submitForm = async () => {
      if (isValidDateRange(startDate.value, endDate.value)) {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/booking_user_rooms/search', {
            departure_date: startDate.value,
            arrival_date: endDate.value,
          });

          if (response.status === 200) {
            bookings.value = response.data;
            console.log(bookings.value);
          } else {
            console.error('Unexpected response status:', response.status);
          }
        } catch (error) {
          if (error.response) {
            console.error('Error response data:', error.response.data);
            console.error('Error response status:', error.response.status);
            console.error('Error response headers:', error.response.headers);
          } else if (error.request) {
            console.error('Error request data:', error.request);
          } else {
            console.error('Error message:', error.message);
          }
          console.error('Error config:', error.config);
        }
      } else {
        console.error('Invalid date range');
      }
    };

    const daysBetween = computed(() => {
      if (startDate.value && endDate.value) {
        return differenceInDays(parseISO(endDate.value), parseISO(startDate.value));
      }
      return null;
    });

    onMounted(() => {
      startImageCarousel();
    });

    onUnmounted(() => {
      clearInterval(intervalId);
    });

    return {
      images,
      currentIndex,
      currentImage,
      startDate,
      endDate,
      bookings,
      startConfig,
      endConfig,
      isValidDate,
      isValidDateRange,
      validateDates,
      submitForm,
      daysBetween,
    };
  },
};
</script>


<style scoped>
.carousel-item {
  height: 500px;
  background-size: cover;
  background-position: center;
  transition: transform 1s ease-in-out;
}

.carousel-item img {
  height: 100%;
  width: 100%;
  object-fit: cover;
  filter: brightness(0.7); /* Darken the images slightly for better text contrast */
}

.carousel-caption {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 10;
  text-align: center;
  color: #fff;
}

.overlay-form {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 10;
}

.formDate {
  background: rgba(255, 255, 255, 0.8);
  padding: 20px;
  border-radius: 8px;
}

.date {
  border: 2px solid #d1d5db;
  border-radius: 0.375rem;
  padding: 10px;
}

.btn-primary {
  padding: 10px 20px;
  font-size: 16px;
}

.btn-primary:hover {
  background-color: #0056b3;
  border-color: #0056b3;
}

.flatpickr {
  border: 2px solid #d1d5db;
  border-radius: 0.375rem;
  padding: 10px;
  width: 200px;
}

.date input {
  border: none;
  outline: none;
}

.label {
  font-size: 1.125rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.flex {
  display: flex;
}

.space-x-4 {
  margin-right: 1rem;
}
</style>
