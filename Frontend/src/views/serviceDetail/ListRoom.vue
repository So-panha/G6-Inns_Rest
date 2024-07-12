<template>
  <div>

    <div v-if="ListImages!='' ">
      <CardDetail :ListImages="ListImages"/>
    </div >
    <div v-else>
      <h1>No have Room</h1>
    </div>
    
  </div>
</template>

<script>
import axios from 'axios';
import CardDetail from './CardDetail.vue';

export default {
  name: 'ListRoom',
  components: {
    CardDetail
  },
  data() {
    return {
      ListImages: []  // Initialize as an array to store multiple room details
    };
  },
  mounted() {
    this.fetchRoomDetails();
  },
  methods: {
    async fetchRoomDetails() {
      try {
        const id = this.$route.params.id;
        console.log("Fetching room details for ID:", id); // Added logging for debugging
        const response = await axios.get(`http://127.0.0.1:8000/api/guest_house/show/${id}`);
        
        if (response.data.meeesager) {
          this.ListImages = response.data.rooms;
          console.log("Fetched room details:", this.ListImages); // Improved logging
        } else {
          console.error('No rooms data found in the response');
        }
      } catch (error) {
        console.error('Error fetching room details:', error);
      }
    }
  },
  watch: {
    '$route.params.id': 'fetchRoomDetails' // Watch for changes in route params
  }
}
</script>

<style>
/* Add your component-specific styles here if needed */
</style>
