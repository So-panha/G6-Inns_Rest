<template>
  <!-- Container -->
  <div class="flex flex-wrap min-h-screen w-full content-center justify-center bg-gray-200 py-10">
    <!-- Login component -->
    <div class="flex shadow-md">
      <!-- Login form -->
<<<<<<< HEAD
      <div
        class="flex flex-wrap content-center justify-center rounded-l-md bg-white"
        style="width: 24rem; height: 32rem"
      >
=======
      <div class="flex flex-wrap content-center justify-center rounded-l-md bg-white" style="width: 24rem; height: 32rem;">
>>>>>>> Social_login
        <div class="w-72">
          <!-- Heading -->
          <h1 class="text-xl font-semibold">Log in account</h1>
          <small class="text-gray-400">Welcome back! Please enter your details</small>

          <!-- Form -->
          <form class="mt-4" @submit.prevent="onSubmit">
            <div class="mb-3">
              <label class="mb-2 block text-xs font-semibold">Email</label>
<<<<<<< HEAD
              <input
                type="email"
                v-model="email"
                placeholder="Enter your email"
                class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500"
              />
=======
              <input type="email" v-model="email" placeholder="Enter your email" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
>>>>>>> Social_login
              <span class="text-red-600 text-xs">{{ emailError }}</span>
            </div>

            <div class="mb-3">
              <label class="mb-2 block text-xs font-semibold">Password</label>
<<<<<<< HEAD
              <input
                type="password"
                v-model="password"
                placeholder="Enter your password"
                class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500"
              />
=======
              <input type="password" v-model="password" placeholder="*****" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
>>>>>>> Social_login
              <span class="text-red-600 text-xs">{{ passwordError }}</span>
            </div>

            <div class="mb-3 flex flex-wrap content-center">
<<<<<<< HEAD
=======
              <input id="remember" type="checkbox" v-model="rememberMe" class="mr-1 checked:bg-purple-700" /> 
              <label for="remember" class="mr-auto text-xs font-semibold">Remember for 30 days</label>
>>>>>>> Social_login
              <a href="#" class="text-xs font-semibold text-purple-700">Forgot password?</a>
            </div>

            <div class="mb-3">
<<<<<<< HEAD
              <button
                :disabled="isSubmitting"
                class="mb-1.5 block w-full text-center text-white bg-purple-700 hover:bg-purple-900 px-2 py-1.5 rounded-md"
              >
                Sign in
              </button>
              <button
                class="flex flex-wrap justify-center w-full border border-gray-300 hover:border-gray-500 px-2 py-1.5 rounded-md"
              >
                <img
                  class="w-5 mr-2"
                  src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA"
                />
=======
              <button :disabled="isSubmitting" class="mb-1.5 block w-full text-center text-white bg-purple-700 hover:bg-purple-900 px-2 py-1.5 rounded-md">Sign in</button>
              <button class="flex flex-wrap justify-center w-full border border-gray-300 hover:border-gray-500 px-2 py-1.5 rounded-md">
                <img class="w-5 mr-2" src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA">
>>>>>>> Social_login
                Sign in with Google
              </button>
            </div>
          </form>

          <!-- Footer -->
<<<<<<< HEAD
          <div class="text-center flex-grow">
            <span class="text-xs text-gray-400 font-semibold">Don't have an account?</span>
            <router-link
              class="nav-link active inline-flex items-center text-xs font-semibold text-purple-700"
              aria-current="page"
              to="/rigister"
            >
              Register
            </router-link>
=======
          <div class="text-center">
            <span class="text-xs text-gray-400 font-semibold">Don't have account?</span>
            <a href="#" class="text-xs font-semibold text-purple-700">Register account</a>
>>>>>>> Social_login
          </div>
        </div>
      </div>

      <!-- Login banner -->
<<<<<<< HEAD
      <div
        class="flex flex-wrap content-center justify-center rounded-r-md"
        style="width: 24rem; height: 32rem"
      >
        <img
          class="w-full h-full bg-center bg-no-repeat bg-cover rounded-r-md"
          src="https://img.freepik.com/photos-premium/epingle-dessus-carte-qui-dit-epingle_1029974-7295.jpg"
        />
=======
      <div class="flex flex-wrap content-center justify-center rounded-r-md" style="width: 24rem; height: 32rem;">
        <img class="w-full h-full bg-center bg-no-repeat bg-cover rounded-r-md" src="https://img.freepik.com/photos-premium/epingle-dessus-carte-qui-dit-epingle_1029974-7295.jpg">
>>>>>>> Social_login
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import axiosInstance from '@/plugins/axios'
import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'
import { useRouter } from 'vue-router'

const router = useRouter()

const formSchema = yup.object({
  password: yup.string().required().min(8, 'Password must be at least 8 characters').label('Password'),
  email: yup.string().required().email('Must be a valid email').label('Email address')
})

const { handleSubmit, isSubmitting } = useForm({
  initialValues: {
    password: '',
    email: '',
    rememberMe: false
  },
  validationSchema: formSchema
})

const onSubmit = handleSubmit(async (values) => {
  try {
    const { data } = await axiosInstance.post('/login', values)
    if (values.rememberMe) {
      // Set the token with a longer expiration
      localStorage.setItem('access_token', data.access_token)
    } else {
      // Set the token with a session expiration
      sessionStorage.setItem('access_token', data.access_token)
    }
    router.push('/')
  } catch (error) {
    console.warn('Error', error)
  }
})

const { value: password, errorMessage: passwordError } = useField('password')
const { value: email, errorMessage: emailError } = useField('email')
const { value: rememberMe } = useField('rememberMe')
</script>

<style scoped>
.min-h-screen {
  min-height: 100vh;
}
</style>
