<template>
  <div class="scroll">
    <CardService :houses="houses" />
    <!-- <MapViewVue :houses="houses"/>   -->
  </div>
</template>

<script>
// import axios from 'axios'
import CardService from './CardService.vue'
import axiosInstance from '@/plugins/axios'
import MapViewVue from '../MapSearch/MapView.vue'

export default {
  name: 'ListCardView',
  components: {
    CardService,
  },
  data() {
    return {
      houses: []
    }
  },
  mounted() {
    this.fetchHouses()
  },
  methods: {
    async fetchHouses() {
      try {
        const response = await axiosInstance.get('/Guest_House')
        this.houses = response.data.data
        // console.log(response.data.data)
      } catch (error) {
        console.error('Error fetching houses:', error)
      }
    }
  }
}
</script>

<style scoped>
scroll {
  overflow-y: auto;
  overflow-x: hidden;
}
/* Add your styles here if necessary */
</style>
