<template>
  <div class="flex justify-between items-center px-6 py-2 bg-white shadow-md">
    <!-- Logo Section -->
    <img :src="LogoInn" alt="LogoInn Logo" class="h-15" />

    <!-- Center Section -->
    <div class="text-center center-section">
      <h5 class="font-bold">Free</h5>
      <h6 class="text-gray-600">Check IN | Check OUT</h6>
      <hr class="border-gray-300 mt-1" />
    </div>

    <!-- Right Section -->
    <div class="flex items-center space-x-9">
      <div class="text-right find-house">
        <h6 class="font-bold">Ready to book?</h6>
        <h6 class="">Find your rest house here</h6>
        <hr class="border-gray-300 mt-1" />
      </div>
      <div class="flex mt-8 profile-cart">
        <div @click="$emit('toggleTicketNotiPopup')">
          <span class="material-symbols-outlined mr-6 shopping-cart-icon" style="font-size: 45px">
            shopping_cart
          </span>
        </div>
        <div @click="$emit('toggleProfilePopup')">
          <img :src="getImage(tempInputs.profile)" class="profile-image rounded-full mr-7 h-12 w-12" />
        </div>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
import axios from 'axios';
import { defineProps, ref, onMounted } from 'vue';
import LogoInn from '@/assets/LogoInn.svg';
import { useAuthStore } from '../../../stores/auth-store.ts';
const authStore = useAuthStore();
interface ProfileData {
  profile: string;
}

const props = defineProps<{
  showProfilePopup: boolean;
  tempInputs: ProfileData;
}>();

const emit = defineEmits<{
  (event: 'toggleEditPopup'): void;
  (event: 'toggleProfilePopup'): void;
}>();
// please make it get id denimic make it can 

const tempInputs = ref<ProfileData>({
  profile: '',
});

const showEditPopup = () => {
  emit('toggleEditPopup');
};

const getImage = (profile: string) => {
  return `http://127.0.0.1:8000/storage/${profile}`;
};

const fetchUserData = async () => {

  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/user/show/${authStore.user.id}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('access_token')}`,
      },
    });
    // Update tempInputs with response data
    Object.assign(tempInputs.value, response.data.user);
  } catch (error) {
    console.error('Error fetching user data:', error);
  }
};

// Fetch user data when component is mounted
onMounted(() => {
  fetchUserData();
});


</script>
<style scoped>
.profile-image {
  border: 2px solid rgb(238, 40, 228);
  border-radius: 50%;
}

.shadow-md {
  box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.25);
}

@media screen and (min-width: 768px) and (max-width: 1024px) {
  .h-15 {
    height: 4rem;
    /* Adjust height for smaller screens */
  }

  .center-section {
    display: none;
  }

  .right-section {
    text-align: left;
    margin: 1rem 0;
  }

  .find-house {
    margin-top: 4%;
  }

  .profile-image {
    height: 4rem;
    width: 4rem;
  }

  .shopping-cart-icon {
    font-size: 4rem;
    margin-top: 8%;
    /* 32px */
  }

  .profile-cart {
    margin-top: 1rem;
    margin-bottom: 1rem;
    margin-left: 2rem;
  }
}

@media screen and (max-width: 767px) {

  .h-15 {
    height: 2.5rem;
    margin-bottom: 2rem;
    /* Add margin-bottom */
  }

  .center-section {
    display: none;
  }

  .find-house {
    display: none;
  }

  .right-section {
    flex-direction: column;
    align-items: center;
    margin-bottom: 1rem;
  }

  .profile-cart {
    margin-top: 1rem;
    margin-bottom: 1rem
  }


  .shopping-cart-icon {

    margin-left: 25%;
  }

  .profile-image {
    height: 2.5rem;
    width: 2.5rem;
    margin-left: 25%;
    margin-bottom: 30%;
  }

}
</style>
