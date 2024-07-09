<template>
  <navbar class="flex justify-between px-20 py-3 bg-white">
    <div class="flex items-start space-x-1">
      <img :src="LogoInn" alt="LogoInn Logo" class="h-20" />
    </div>
    <div class="flex">
      <div class="mt-3 mr-10">
        <h6>Ready to book?</h6>
        <h6>Find your rest house here</h6>
      </div>
      <div class="flex mt-3">
        <router-link to="/ticketNoti"><span class="material-symbols-outlined mr-6" style="font-size: 40px"> shopping_cart </span></router-link>
        <div @click="showProfilePopup = true">
          <img :src="profileImageUrl" class="profile-image rounded-full mr-3 h-10 w-10" />
        </div>
      </div>
    </div>
  </navbar>
  <!--------------------------------Maps Views-------------------------- -->
  <MapViewVue />
  <!-- List card guesthouse------------------------------------------------ -->
  <ListCardView />
  <!-- ShowPopup1 for show info profile ------------------------------------->
   <div v-show="showProfilePopup" class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50">
    <div class="bg-white p-5 rounded-sm shadow-sm relative w-1/2 max-w-2xl">
      <button @click="openEditPopup" class="absolute btn btn-purple top-4 right-2">
        <span class="material-symbols-outlined"> edit_square </span>
      </button>
      <div class="absolute flex top-4 left-2">
        <button @click="closeProfilePopup" type="button" class="btn btn-outline-dark">
          <span class="material-symbols-outlined"> arrow_back </span>
        </button>
        <h5 class="mt-2 ml-2">Info</h5>
      </div>
      <div class="text-center">
        <img class="profile-image w-30 h-30 mx-auto rounded-full" :src="profileImageUrl" />
        <h3 class="mt-4">{{ inputs.name }}</h3>
      </div>
      <div class="mt-4">
        <div class="flex items-center mb-4">
          <span class="material-symbols-outlined mr-10 ml-20" style="font-size: 40px">
            account_circle
          </span>
          <h5>Name:</h5>
          <h6 class="ml-30">{{ inputs.name }}</h6>
        </div>
        <div class="flex items-center mb-4">
          <span class="material-symbols-outlined mr-10 ml-20" style="font-size: 40px"> call </span>
          <h5>Phone:</h5>
          <h6 class="ml-30">{{ inputs.phoneNumber }}</h6>
        </div>
        <div class="flex items-center mb-4">
          <span class="material-symbols-outlined mr-10 ml-20" style="font-size: 40px"> mark_email_unread </span>
          <h5 class="mt-2">Email:</h5>
          <h6 class="ml-30">{{ inputs.email }}</h6>
        </div>
      </div>
      <div class="mt-4 flex justify-end">
        <button @click="logout" class="btn btn-info mr-2" data-ripple-light="true" id="logout">
          Logout
        </button>
        <button @click="closeProfilePopup" class="btn btn-danger text-white px-4 py-2 rounded">
          Close
        </button>
      </div>
    </div>
  </div>


  <!-- ShowPopup2 for editing profile -->
  <div v-show="showEditPopup" class=" fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50">
    <div class="popup2 bg-white p-10 rounded-sm shadow-sm relative w-1/2 max-w-2xl">
      <div class="absolute flex top-4 left-2">
        <h3 class="mt-2 ml-10 text-edit">Edit Profile***</h3>
      </div>
      <div class="text-center mt-5">
        <img class="profile-image w-30 h-30 mx-auto rounded-full" :src="profileImageUrl" />
      </div>
      <div class="absolute top-43 right-68">
        <button
          class="btn btn-upload btn-sm"
          @click="triggerFileInput"
          data-toggle="tooltip"
          data-placement="bottom"
          title="Edit Profile"
        >
          <span class="material-symbols-outlined" style="font-size: 15px"> add_circle </span>
        </button>
        <input type="file" ref="fileInputRef" @change="handleFileChange" class="hidden" />
      </div>
      <div class="mt-4">
        <div class="flex items-center mb-2">
          <span class="material-symbols-outlined mr-2 ml-3" style="font-size: 30px">
            account_circle
          </span>
          <h6>Name:</h6>
        </div>
        <div class="input-group mb-2">
          <input
            type="text"
            class="form-control ml-3 mt-2"
            placeholder="Enter your name"
            aria-label="name"
            aria-describedby="basic-addon1"
            v-model="tempInputs.name"
          />
        </div>
        <div class="flex items-center">
          <span class="material-symbols-outlined mr-2 ml-3" style="font-size: 30px"> call </span>
          <h6>Phone:</h6>
        </div>
        <div class="input-group mb-2">
          <input
            type="text"
            class="form-control ml-3 mt-2"
            placeholder="Enter your phone number"
            aria-label="number phone"
            v-model="tempInputs.phoneNumber"
          />
        </div>
        <div class="flex items-center mb-2">
          <span class="material-symbols-outlined mr-2 ml-3" style="font-size: 30px"> mark_email_unread </span>
          <h6 class="mt-2">Email:</h6>
        </div>
        <div class="input-group">
          <input
            type="text"
            class="form-control ml-3 mt-2"
            placeholder="Enter your email"
            aria-label="email"
            aria-describedby="basic-addon1"
            v-model="tempInputs.email"
          />
        </div>
      </div>
      <div class="mt-4 flex justify-end">
        <button @click="saveChanges" class="btn btn-primary text-white px-4 py-2 rounded mr-3">
          Save
        </button>
        <button @click="closeEditPopup" class="btn btn-danger text-white px-4 py-2 rounded">
          Cancel
        </button>
      </div>
    </div>
  </div>

  <FooterView />
