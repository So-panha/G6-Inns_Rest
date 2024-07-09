<template>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="booking-card">
            <h1 class="text-center">Booking Room</h1>
            <div class="card">
                <div class="card-body">
                    <div class="form-group row mb-2" v-if="booking.first_name">
                        <label class="col-sm-4 col-form-label">First Name:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.first_name }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2" v-if="booking.last_name">
                        <label class="col-sm-4 col-form-label">Last Name:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.last_name }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2" v-if="booking.email">
                        <label class="col-sm-4 col-form-label">Email:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.email }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2" v-if="booking.phone_number">
                        <label class="col-sm-4 col-form-label">Phone:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.phone_number }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2" v-if="booking.number_of_rooms">
                        <label class="col-sm-4 col-form-label">Number Of Rooms:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.number_of_rooms }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2" v-if="booking.departure_date">
                        <label class="col-sm-4 col-form-label">Departure From:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.departure_date }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2" v-if="booking.arrival_date">
                        <label class="col-sm-4 col-form-label">Arrival To:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.arrival_date }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2" v-if="booking.price">
                        <label class="col-sm-4 col-form-label">Price:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.price }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'BookingUser',
    data() {
        return {
            booking: []
        };
    },
    created() {
        this.fetchBooking();
    },
    methods: {
        async fetchBooking() {
            try {
                const response = await axios.get('/api/booking-user-rooms');
                this.booking = response.data.data[0]; // Assuming you want to show the first booking
            } catch (error) {
                console.label(error)
                // console.error('Error fetching booking data:', error);
            }
        },
    }
};
</script>

<style scoped>
.booking-card {
    width: 80%;
    max-width: 600px; /* Set a maximum width to ensure responsiveness */
    padding: 20px;
    background-color: #f8f9fa; /* Light background color */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
    margin-top: 20px;
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
