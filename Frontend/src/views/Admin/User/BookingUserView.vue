<template>
    <div class="container">
        <h1>Booking <br> Room</h1>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-4 mb-3 mt-3 mt-3">
                <input type="text" class="form-control" id="firstname" v-model="form.firstname"
                    placeholder="First name">
                <span v-if="errors.firstname" class="text-danger">{{ errors.firstname }}</span>
            </div>
            <div class="col-md-4 mb-3 mt-3">
                <input type="text" class="form-control" id="lastname" v-model="form.lastname" placeholder="Last name">
                <span v-if="errors.lastname" class="text-danger">{{ errors.lastname }}</span>
            </div>
            <div class="col-md-4 mb-3 mt-3">
                <input type="tel" class="form-control" id="phone" v-model="form.phone" placeholder="Phone number">
                <span v-if="errors.phone" class="text-danger">{{ errors.phone }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3 mt-3">
                <input type="email" class="form-control" id="email" v-model="form.email" placeholder="Email">
                <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
            </div>
            <div class="col-md-4 mb-3 mt-3">
                <input type="text" class="form-control" id="price" v-model="form.price" placeholder="Price Auto">
                <span v-if="errors.price" class="text-danger">{{ errors.price }}</span>
            </div>
            <div class="col-md-4 mb-3 mt-3">
                <input type="number" class="form-control" id="numRooms" v-model="form.numRooms"
                    placeholder="Number Of Room">
                <span v-if="errors.numRooms" class="text-danger">{{ errors.numRooms }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3 mt-3">
                <input type="date" class="form-control" id="departuredate" v-model="form.departuredate"
                    placeholder="Departure Date">
                <span v-if="errors.departuredate" class="text-danger">{{ errors.departuredate }}</span>
            </div>
            <div class="col-md-6 mb-3 mt-3">
                <input type="date" class="form-control" id="arrivaldate" v-model="form.arrivaldate"
                    placeholder="Arrival Date">
                <span v-if="errors.arrivaldate" class="text-danger">{{ errors.arrivaldate }}</span>
            </div>
        </div>
        <div class="text-right">
            <button class="btn btn-danger mr-2" @click="cancel">Cancel</button>
            <button class="btn btn-primary" @click="submitForm">Submit</button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';  // Import useRouter from vue-router
import * as yup from 'yup';

const form = ref({
    firstname: '',
    lastname: '',
    phone: '',
    email: '',
    price: '',
    numRooms: '',
    departuredate: '',
    arrivaldate: ''
});
const errors = ref({});

const router = useRouter();  // Initialize useRouter

const schema = yup.object().shape({
    firstname: yup.string().required('First Name is required'),
    lastname: yup.string().required('Last Name is required'),
    phone: yup.string().matches(/^[0-9]{9,10}$/, 'Phone Number must be between 9 and 10 digits').required('Phone Number is required'),
    email: yup.string().email('Invalid email').required('Email is required'),
    price: yup.number().positive('Price must be a positive number').required('Price is required'),
    numRooms: yup.number().positive('Number of Rooms must be a positive number').integer('Number of Rooms must be an integer').min(1, 'At least one room is required'),
    departuredate: yup.date().required('Departure Date is required').min(new Date(), 'Departure Date cannot be in the past'),
    arrivaldate: yup.date().required('Arrival Date is required').min(yup.ref('departuredate'), 'Arrival Date must be after Departure Date'),
});

const validateForm = async () => {
    errors.value = {};
    try {
        await schema.validate(form.value, { abortEarly: false });
        return true;
    } catch (err) {
        if (err.inner) {
            errors.value = err.inner.reduce((acc, error) => {
                acc[error.path] = error.message;
                return acc;
            }, {});
        }
        return false;
    }
};

const submitForm = async () => {
    if (await validateForm()) {
        // Process the form data and navigate to the QR Code page
        console.log('Form is valid!', form.value);  // Log form data for debugging
        // Example of form data processing
        // You can replace this with an API call or another action
        router.push('/qrCode');  // Navigate to the QR Code page
    }
};

const cancel = () => {
    router.push('/service-detail');  // Navigate to the Service Detail page
    console.log('Form cancelled');
};
</script>

<style scoped>
body,
html {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

h1 {
    margin-top: 20%;
    text-align: left;
    color: white;
    font-size: 70px;
}

.container {
    margin-top: 10px;
    position: relative;
    width: 81%;
    min-height: 50vh;
    display: flex;
    /* justify-content: center; */
    align-items: center;
    background-image: url('https://wpmedia.roomsketcher.com/content/uploads/2021/12/09103646/Subtle_Blue_Shades_Large_Bedroom_idea-1024x768.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.content {
    position: relative;
    background: rgba(255, 255, 255, 0.9);
    padding: 20px;
    width: 81%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-left: 9.5%;
}

.room-image {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 0 auto 20px auto;
}

.text-danger {
    color: red;
}
</style>