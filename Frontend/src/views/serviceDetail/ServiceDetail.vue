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

    <!-- Header -->
    <header class="bg-image mr-2 ml-2" :style="{ backgroundImage: `url(${currentImage})` }">
      
      <h1 class="text-white pt-120 pl-5">Paradise Cozy Guesthouse Sihanoukville</h1>
      <div class="overlay-form d-flex">
        <input type="text" class="Frontend form-control-name" placeholder="  House name ..." />
        <input type="date" class="form-control" ref="checkInInput" />
        <input type="date" class="form-control" placeholder="Check Out" />

        <button class="btn btn-primary button-control" id="search" style="padding: 14px;">
          Search
        </button>
      </div>
    </header>

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
      <ListRoom />
      <UserComment />
    </div>

    <!-- Footer Layout -->
    <FooterView />
  </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue'
import FooterView from '../Web/Post/FooterView.vue'
import ListRoom from './ListRoom.vue'
import UserComment from './UserComment.vue'
import image1 from '@/assets/image1.jpg'
import image2 from '@/assets/image2.jpg'
import image3 from '@/assets/image3.jpg'
import image4 from '@/assets/image4.jpg'
import image5 from '@/assets/image5.jpg'


export default {
  name: 'ServiceDetail',
  components: {
    ListRoom,
    UserComment,
    FooterView
  },
  setup() {
    const images = [image1, image2, image3, image4, image5]
    const currentIndex = ref(0)
    const currentImage = ref(images[currentIndex.value])

    let intervalId

    const startImageCarousel = () => {
      intervalId = setInterval(() => {
        currentIndex.value = (currentIndex.value + 1) % images.length
        currentImage.value = images[currentIndex.value]
      }, 3000) // Change image every 3 seconds
    }

    onMounted(() => {
      startImageCarousel()
    })

    onUnmounted(() => {
      clearInterval(intervalId)
    })

    return {
      currentImage
    }
  }
}

</script>


<style scoped>
.bg-image {
  position: relative;
  height: 500px; /* Adjust height as needed */
  background-size: cover;
  background-position: center;
  margin: 0 10px; /* Adjust as needed */
  border-radius: 10px; /* Optional for rounded corners */
  overflow: hidden; /* Ensures child elements are contained */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
}

.text-white {
  position: relative;
  z-index: 2;
  padding-top: 120px;
  padding-left: 20px;
  text-align: center;
  color: #fff;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.form-outside-image {
  position: relative;
  text-align: center;
  margin-top: -50px;
  z-index: 3;
  background-color: #fff;
}

.overlay-form {
  position: absolute;
  top: 50%;
  left: 45%;
  transform: translate(-50%, -50%);
  z-index: 3;
  /* margin-right: 50%; */
  
}

.form-control {
  width: 190%;
  padding: 3.5%;
  border: 4px solid #7606ff;
  border-left:none ;
  font-size: 25px;
  transform: translateY(330%);
  animation: flyIn 0.5s forwards;

}
.form-control-name {
  /* width: 300%; */

  border: 4px solid #7606ff;
  font-size: 25px;
  transform: translateY(200%);
  animation: flyIn 0.5s forwards;
  border-radius: 6px;
}

.button-control {
  /* width: 140%; */

  /* border: 5px solid #40008f; */
  font-size: 25px;
  transform: translateY(330%);
  animation: flyIn 0.5s forwards;
}

@keyframes flyIn {
  from {
    transform: translateY(-50%);
  }
  to {
    transform: translateY(320%);
  }
}

#search {
  font-weight: bold;
  font-size: 13px;
  border: 3px solid #7606ff;
  border-left: none;
}
</style>


