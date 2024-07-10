<template>
  <div>
    <CardDetail :ListImages="ListImages"/>

    <div>

      {{ ListImages }}
      
    </div>
  </div>
</template>

<script>
import axios from "axios";
import CardDetail from "./CardDetail.vue";

export default {
  name: "ListRoom",
  components: {
    CardDetail
  },
  data() {
    return {
      ListImages: [],
      selectedRoom: null,
    };
  },

  mounted() {
    this.fetchRoomDetails();
  },
  
  methods: {
    async fetchRoomDetails() {
      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/guest_house/show/4`
        );
       
        if (response.data.rooms) {
          this.ListImages.push(response.data.rooms); // Assuming data is an array of images
        }
      } catch (error) {
        console.error("Error fetching category details:", error);
      }
    },
  }
};
</script>

<style>
/* Add your component-specific styles here if needed */
</style>
