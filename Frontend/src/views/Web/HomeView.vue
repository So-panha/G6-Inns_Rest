<script setup lang="ts">
import { ref } from 'vue'
import LogoInn from '@/assets/LogoInn.svg'
import UserIcon from '@/assets/UserIcon.svg'

import FooterView from './Post/FooterView.vue'
import MapViewVue from './MapSearch/MapView.vue'
const showPopup = ref(false)
import { useAuthStore } from '@/stores/auth-store'
import { useRouter } from 'vue-router'
import CardServiceVue from './Post/CardService.vue'
const authStore = useAuthStore()
const router = useRouter()

const logout = () => {
  localStorage.removeItem('access_token')
  router.push('/login')
}

const markerData = ref([])

const handleMarkerData = (data) => {
  markerData.value = data.address
  if (data.address) {
    // Center the map on the marker location
    mapView.value.flyToMarker(data.address)
  }
}

// Add a ref to the MapViewVue component
const mapView = ref(null)
</script>

<template>
  <navbar class="flex justify-between px-20 py-3 bg-white">
    <div class="flex items-start space-x-1">
      <img :src="LogoInn" alt="LogoInn Logo" class="h-20" />
    </div>
    <div class="flex">
      <div class="mt-3 mr-10">
        <h6>Ready to book?</h6>
        <h6>Find your rest house here</h6>
      </div>
      <div class="flex mt-3">
        <span class="material-symbols-outlined mr-6" style="font-size: 40px"> shopping_cart </span>
        <div @click="showPopup = true" class="cursor-pointer">
          <img
            src="https://i.pinimg.com/564x/17/dd/c2/17ddc2f538307c63a2e92707886d9234.jpg"
            class="rounded-circle mr-3 h-10 w-10"
          />
        </div>
      </div>
    </div>
  </navbar>

  <!--------------------------------Maps Views------------------------------------------------ -->
  <MapViewVue ref="mapView" :markerData="markerData" />
  <CardServiceVue @markerData="handleMarkerData" />

  <!-- Popup ------------------------------------->
  <div
    v-show="showPopup"
    class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50"
  >
    <div class="bg-white p-10 rounded-sm shadow-sm relative w-1/2 max-w-2xl">
      <button @click="showPopup = false" class="absolute top-2 right-2 text-black">
        <span @click="showPopup = false" class="material-symbols-outlined"> close </span>
      </button>
      <div class="flex">
        <span @click="showPopup = false" class="material-symbols-outlined mr-2"> arrow_back </span>
        <h5>info</h5>
      </div>
      <div class="text-center">
        <img
          class="w-40 h-40 mx-auto rounded-full"
          src="https://i.pinimg.com/564x/17/dd/c2/17ddc2f538307c63a2e92707886d9234.jpg"
        />
        <h3 class="mt-4">{{ authStore.user.name }}</h3>
      </div>
      <div class="mt-4">
        <div class="flex items-center mb-4">
          <span class="material-symbols-outlined mr-2 ml-3" style="font-size: 40px">
            account_circle
          </span>
          <h6>Name:</h6>
          <h6 class="ml-80">{{ authStore.user.name }}</h6>
        </div>
        <div class="flex items-center mb-4">
          <span class="material-symbols-outlined mr-2 ml-3" style="font-size: 40px"> call </span>
          <h6>Phone:</h6>
          <h6 class="ml-80">{{ authStore.user.phoneNumber }}</h6>
        </div>
        <div class="flex items-center mb-4">
          <span class="material-symbols-outlined mr-2 ml-3" style="font-size: 40px"> id_card </span>
          <h6 class="mt-2">UserName:</h6>
          <h6 class="ml-73">@SreynyMa</h6>
        </div>
      </div>
      <div class="mt-4 flex justify-end">
        <!-- Logout button -->
        <button
          @click="logout"
          class="middle none center rounded-lg bg-teal-500 py-2 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
          data-ripple-light="true"
          id="logout"
        >
          Logout
        </button>
        <button @click="showPopup = false" class="bg-red-500 text-white px-4 py-2 rounded">
          Cancel
        </button>
      </div>
    </div>
  </div>
  <FooterView />
</template>

<style scoped>
.flex-shrink-0 {
  flex-shrink: 0;
}

#logout {
  margin-right: 10px;
}
</style>
