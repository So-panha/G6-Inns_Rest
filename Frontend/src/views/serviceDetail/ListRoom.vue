<template>

  <div>
<!-- {{ bookings }} -->
    <div v-if="ListImages!='' ">
      <CardDetail :ListImages="ListImages" :startDate="startDate" :endDate="endDate" :bookings="bookings"/>
    </div >
    <div v-else>
      <h1>This Gest House doesn't have any room</h1>
    </div>
  </div>
  
</template>

<script>
import axios from 'axios';
import CardDetail from './CardDetail.vue';
import { array } from 'yup';
export default {
  name: 'ListRoom',
  startDate: null,
  endDate: null,
  // bookings:null,
  components: {
    CardDetail ,
  },
  props: {
    startDate: {
      type: String,
      default: null
    },
    endDate: {
      type: String,
      default: null
    },
    bookings:{
      type: String,
      default: null
    }
  },
  data() {
    return {
      ListImages: [] 
    };
  },
  mounted(){
    this.fetchRoomDetails();
  },
  methods: {
    async fetchRoomDetails() {
      try {
        const id = this.$route.params.id;
        console.log("Fetching room details for ID:", id); 
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
    '$route.params.id': 'fetchRoomDetails',
    startDate(newDate) {
      this.$emit('update:startDate', newDate);
    },
    endDate(newDate) {
      this.$emit('update:endDate', newDate);
    }
  }
    
}
</script>

<style>
</style>
