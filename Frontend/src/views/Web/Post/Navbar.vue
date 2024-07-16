<template>
  <div class="flex justify-between items-center px-6 py-2 bg-white shadow-md">
    <!-- Logo Section -->
    <img :src="LogoInn" alt="LogoInn Logo" class="h-12" />

    <!-- Center Section -->
    <div class="text-center">
      <h5 class="font-bold">Free</h5>
      <h6 class="text-gray-600">Check IN | Check OUT</h6>
      <hr class="border-gray-300 mt-1" />
    </div>

    <!-- Right Section -->
    <div class="flex items-center space-x-9">
      <div class="text-right">
        <h6 class="font-bold">Ready to book?</h6>
        <h6 class="font-bold">Find your rest house here</h6>
        <hr class="border-gray-300 mt-1" />
      </div>
      <div class="flex mt-8">
        <div @click="$emit('toggleTicketNotiPopup')">
          <span class="material-symbols-outlined mr-6" style="font-size: 45px">
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
</style>