</template>



<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue';
import LogoInn from '@/assets/LogoInn.svg';
import MapViewVue from './MapSearch/MapView.vue';
import ListCardView from './Post/ListCardView.vue';
import FooterView from './Post/FooterView.vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth-store';

const router = useRouter();
const authStore = useAuthStore();

const showProfilePopup = ref(false);
const showEditPopup = ref(false);
const fileInputRef = ref<HTMLInputElement | null>(null);
const profileImageUrl = ref<string>(''); // Initialize profile image URL

const inputs = reactive({
  name: '',
  email: '',
  phoneNumber: '',
  profile: '',
  
});

const tempInputs = reactive({
  name: '',
  email: '',
  phoneNumber: '',
  profile: '',

 
});

const getUserProfile = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/user/show/1}'); // Adjust URL and user ID as needed
    profileImageUrl.value = `http://127.0.0.1:8000/storage/${response.data.user.profile}`;
    Object.assign(inputs, response.data.user);
  } catch (error) {
    console.error('Error fetching user data:', error);
  }
};


const updateUser = async () => {
  const formData = new FormData();
  formData.append('_method', 'PUT');
  formData.append('name', tempInputs.name);
  formData.append('email', tempInputs.email);
  formData.append('phoneNumber', tempInputs.phoneNumber);
  if (fileInputRef.value && fileInputRef.value.files && fileInputRef.value.files[0]) {
    formData.append('profile', fileInputRef.value.files[0]);
  }

  try {
    const response = await axios.post('http://127.0.0.1:8000/api/user/update/1', formData, {
      headers: { 'Content-Type': 'multipart/form-data' },
    });
    console.log(response.data.message);
    await getUserProfile(); // Update profile data after saving changes
    closeEditPopup();
  } catch (error) {
    console.error('Error updating user:', error);
  }
};

const logout = () => {
  localStorage.removeItem('access_token');
  router.push('/login');
};

const openEditPopup = () => {
  // Copy current inputs to tempInputs for editing
  Object.assign(tempInputs, inputs);
  showEditPopup.value = true;
};

const closeProfilePopup = () => {
  showProfilePopup.value = false;
};

const closeEditPopup = () => {
  showEditPopup.value = false;
};

const triggerFileInput = () => {
  fileInputRef.value?.click();
};

const handleFileChange = (event: Event) => {
  const target = event.target as HTMLInputElement;
  if (target.files) {
    const file = target.files[0];
    if (file) {
      // Handle file selection (optional)
    }
  }
};

const saveChanges = () => {
  updateUser();
};

// Fetch initial user profile data on component mount
onMounted(() => {
  getUserProfile();
});
</script>

<style scoped>
/* Your scoped styles */

.profile-image {
  border: 2px solid rgb(238, 40, 228);
  border-radius: 50%;
}
.btn-upload{
  background: #8706ff;
  color: white;
}
.btn-purple{
   background: #ab2cff;
  color: white;
}
.text-edit{
  color: #8f06ff;
}
.popup2{
  border: 3px solid rgb(199, 13, 255);

}
</style>
