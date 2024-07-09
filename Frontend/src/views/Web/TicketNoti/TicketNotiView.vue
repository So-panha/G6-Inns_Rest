<template>
    <div class="container mt-5">
      <div>
        <h1 class="text-center">Welcome to Inns Rest</h1>
      </div>
      <div>
        <h2 class="text-center mb-4">Notifications</h2>
        <div v-for="(notification, index) in notifications" :key="index" class="row justify-content-center">
          <div class="col-md-6">
            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <p>Home: {{ notification.home }}</p>
                    <p>Room: {{ notification.room }}</p>
                  </div>
                  <div class="col-md-8 text-right">
                    <p>{{ notification.date }}</p>
                    <router-link :to="{ path: '/ticket', query: { home: notification.home, room: notification.room } }" class="btn btn-success mr-3">Detail</router-link>
                    <button class="btn btn-danger" @click="deleteNotification(index)">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- <router-link to="/ticketNoti">
        <span class="material-symbols-outlined mr-6" style="font-size: 40px">shopping_cart</span>
        <span class="badge badge-primary">{{ bookedItems }}</span>
      </router-link> -->
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        notifications: [
          { home: 'C', room: '160', date: '09-01-2024' },
          { home: 'B', room: '210', date: '15-01-2024' },
          { home: 'A', room: '230', date: '05-07-2024' },
        ],
        bookedItems: 0 // Initialize booked items count
      };
    },
    methods: {
      deleteNotification(index) {
        this.notifications.splice(index, 1);
      },
      updateBookedItems() {
        this.bookedItems = this.notifications.length; // Update booked items count
      }
    },
    created() {
      // Call updateBookedItems method initially to update the count
      this.updateBookedItems();
    }
  };
  </script>
  
  <style scoped>
  /* Your existing styles */
  </style>