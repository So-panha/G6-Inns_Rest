<template>
  <div class="container">

    <div class="image-gallery">
      <div class="image-item">
        <img src="https://i.pinimg.com/736x/9d/d9/e8/9dd9e8449a07a4e942ace34f86771b16.jpg" alt="Room 1" class="zoom">
      </div>
      <div class="image-item">
        <img src="https://i.pinimg.com/736x/8d/bf/86/8dbf8697536b7fb44e444c52d856f52f.jpg" alt="Room 2" class="zoom">
      </div>
      <div class="image-item">
        <img src="https://i.pinimg.com/736x/d8/0d/8f/d80d8f9aae74097a28f023ba25547d43.jpg" alt="Room 3" class="zoom">
      </div>
    </div>
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
}

.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 50vh;
  /* Ensure full viewport height */
  background-image: url('https://i.pinimg.com/564x/6a/fd/29/6afd297faea93c71cd076ade13b2b767.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  padding-bottom: 50px;
  /* Space for the gallery at the bottom */
  position: relative;
}

.content {
  margin-top: 20px;
  position: relative;
  background: rgba(255, 255, 255, 0.9);
  padding: 20px;
  width: 100%;
  /* Adjusted width */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  margin: 0 auto;
  /* Center the content horizontally */
}

.error {
  color: red;
}

.text-right {
  text-align: right;
}

.btn {
  margin-top: 10px;
}

.image-gallery {
  display: flex;
  justify-content: center;
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  background-color: rgba(255, 255, 255, 0.9);
  padding: 20px;
  box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.2);
  z-index: 2;
  /* Ensure gallery is above the content */
}

.image-item {
  margin: 0 10px;
}

.image-item img {
  width: 150px;
  /* Adjusted smaller image size */
  height: 150px;
  /* Adjusted smaller image size */
  border-radius: 8px;
  border: 5px solid white;
  transition: transform .2s;
}

.image-item img:hover {
  transform: scale(1.1);
}
@media screen and (max-width: 767px) {
  .container {
    padding-bottom: 20px;
  }

  .image-gallery {
    flex-direction: row;
    padding: 10px;
  }

  .image-item {
    margin: 10px 0;
  }

  .image-item img {
    width: 100px;
    height: 100px;
  }

  .content {
    width: 90%;
    padding: 10px;
  }

  .text-right {
    text-align: center;
  }
}
</style>