<template>
  <div
    class="flex bg-white rounded-lg shadow-2xl border-4 border-gray-200 overflow-hidden mx-auto max-w-sm lg:max-w-4xl mt-5"
  >
    <div class="w-full p-8 lg:w-1/2">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Register Your Account</h2>
      <form @submit.prevent="register">
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="username">Username</label>
          <input
            v-model="users.name"
            :class="{ 'border-red-500': shouldMarkError('name') }"
            class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border-2 border-gray-300 rounded py-2 px-4 block w-full"
            id="username"
            type="text"
            placeholder="Enter your username"
          />
          <span v-if="shouldMarkError('name')" class="text-red-500 text-sm">{{ errors.name }}</span>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="email">Email Address</label>
          <input
            v-model="users.email"
            :class="{ 'border-red-500': shouldMarkError('email') }"
            class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border-2 border-gray-300 rounded py-2 px-4 block w-full"
            id="email"
            type="email"
            placeholder="Enter your email address"
          />
          <span v-if="shouldMarkError('email')" class="text-red-500 text-sm">{{
            errors.email
          }}</span>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="password">Password</label>
          <input
            v-model="users.password"
            :class="{ 'border-red-500': shouldMarkError('password') }"
            class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border-2 border-gray-300 rounded py-2 px-4 block w-full"
            id="password"
            type="password"
            placeholder="Enter your password"
          />
          <span v-if="shouldMarkError('password')" class="text-red-500 text-sm">{{
            errors.password
          }}</span>
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 font-bold mb-2" for="phone">Phone Number</label>
          <input
            v-model="users.phoneNumber"
            :class="{ 'border-red-500': shouldMarkError('phoneNumber') }"
            class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border-2 border-gray-300 rounded py-2 px-4 block w-full"
            id="phone"
            type="tel"
            placeholder="Enter your phone number"
          />
          <span v-if="shouldMarkError('phoneNumber')" class="text-red-500 text-sm">{{
            errors.phoneNumber
          }}</span>
        </div>
        <div class="mb-6">
          <button
            type="submit"
            class="bg-gray-800 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-700"
          >
            Register
          </button>
        </div>
        <div class="flex items-center justify-between">
          <div class="border-b border-2 border-gray-300 flex-grow"></div>
          <span class="text-sm text-gray-600 mx-4">Already have an account?</span>
          <router-link class="text-sm text-gray-600 hover:text-gray-800 font-bold ext-xs font-semibold text-purple-700" to="/login"
            >Sign in</router-link
          >
          <div class="border-b border-2 border-gray-300 flex-grow"></div>
        </div>
      </form>
    </div>
    <div
      class="hidden lg:block lg:w-1/2 bg-cover"
      style="
        background-image: url('https://img.freepik.com/premium-photo/smartphone-with-map-3d-map-pin-checking-points_172976-5319.jpg');
      "
    ></div>
  </div>
</template>

<script>
import * as Yup from 'yup'
import axios from 'axios'

export default {
  data() {
    return {
      users: {
        name: '',
        email: '',
        password: '',
        phoneNumber: ''
      },
      errors: {}
    }
  },
  methods: {
    async register() {
      try {
        const schema = Yup.object().shape({
          name: Yup.string().required('Username is required.'),
          email: Yup.string()
            .email('Please enter a valid email address.')
            .required('Email is required.'),
          password: Yup.string()
            .min(6, 'Password must be at least 6 characters long.')
            .required('Password is required.'),
          phoneNumber: Yup.string().required('Phone number is required.')
        })

        await schema.validate(this.users, { abortEarly: false })

        // If validation succeeds, proceed with registration
        const response = await axios.post('http://127.0.0.1:8000/api/rigister', {
          name: this.users.name,
          email: this.users.email,
          password: this.users.password,
          phoneNumber: this.users.phoneNumber
        })

        console.log(response.data)
        this.$router.push('/login')
      } catch (error) {
        if (error instanceof Yup.ValidationError) {
          let yupErrors = {}
          error.inner.forEach((e) => {
            yupErrors[e.path] = e.message
          })
          this.errors = yupErrors
        } else {
          console.error(error)
        }
      }
    },
    shouldMarkError(field) {
      return this.errors.hasOwnProperty(field)
    }
  }
}
</script>

<style>
/* Add any custom styles here */
</style>
