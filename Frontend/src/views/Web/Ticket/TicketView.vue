<template>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="booking-card">
            <h1 class="text-center">Booking Room</h1>
            <div class="card">
                <div class="card-body">
                    <div class="form-group row mb-2">
                        <label class="col-sm-4 col-form-label">Name:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.Name }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-4 col-form-label">Email:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.email }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-4 col-form-label">Phone:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.phone }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-4 col-form-label">Home:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.home }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-4 col-form-label">Room:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.room }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-4 col-form-label">Date From:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.dateFrom }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-4 col-form-label">Date To:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.dateTo }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-4 col-form-label">Price:</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext mb-0">{{ booking.price }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-center">
                <button class="btn btn-success btn-sm" @click="goBack">Back</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            booking: {
                Name: 'Ma SreyNy',
                email: 'sreyny.ma@gmail.com',
                phone: '088 35 73 945',
                home: 'A',
                room: '101',
                dateFrom: '15-01-2025',
                dateTo: '05-07-2004',
                price: '$500'
            }
        };
    },
    methods: {
        goBack() {
            alert('Going back!');
            // You can add your back button logic here
        }
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
