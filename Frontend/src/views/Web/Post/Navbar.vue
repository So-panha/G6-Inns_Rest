<template>
  <div class="flex justify-between px-20 py-3 bg-white">
    <div class="flex items-start space-x-1">
      <img :src="LogoInn" alt="LogoInn Logo" class="h-20" />
    </div>
    <div class="flex">
      <div class="mt-3 mr-10">
        <h6>Ready to book?</h6>
        <h6>Find your rest house here</h6>
      </div>
      <div class="flex mt-3">
        <router-link to="/ticketNoti"
          ><span class="material-symbols-outlined mr-6" style="font-size: 40px">
            shopping_cart
          </span></router-link
        >
        <div @click="$emit('toggleProfilePopup')">
          <img :src="profileImageUrl" class="profile-image rounded-full mr-3 h-10 w-10" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue'
import LogoInn from '@/assets/LogoInn.svg'

const props = defineProps({
  profileImageUrl: String
})
</script>

<style scoped>
.profile-image {
  border: 2px solid rgb(238, 40, 228);
  border-radius: 50%;
}
</style>
