<template>
  <div class="z-10 fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50">
    <div class="container bg-white p-5 rounded-sm shadow-sm relative w-1/2 max-w-2xl">
      <div class="booking-card">
        <h1 class="text-center">Room's Ticket</h1>
        <div class="card">
          <div class="card-body">
            <div class="form-group row mb-2" v-if="booking">
              <label class="col-sm-4 col-form-label">Name: </label>
              <div class="col-sm-8">
                <p class="form-control-plaintext mb-0">{{ booking.name_user }}</p>
              </div>
            </div>
            <div class="form-group row mb-2">
              <label class="col-sm-4 col-form-label">Home:</label>
              <div class="col-sm-8">
                <p class="form-control-plaintext mb-0">{{ booking.guest_house }}</p>
              </div>
            </div>
            <div class="form-group row mb-2">
              <label class="col-sm-4 col-form-label">Room:</label>
              <div class="col-sm-8">
                <p class="form-control-plaintext mb-0">{{ booking.room_name }}</p>
              </div>
            </div>
            <div class="form-group row mb-2">
              <label class="col-sm-4 col-form-label">Email Owner:</label>
              <div class="col-sm-8">
                <p class="form-control-plaintext mb-0">{{ booking.email_owner }}</p>
              </div>
            </div>
            <div class="form-group row mb-2">
              <label class="col-sm-4 col-form-label">Phone Owner:</label>
              <div class="col-sm-8">
                <p class="form-control-plaintext mb-0">{{ booking.phone_owner }}</p>
              </div>
            </div>
            <div class="form-group row mb-2">
              <label class="col-sm-4 col-form-label">Date From:</label>
              <div class="col-sm-8">
                <p class="form-control-plaintext mb-0">{{ booking.start_check }}</p>
              </div>
            </div>
            <div class="form-group row mb-2">
              <label class="col-sm-4 col-form-label">Date To:</label>
              <div class="col-sm-8">
                <p class="form-control-plaintext mb-0">{{ booking.check_out }}</p>
              </div>
            </div>
            <div class="form-group row mb-2">
              <label class="col-sm-4 col-form-label">Total:</label>
              <div class="col-sm-8">
                <p class="form-control-plaintext mb-0">{{ booking.Total }}$</p>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-3 text-center">
          <button class="btn btn-success btn-sm" @click="$emit('close-popup')">Back</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['booking'],
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
  background-color: #f8f9fa; /* Light background color */
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
}

.btn-success {
  background-color: green;
  border-color: green;
  color: white; /* Text color */
}
.btn-success:hover {
  background-color: darkgreen;
  border-color: darkgreen;
}

.form-group {
  margin-bottom: 15px;
}

.card {
  border: none; /* Remove default card border */
  box-shadow: none; /* Remove default card shadow */
}

.col-form-label {
  font-weight: bold; /* Make labels bold */
}
</style>
