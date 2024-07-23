<template>
  <form @submit.prevent="PostBooking">
    <!-- {{ selectedRoomId }} -->

    <div class="container">
      <div class="image-gallery">
        <div class="image-item">
          <img src="https://i.pinimg.com/736x/9d/d9/e8/9dd9e8449a07a4e942ace34f86771b16.jpg" alt="Room 1"
            class="zoom" />
        </div>
        <div class="image-item">
          <img src="https://i.pinimg.com/736x/8d/bf/86/8dbf8697536b7fb44e444c52d856f52f.jpg" alt="Room 2"
            class="zoom" />
        </div>
        <div class="image-item">
          <img src="https://i.pinimg.com/736x/d8/0d/8f/d80d8f9aae74097a28f023ba25547d43.jpg" alt="Room 3"
            class="zoom" />
        </div>
      </div>
    </div>
    <div class="contain">
      <div class="row">
        <div class="col-md-6 mb-3 mt-3">
          <label for="numRooms">Number of rooms user booking</label>
          <input type="number" class="form-control" id="numRooms" v-model.number="form.numRooms"
            placeholder="Number Of Rooms" />
          <span v-if="errors.numRooms" class="error">{{ errors.numRooms }}</span>
        </div>
        <div class="col-md-6 mb-3 mt-3">
          <label for="price">Price</label>
          <input type="number" class="form-control" id="price" v-model.number="form.price" placeholder="Price" />
          <span v-if="errors.price" class="error">{{ errors.price }}</span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3 mt-3">
          <label for="user">User ID</label>
          <input type="number" class="form-control" id="user" v-model.number="form.user_id" placeholder="User Id" />
          <span v-if="errors.user_id" class="error">{{ errors.user_id }}</span>
        </div>
        <div class="col-md-6 mb-3 mt-3">
          <label for="room">Room Id</label>
          <input type="text" class="form-control" id="room" v-model.number="form.room_id" placeholder="Room Id" />
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
import { ref, toRefs, watch } from 'vue'
import * as yup from 'yup'
import { useRouter } from 'vue-router'
import axios from 'axios'

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
    default: () => ({ id: null, user_id: null, price: null, name: '' })
  },
  images: {
    type: Array,
    default: () => []
  }
})

const { startDate, endDate, selectedRoomId, images } = toRefs(props)
const router = useRouter()

const form = ref({
  price: selectedRoomId.value.price || '',
  numRooms: '',
  departuredate: startDate.value,
  arrivaldate: endDate.value,
  user_id: selectedRoomId.value.user_id.id || '',
  room_id: selectedRoomId.value.id || ''
})

const errors = ref({})

const schema = yup.object().shape({
  numRooms: yup
    .number()
    .integer()
    .min(1, 'At least one room is required')
    .required('Number of rooms is required'),
  price: yup.number().required('Price is required'),
  user_id: yup.number().required('User ID is required'),
  room_id: yup.number().required('Room name is required')
})

const validateForm = async () => {
  errors.value = {} // Clear previous errors
  try {
    await schema.validate(form.value, { abortEarly: false })
    return true
  } catch (err) {
    if (err.inner) {
      errors.value = err.inner.reduce((acc, error) => {
        acc[error.path] = error.message
        return acc
      }, {})
    }
    return false
  }
}

const PostBooking = async () => {
  const isValid = await validateForm()

  if (isValid) {
    try {
      const payload = {
        price: form.value.price,
        number_of_rooms: form.value.numRooms, // Ensure this matches with what the backend expects
        departure_date: form.value.departuredate,
        arrival_date: form.value.arrivaldate,
        user_id: form.value.user_id,
        room_id: form.value.room_id
      }

      console.log('Payload:', payload)

      const response = await axios.post(
        'http://127.0.0.1:8000/api/booking_user_rooms/create',
        payload
      )

      console.log('Response Status:', response.status)
      console.log('Response Data:', response.data)

      if (response.status === 201) {
        console.log('Booking successful:', response.data)
        router.push({
          name: 'qrCode',
          params: {
            numRooms: form.value.numRooms,
            departuredate: form.value.departuredate,
            arrivaldate: form.value.arrivaldate
          }
        })
      } else {
        throw new Error('Failed to submit the form')
      }
    } catch (error) {
      console.error(
        'Error during booking submission:',
        error.response ? error.response.data : error.message
      )
      // Optionally show error message to user
    }
  } else {
    console.log('Form validation failed')
    // Optionally show validation errors to user
  }
}

const cancelForm = () => { }
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
  background-image: url('https://i.pinimg.com/564x/6a/fd/29/6afd297faea93c71cd076ade13b2b767.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  padding-bottom: 50px;
  position: relative;
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
}

.image-item {
  margin: 0 10px;
}

.image-item img {
  width: 150px;
  height: 150px;
  border-radius: 8px;
  border: 5px solid white;
  transition: transform 0.2s;
}

.image-item img:hover {
  transform: scale(1.1);
}

.contain {
  width: 100%;
  background: rgba(255, 255, 255, 0.9);
  padding: 20px;
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
  padding: 10px 20px;
  font-size: 16px;
}

.row {
  display: flex;
  justify-content: center;
  align-items: center;
}

.col-md-6 {
  margin-bottom: 1rem;
}

.form-control {
  width: 100%;
  padding: 0.375rem 0.75rem;
  border-radius: 0.375rem;
  border: 1px solid #ced4da;
}

label {
  font-size: 1.125rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
}
</style>
