<template>
  <form @submit.prevent="PostBooking">
    <div class="container">
      <div class="image-gallery">
        <div class="image-item" v-for="(image, index) in images" :key="index">
          <img :src="image.url" :alt="'Room ' + (index + 1)" class="zoom" />
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
          <label for="price_per_room">Price per Room</label>
          <input type="number" class="form-control" id="price_per_room" v-model.number="form.price" placeholder="Price"
            readonly />
          <span v-if="errors.price" class="error">{{ errors.price }}</span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3 mt-3">
          <label for="user">User Name</label>
          <input type="text" class="form-control" id="user" v-model="form.user_name" placeholder="User Name" readonly />
          <span v-if="errors.user_name" class="error">{{ errors.user_name }}</span>
        </div>
        <div class="col-md-6 mb-3 mt-3">
          <label for="room">Room Name</label>
          <input type="text" class="form-control" id="room" v-model="form.room_name" placeholder="Room Name" readonly />
          <span v-if="errors.room_name" class="error">{{ errors.room_name }}</span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3 mt-3">
          <label for="totalPrice">Total Price</label>
          <input type="text" class="form-control" id="totalPrice" :value="totalPrice" readonly />
        </div>
        <div class="col-md-6 mb-3 mt-3">
          <label for="daysBetween">Number of the day</label>
          <input type="text" class="form-control" id="daysBetween" :value="daysBetween" readonly />
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
import { ref, toRefs, computed, onMounted } from 'vue'
import * as yup from 'yup'
import { useRouter } from 'vue-router'
import axios from 'axios'
import { useAuthStore } from '../../../stores/auth-store.ts'

const authStore = useAuthStore()
const router = useRouter()

const props = defineProps({
  startDate: {
    type: String,
    default: null
  },
  endDate: {
    type: String,
    default: null
  },
  daysBetween: {
    type: Number,
    default: 0
  },
  selectedRoomId: {
    type: Object,
    default: () => ({ id: null, price: null, name: '', user_id: { id: null } })
  },
  images: {
    type: Array,
    default: () => [
      { url: 'https://i.pinimg.com/736x/9d/d9/e8/9dd9e8449a07a4e942ace34f86771b16.jpg' },
      { url: 'https://i.pinimg.com/736x/8d/bf/86/8dbf8697536b7fb44e444c52d856f52f.jpg' },
      { url: 'https://i.pinimg.com/736x/d8/0d/8f/d80d8f9aae74097a28f023ba25547d43.jpg' }
    ]
  }
})

const { startDate, endDate, selectedRoomId, images } = toRefs(props)

const form = ref({
  price: selectedRoomId.value.price || '',
  numRooms: '',
  departuredate: '', // Will be set in onMounted
  arrivaldate: '', // Will be set in onMounted
  paymented: '', // Set paymented to be totalPrice initially
  user_name: authStore.user.name || '', // Set user_name from authStore
  room_name: selectedRoomId.value.name || '',
  user_id: authStore.user.id || '', // Set user_name from authStore
  room_id: selectedRoomId.value.id || '',
  create_by_id: selectedRoomId.value.user_id.id
})

const errors = ref({})

const schema = yup.object().shape({
  numRooms: yup
    .number()
    .integer()
    .min(1, 'At least one room is required')
    .required('Number of rooms is required'),
  price: yup.number().required('Price is required'),
  user_name: yup.string().required('User Name is required'),
  room_name: yup.string().required('Room Name is required'),
  create_by_id: yup.number().required('User ID is required')
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
      // Ensure totalPrice is computed
      const payload = {
        number_of_rooms: Number(form.value.numRooms), // Ensure this is a number
        departure_date: form.value.departuredate, // Ensure format is YYYY-MM-DD
        arrival_date: form.value.arrivaldate, // Ensure format is YYYY-MM-DD
        paymented: Number(totalPrice.value), // Ensure this is a number
        user_id: form.value.user_id, // Should be a number
        room_id: form.value.room_id, // Should be a number
        create_by_id: form.value.create_by_id // Should be a number
      }

      console.log('Payload:', payload)

      const response = await axios.post(
        'http://127.0.0.1:8000/api/booking_user_rooms/create',
        payload,
        {
          headers: {
            'Content-Type': 'application/json'
          }
        }
      )

      if (response.status === 200) {
        console.log('Booking successful:', response.data)
        router.push({ name: 'qrCode', params: { id: form.value.create_by_id, roomId: form.value.room_id } })
      } else {
        throw new Error('Failed to submit the form')
      }
    } catch (error) {
      if (error.response) {
        console.error('Error Response:', error.response.data)
        console.error('Error Status:', error.response.status)
        console.error('Error Headers:', error.response.headers)
      } else if (error.request) {
        console.error('Error Request:', error.request)
      } else {
        console.error('Error Message:', error.message)
      }
      console.error('Error Config:', error.config)
    }
  } else {
    console.log('Form validation failed')
  }
}

const cancelForm = () => {
  // Reset form values and clear errors
  form.value = {
    price: selectedRoomId.value.price || '',
    numRooms: '',
    departuredate: startDate.value,
    arrivaldate: endDate.value,
    paymented: totalPrice.value,
    user_name: authStore.user.name || '', // Reset user_name from authStore
    room_name: selectedRoomId.value.name || '',
    create_by_id: selectedRoomId.value.user_id.id
  }
  errors.value = {}
}

const totalPrice = computed(() => {
  // Ensure numeric calculations
  const numRooms = Number(form.value.numRooms) || 0
  const price = Number(form.value.price) || 0
  const days = Number(props.daysBetween) || 0

  // Calculate the total price
  const calculatedTotalPrice = numRooms * price * days

  // Return price if the calculated total is 0
  return calculatedTotalPrice === 0 ? price : calculatedTotalPrice
})

onMounted(() => {
  // Set today's date and tomorrow's date
  const today = new Date()
  const tomorrow = new Date(today)
  tomorrow.setDate(today.getDate() + 1)

  form.value.departuredate = today.toISOString().split('T')[0] // Format YYYY-MM-DD
  form.value.arrivaldate = tomorrow.toISOString().split('T')[0] // Format YYYY-MM-DD
})

const getUserProfile = async () => {
  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/user/show/${authStore.user.id}`)
    // Use response data if needed
  } catch (error) {
    console.error('Error fetching user data:', error)
  }
}
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
