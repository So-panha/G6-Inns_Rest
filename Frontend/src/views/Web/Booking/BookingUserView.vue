<template>
  <form @submit.prevent="PostBooking" method="POST">
    {{ selectedRoomId }}
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
    <div class="contain">
      <div class="row">
        <div class="col-md-6 mb-3 mt-3">
          <label for="numRooms">Number of rooms user booking</label>
          <input type="number" class="form-control" id="numRooms" v-model.number="form.numRooms" placeholder="Number Of Rooms">
          <span v-if="errors.numRooms" class="error">{{ errors.numRooms }}</span>
        </div>
        <div class="col-md-6 mb-3 mt-3">
          <label for="price">Price</label>
          <input type="number" class="form-control" id="price" v-model.number="form.price" placeholder="Price">
          <span v-if="errors.price" class="error">{{ errors.price }}</span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3 mt-3">
          <label for="user">User ID</label>
          <input type="number" class="form-control" id="user" v-model.number="form.user_id" placeholder="User Id">
          <span v-if="errors.user_id" class="error">{{ errors.user_id }}</span>
        </div>
        <div class="col-md-6 mb-3 mt-3">
          <label for="room">Room name</label>
          <input type="text" class="form-control" id="room" v-model="form.room_id" placeholder="Room Name">
          <span v-if="errors.room_id" class="error">{{ errors.room_id }}</span>
        </div>
      </div>
      <div class="text-right">
        <button class="btn btn-danger mr-2" @click="cancelForm">Cancel</button>
        <button class="btn btn-primary" type="submit">Start to pay</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { ref, toRefs, watch } from 'vue';
import * as yup from 'yup';
import { useRouter } from 'vue-router';
import axios from 'axios';

const props = defineProps({
  startDate: {
    type: String,
    default: null
  },
  endDate: {
    type: String,
    default: null
  },
  selectedRoomId: {
    type: Object,
    default: () => ({ id: null, user_id: { id: null }, price: null })
  }
});

const { startDate, endDate, selectedRoomId } = toRefs(props);
const router = useRouter();

const form = ref({
  price: selectedRoomId.value.price || '',
  numRooms: '',
  numGuests: '',
  departuredate: startDate.value,
  arrivaldate: endDate.value,
  user_id: selectedRoomId.value.user_id.id || '',
  room_id: selectedRoomId.value.name || ''
});

const errors = ref({});
const availableRooms = ref(0);

const schema = yup.object().shape({
  numRooms: yup.number().integer().min(1, 'At least one room is required').required('Number of rooms is required'),
  price: yup.number().required('Price is required'),
  user_id: yup.number().required('User ID is required'),
  name: yup.string().required('Name is required')
});

const validateForm = async () => {
  errors.value = {}; // Clear previous errors
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

const fetchAvailableRooms = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/available-rooms', {
      params: {
        arrival_date: form.value.arrivaldate,
        departure_date: form.value.departuredate
      }
    });
    availableRooms.value = response.data.available_rooms;
  } catch (error) {
    console.error('Error fetching available rooms:', error);
  }
};

const PostBooking = async () => {
  const isValid = await validateForm();

  if (isValid) {
    try {
      const payload = {
        price: form.value.price ,
        number_of_rooms: form.value.numRooms,
        departure_date: form.value.departuredate,
        arrival_date: form.value.arrivaldate,
        user_id: form.value.user_id,
        room_id: form.value.name
      };

      console.log('Payload:', payload);

      const response = await axios.post('http://127.0.0.1:8000/api/booking_user_rooms/create', payload);

      console.log('Response:', response);

      if (response.status === 201) {
        console.log('Booking successful:', response.data);
        router.push({
          name: 'qrCode',
          params: {
            numRooms: form.value.numRooms,
            departuredate: form.value.departuredate,
            arrivaldate: form.value.arrivaldate
          }
        });
      } else {
        throw new Error('Failed to submit the form');
      }
    } catch (error) {
      console.error('Error during booking submission:', error.message);

      if (error.response) {
        console.error('Response status:', error.response.status);
        console.error('Response data:', error.response.data);
      } else if (error.request) {
        console.error('No response received:', error.request);
      } else {
        console.error('Error setting up the request:', error.message);
      }
    }
  } else {
    console.log('Form validation failed');
  }
};

const cancelForm = () => {
  // Reset form values or navigate to another page
  router.push({ name: 'home' }); // Redirect to home or reset the form values
};

watch([startDate, endDate], () => {
  if (startDate.value && endDate.value) {
    fetchAvailableRooms();
  }
}, { immediate: true });
</script>

<style scoped>
/* Your styles here */

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
  position: relative;
}

.content {
  margin-top: 20px;
  position: relative;
  background: rgba(255, 255, 255, 0.9);
  padding: 20px;
  width: 100%;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  margin: 0 auto;
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

.flatpickr {
  border: 2px solid #d1d5db; /* Light gray border for flatpickr */
  border-radius: 0.375rem; /* Rounded corners */
  padding: 0.5rem; /* Padding inside the input */
  width: 14rem; /* Set a fixed width for the flatpickr input */
}

.flatpickr input {
  border: none; /* Remove the default border */
  outline: none; /* Remove the default outline */
}

.label {
  font-size: 1.125rem;
  font-weight: 600;
  margin-bottom: 0.5rem; 
}

.flex {
  display: flex;
}

.space-x-4 {
  margin-right: 1rem;
}

.btn {
  padding: 10px 20px;
  font-size: 16px;
}

.row {
  display: flex;
  justify-content: center;
  align-items: center;
  /* height: 100vh; */
}
</style>
