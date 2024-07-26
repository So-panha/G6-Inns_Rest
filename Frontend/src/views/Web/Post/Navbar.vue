<template>
  <header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center">
      <div class="flex items-center">
        <img :src="LogoInn" alt="LogoInn Logo" class="h-16 mr-6" />
      </div>

      <div class="flex items-center space-x-6">
        <div class="text-gray-600">
          <h5 class="font-bold text-purple-500">Opening Hour</h5>
          <p>Everyday: 8.00am - 9.00pm</p>
        </div>
        <div class="text-center">
          <h5 class="font-bold text-purple-500">Free</h5>
          <p class="text-gray-600">Check IN | Check OUT</p>
        </div>
        <div class="text-right">
          <h6 class="font-bold">Ready to book?</h6>
          <h6 class="font-bold">Find your rest house here</h6>
        </div>
        <div class="flex items-center space-x-9">
          <div @click="$emit('toggleTicketNotiPopup')">
            <div  v-if="showTicketNotiPopup" class="w-6 h-6 bg-red-500 relative top-4 left-6 z-10 rounded-full text-center text-white">{{showTicketNotiPopup}}</div>
            <span class="material-symbols-outlined" style="font-size: 35px"> shopping_cart </span>
          </div>
          <div @click="$emit('toggleProfilePopup')">
            <img :src="getImage(tempInputs.profile)" class="profile-image rounded-full h-15 w-15" />
          </div>
        </div>
      </div>
    </div>
  </header>
  <NavComponentViewVue />
</template>
<script setup lang="ts">
import axios from 'axios'
import axiosInstance from '@/plugins/axios'
import { defineProps, ref, onMounted } from 'vue'
import LogoInn from '@/assets/LogoInn.svg'
import { useAuthStore } from '../../../stores/auth-store.ts'
import NavComponentViewVue from './NavComponentView.vue'

const authStore = useAuthStore()
interface ProfileData {
  profile: string
}

const props = defineProps<{
  showProfilePopup: boolean
  tempInputs: ProfileData,
  showTicketNotiPopup: '',
}>()

const showTicketNotiPopup = ref(null);

const fetchData = async () => {
  try {
    const response = await axiosInstance.get(`/tickets/${authStore.user.id}`);
    showTicketNotiPopup.value = response.data.data.length;
    console.log(showTicketNotiPopup.value);
    
      
  } catch (error) {
    console.error('Error fetching notifications:', error);
  }
};

fetchData();

const emit = defineEmits<{
  (event: 'toggleEditPopup'): void
  (event: 'toggleProfilePopup'): void
}>()
// please make it get id denimic make it can

const tempInputs = ref<ProfileData>({
  profile: ''
})

const showEditPopup = () => {
  emit('toggleEditPopup')
}

const getImage = (profile: string) => {
  return `http://127.0.0.1:8000/storage/${profile}`
}

const fetchUserData = async () => {
  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/user/show/${authStore.user.id}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('access_token')}`
      }
    })
    // Update tempInputs with response data
    Object.assign(tempInputs.value, response.data.user)
  } catch (error) {
    console.error('Error fetching user data:', error)
  }
}

// Fetch user data when component is mounted
onMounted(() => {
  fetchUserData()
})
</script>
<style scoped>
.profile-image {
  /* border: 2px solid rgb(238, 40, 228); */
  border-radius: 50%;
}
.shadow-md {
  box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.25);
}

header {
  background-color: #ffffff;
  padding: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.logo {
  font-size: 32px;
  font-weight: bold;
}
.contact-info {
  display: flex;
  align-items: center;
}
.contact-info > * {
  margin-left: 20px;
  font-size: 16px;
}
.contact-info a {
  color: #000;
  text-decoration: none;
}
</style>
