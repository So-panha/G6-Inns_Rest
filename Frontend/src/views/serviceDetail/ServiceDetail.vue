<template>
  <div>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-white">
      <div class="flex mt-2 mb-2 ml-2">
        <router-link to="/home">
          <span class="material-symbols-outlined" style="font-size: 30px"> arrow_back </span>
        </router-link>
        <h4 class="pt-2 pl-1"></h4>
      </div>
    </nav>

    <!-- Header -->
    <header class="bg-image mr-2 ml-2" :style="{ backgroundImage: `url(${currentImage})` }">
      <h1></h1>
      <h2 class="text-white pt-120 pl-5">Paradise Cozy Guesthouse Sihanoukville</h2>
    </header>

    <!-- Container -->
    <div class="container">
      <div class="text-center mt-5 mb-5">
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
import { ref, onMounted, onUnmounted } from 'vue';
import FooterView from '../Web/Post/FooterView.vue';
import ListRoom from './ListRoom.vue';
import UserComment from './UserComment.vue';
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
    FooterView
  },
  setup() {
    const images = [image1, image2, image3, image4, image5];
    const currentIndex = ref(0);
    const currentImage = ref(images[currentIndex.value]);

    let intervalId;

    const startImageCarousel = () => {
      intervalId = setInterval(() => {
        currentIndex.value = (currentIndex.value + 1) % images.length;
        currentImage.value = images[currentIndex.value];
      }, 3000); // Change image every 3 seconds
    };

    onMounted(() => {
      startImageCarousel();
    });

    onUnmounted(() => {
      clearInterval(intervalId);
    });

    return {
      currentImage
    };
  }
};
</script>

<style scoped>
.bg-image {
  background-size: cover;
  background-position: center;
  height: 500px;
}
</style>