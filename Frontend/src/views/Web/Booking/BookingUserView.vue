<template>
  <div class="container">
    <h1>Booking <br> Room</h1>
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12 mb-3 mt-3">
        <input type="number" class="form-control" id="numRooms" v-model="form.numRooms" placeholder="Number Of Room">
        <span v-if="errors.numRooms" class="error">{{ errors.numRooms }}</span>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3 mt-3">
        <input type="date" class="form-control" id="departuredate" v-model="form.departuredate"
          placeholder="Departure Date">
        <span v-if="errors.departuredate" class="error">{{ errors.departuredate }}</span>
      </div>
      <div class="col-md-6 mb-3 mt-3">
        <input type="date" class="form-control" id="arrivaldate" v-model="form.arrivaldate" placeholder="Arrival Date">
        <span v-if="errors.arrivaldate" class="error">{{ errors.arrivaldate }}</span>
      </div>
    </div>
    <div class="text-right">
      <button class="btn btn-danger mr-2" @click="cancelForm">Cancel</button>
      <button class="btn btn-primary" @click="submitForm">Submit</button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import * as yup from 'yup';
import { useRouter } from 'vue-router';

const router = useRouter();

const form = ref({
  numRooms: '',
  departuredate: '',
  arrivaldate: ''
});
const errors = ref({});

const schema = yup.object().shape({
  numRooms: yup.number().integer().min(1, 'At least one room is required').required('Number of rooms is required'),
  departuredate: yup.date().required('Departure Date is required').min(new Date(), 'Departure Date cannot be in the past'),
  arrivaldate: yup.date().required('Arrival Date is required').min(yup.ref('departuredate'), 'Arrival Date cannot be before Departure Date'),
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
    router.push({
      name: 'qrCode',
      params: {
        numRooms: form.value.numRooms,
        departuredate: form.value.departuredate,
        arrivaldate: form.value.arrivaldate
      }
    });
  }
};

const cancelForm = () => {
  // Handle form cancellation logic
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
  font-size: 50px; /* Adjusted font size */
}

.container {
  margin-top: 10px;
  position: relative;
  width: 100%; /* Adjusted width */
  min-height: 50vh;
  display: flex;
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
  width: 100%; /* Adjusted width */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  margin: 0 auto; /* Center the content horizontally */
}

.error {
  color: red;
  font-size: 12px; /* Adjusted font size */
}

.text-right {
  text-align: right;
}

.btn {
  font-size: 14px; /* Adjusted font size */
  padding: 8px 16px;
  margin-top: 10px;
}

.btn-danger {
  background-color: #dc3545;
  color: white;
}

.btn-primary {
  background-color: #007bff;
  color: white;
}
</style>
