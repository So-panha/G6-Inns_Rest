<template>
  <div>
    <div v-if="!showTicketView" class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50">
      <div class="container mt-5 bg-white p-5 rounded-sm shadow-sm relative w-1/2 max-w-2xl">
        <div class="text-center">
          <div class="welcome">
            <h1>Welcome to Inns Rest</h1>
            <h2 class="mb-4">Notifications</h2>
          </div>

          <div v-for="(notification, index) in notifications" :key="index" class="mb-3">
            <div class="card">
              <div class="card-body">
                <div class="flex justify-between items-center">
                  <div>
                    <p>Home: {{ notification.home }}</p>
                    <p>Room: {{ notification.room }}</p>
                  </div>
                  <div class="text-right">
                    <p>{{ notification.date }}</p>
                    <button class="btn btn-success mr-3"
                      @click="showTicketView = true; selectedNotification = notification">Detail</button>
                    <button class="btn btn-danger" @click="deleteNotification(index)">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <span @click="$emit('close-popup')" class="absolute top-9 right-9" style="border: none;">X</span>
        </div>
      </div>
    </div>

    <!-- Ticket Detail Popup -->
    <ticket-view v-if="showTicketView" :booking="selectedNotification" @close-popup="closeTicketView"></ticket-view>
  </div>
</template>

<script>
import TicketView from '../Ticket/TicketView.vue';

export default {
  components: {
    TicketView,
  },
  data() {
    return {
      notifications: [
        { home: 'C', room: '160', date: '09-01-2024', Name: 'John Doe', email: 'john.doe@example.com', phone: '123-456-7890', dateFrom: '01-01-2024', dateTo: '01-07-2024', price: '$100' },
        { home: 'B', room: '210', date: '15-01-2024', Name: 'Jane Doe', email: 'jane.doe@example.com', phone: '098-765-4321', dateFrom: '01-02-2024', dateTo: '01-08-2024', price: '$200' },
        { home: 'A', room: '230', date: '05-07-2024', Name: 'Sam Smith', email: 'sam.smith@example.com', phone: '111-222-3333', dateFrom: '01-03-2024', dateTo: '01-09-2024', price: '$300' },
      ],
      showTicketView: false,
      selectedNotification: null,
    };
  },
  methods: {
    deleteNotification(index) {
      this.notifications.splice(index, 1);
    },
    closeTicketView() {
      this.showTicketView = false;
      this.selectedNotification = null;
    },
  },
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
  width: 100%;
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

.close-button {
  position: absolute;
  top: 9px;
  right: 9px;
  cursor: pointer;
  background: none;
  border: none;
  outline: none;
  padding: 0;
  margin: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  /* Adjust size as needed */
  color: inherit;
  /* Inherit the color from the parent element */
}

@media screen and (min-width: 768px) and (max-width: 1024px)  {
  .container {
    width: 80%;
  }
}


@media (max-width: 767px) {
  .container {
    width: 90%;
    padding: 5px; /* Reduced padding */
  }

  .card-body {
    flex-direction: column;
    text-align: center;
  }

  .text-right {
    text-align: center;
    margin-top: 5px; /* Reduced margin */
  }

  /* Smaller buttons and text for small screens */
  .btn {
    font-size: 10px; /* Smaller font size */
    padding: 4px 8px; /* Reduced padding */
  }

  h1 {
    display: none;
  }

  h2 {
    font-size: 16px; /* Reduced font size */
  }

  p {
    font-size: 12px; /* Smaller font size */
  }

  .close-button {
    font-size: 18px; /* Smaller font size */
  }
}

</style>
