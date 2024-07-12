<template>
  <div class="flex justify-between px-20 py-3 bg-white" style="box-shadow: 0 4px 2px -2px rgba(0,0,0,.25);">
    <div class="flex items-start space-x-1">
      <img :src="LogoInn" alt="LogoInn Logo" class="h-20" />
    </div>  

    <div class="mt-8 mb-3 ml-3">
      <h5 style="font-weight: bold;">Free </h5>
      <h6>Check IN | Check Out</h6>
      <hr>
    </div>
    <div class="flex">
      <div class="mt-8 mr-30" >
        <h6 style="font-weight: bold;">Ready to book?</h6>
        <h6 style="font-weight: bold;">Find your rest house here</h6>
        <hr>
      </div>
      <div class="flex mt-8">
        <router-link to="/ticketNoti"
          ><span class="material-symbols-outlined mr-6" style="font-size: 45px">
            shopping_cart
          </span></router-link
        >
        <div @click="$emit('toggleProfilePopup')">
          <img :src="profileImageUrl" class="profile-image rounded-full mr-7 h-12 w-12" />
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
