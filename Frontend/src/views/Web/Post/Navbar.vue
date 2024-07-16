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
      <div class="flex items-center space-x-8">
        <span
          class="material-symbols-outlined text-gray-700 cursor-pointer"
          style="font-size: 32px"
          @click="$emit('toggleTicketNotiPopup')"
        >
          shopping_cart
        </span>
        <img
          :src="profileImageUrl"
          alt="Profile Image"
          class="profile-image h-10 w-10 cursor-pointer"
          @click="$emit('toggleProfilePopup')"
        />
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
import { defineProps, defineEmits } from 'vue'
import LogoInn from '@/assets/LogoInn.svg'

const props = defineProps({
  profileImageUrl: String
})

const emit = defineEmits(['toggleProfilePopup', 'toggleTicketNotiPopup'])
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
