<template>
  <div
    v-show="showProfilePopup"
    class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50"
  >
    <div class="bg-white p-5 rounded-sm shadow-sm relative w-1/2 max-w-2xl">
      <button @click="$emit('toggleEditPopup')" class="absolute btn btn-purple top-4 right-2">
        <span class="material-symbols-outlined"> edit_square </span>
      </button>
      <div class="absolute flex top-4 left-2">
        <button @click="toggleProfilePopup" type="button" class="btn btn-outline-dark">
          <span class="material-symbols-outlined"> arrow_back </span>
        </button>
        <h5 class="mt-2 ml-2">Info</h5>
      </div>
      <div class="text-center">
        <img class="profile-image w-30 h-30 mx-auto rounded-full" :src="profileImageUrl" />
        <h3 class="mt-4">{{ authStore.user.name }}</h3>
      </div>
      <div class="mt-4">
        <div class="flex items-center mb-4">
          <span class="material-symbols-outlined mr-10 ml-20" style="font-size: 40px">
            account_circle
          </span>
          <h5>Name:</h5>
          <h6 class="ml-30">{{ authStore.user.name }}</h6>
        </div>
        <div class="flex items-center mb-4">
          <span class="material-symbols-outlined mr-10 ml-20" style="font-size: 40px"> call </span>
          <h5>Phone:</h5>
          <h6 class="ml-30">{{ authStore.user.phoneNumber }}</h6>
        </div>
        <div class="flex items-center mb-4">
          <span class="material-symbols-outlined mr-10 ml-20" style="font-size: 40px">
            mark_email_unread
          </span>
          <h5 class="mt-2">Email:</h5>
          <h6 class="ml-30">{{ authStore.user.email }}</h6>
        </div>
      </div>
      <div class="mt-4 flex justify-end">
        <button @click="logout" class="btn btn-info mr-2" data-ripple-light="true" id="logout">
          Logout
        </button>
        <button @click="closeProfilePopup" class="btn btn-danger text-white px-4 py-2 rounded">
          Close
        </button>
        <!-- {{ authStore }} -->
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits, onMounted, ref } from 'vue'
// import axios from 'axios'
import { useAuthStore } from '../../../stores/auth-store.ts'

const authStore = useAuthStore()

const props = defineProps({
  showProfilePopup: Boolean
})

const emit = defineEmits(['toggleProfilePopup', 'toggleEditPopup'])

const profileImageUrl = ref('')
const inputs = ref({
  name: '',
  phoneNumber: '',
  email: ''
})

const logout = () => {
  localStorage.removeItem('access_token')
  emit('toggleProfilePopup')
  window.location.href = '/'
}

const closeProfilePopup = () => {
  emit('toggleProfilePopup')
  localStorage.removeItem('profile_image_url')
  localStorage.removeItem('inputs')
}
</script>

<style scoped>
.profile-image {
  border: 2px solid rgb(238, 40, 228);
  border-radius: 50%;
}
</style>
