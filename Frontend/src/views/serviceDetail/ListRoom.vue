<template>
  <div>
    <div v-if="ListImages.length > 0">
      <CardDetail :ListImages="ListImages" :startDate="startDate" :endDate="endDate" :bookings="bookings" :daysBetween="daysBetween"/>
    </div>
    <div v-else>
      <h1>This Guest House doesn't have any room</h1>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import CardDetail from './CardDetail.vue';

export default {
  name: 'ListRoom',
  components: {
    CardDetail,
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
    bookings: {
      type: Array,
      default: () => []
    },
    daysBetween:{
      type: String,
      default: null
    }
  },
  data() {
    return {
      ListImages: []
    };
  },
  mounted() {
    this.fetchRoomDetails();
  },
  methods: {
    async fetchRoomDetails() {
      try {
        const id = this.$route.params.id;
        console.log("Fetching room details for ID:", id);
        const response = await axios.get(`http://127.0.0.1:8000/api/guest_house/show/${id}`);

        if (response.data.rooms) {
          this.ListImages = response.data.rooms;
          console.log("Fetched room details:", this.ListImages);
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
/* Your styles here */
</style>
