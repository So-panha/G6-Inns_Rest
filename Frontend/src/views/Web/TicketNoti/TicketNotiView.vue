<template>
  <div>
    <div v-if="!showTicketView" class="z-10 fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50">
      <div class="container mt-5 bg-white p-5 rounded-sm shadow-sm relative w-1/2 max-w-2xl">
        <div class="text-center">
          <h1>Welcome to Inns Rest</h1>
          <h2 class="mb-4">Notifications</h2>
          <div v-for="(notification, index) in notifications" :key="index" class="mb-3">
            <div class="card">
              <div class="card-body">
                <div class="flex justify-between items-center">
                  <div>
                    <p>Home: {{ notification.geust_house }}</p>
                    <p>Room: {{ notification.room_name }}</p>
                  </div>
                  <div class="text-right">
                    <p>{{ notification.time }}</p>
                    <button class="btn btn-success mr-3"
                      @click="showTicketView = true; selectedNotification = notification">Detail</button>
                    <button class="btn btn-danger" @click="deleteNotification(index,notification.id)">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button @click="$emit('close-popup')" class="absolute top-9 right-9 btn btn-danger">X</button>
        </div>
      </div>
    </div>

    <!-- Ticket Detail Popup -->
    <ticket-view v-if="showTicketView" :booking="selectedNotification" @close-popup="closeTicketView"></ticket-view>
  </div>
</template>

<script>
import TicketView from '../Ticket/TicketView.vue';
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '../../../stores/auth-store.ts';
// Get the auth store to manage user data
const authStore = useAuthStore();

export default {
  components: {
    TicketView,
  },
  data() {
    return {
      notifications: [],
      showTicketView: false,
      selectedNotification: null,
    };
  },
  mounted() {
    this.fetchData()
  },
  methods: {
    deleteNotification(index,ticketId) {
      this.notifications.splice(index, 1);
      console.log(ticketId);
      // Delete notification from API or database here
      axiosInstance.delete(`/cancel-ticket/${ticketId}`)
       .then(() => {
          console.log('Notification deleted successfully');
        })
       .catch((error) => {
          console.error('Error deleting notification:', error);
        });
    },
    closeTicketView() {
      this.showTicketView = false;
      this.selectedNotification = null;
    },
    async fetchData() {
      // Fetch data from API or database here
      const id = authStore.user.id;
      try {
        const response = await axiosInstance.get(`/tickets/${id}`);
        if (response.status == 200) {
          this.notifications = response.data.data;
          console.log(this.notifications);
        }
        else {
          console.error('Error fetching notifications:', response.statusText)
        }
      } catch (e) {
        console.error('Error fetching likes:', e)
      }
    },
  }
};
</script>

<style scoped>
.fixed {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  width: 100vw;
}

.container {
  width: 80%;
  max-width: 600px;
}

.booking-card {
  padding: 20px;
  background-color: #f8f9fa;
  /* Light background color */
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  /* Soft shadow */
}

.btn-success {
  background-color: green;
  border-color: green;
  color: white;
  /* Text color */
}

.btn-success:hover {
  background-color: darkgreen;
  border-color: darkgreen;
}
</style>