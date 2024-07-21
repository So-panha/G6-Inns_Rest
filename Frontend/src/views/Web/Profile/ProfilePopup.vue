<template>
  <div v-show="showProfilePopup" class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50">
    <div class="bg-white p-5 rounded-sm shadow-sm relative w-1/2 max-w-2xl" id="contant">
      <button @click="showEditPopup" class="absolute btn btn-purple top-4 right-2">
        <span class="material-symbols-outlined" id="edit"> edit_square </span>
      </button>
      <div class="absolute flex top-4 left-2">
        <span @click="closeProfilePopup" class="material-symbols-outlined ml-1" id="arrow"> arrow_back </span>
      </div>
      <div class="text-center">
        <img class="profile-image w-30 h-30 mx-auto rounded-full" :src="getImage(tempInputs.profile)" />
        <h3 class="mt-4 font-bold">{{ tempInputs.name }}</h3>
      </div>
      <div class="mt-4">
        <div class="flex items-center mb-4">
          <span class="material-symbols-outlined mr-10 ml-20 icon" style="font-size: 30px">
            account_circle
          </span>
          <h5>Name:</h5>
          <h6 class="ml-30">{{ tempInputs.name }}</h6>
        </div>
        <div class="flex items-center mb-4">
          <span class="material-symbols-outlined mr-10 ml-20 icon" style="font-size: 30px"> call </span>
          <h5>Phone:</h5>
          <h6 class="ml-30">{{ tempInputs.phoneNumber }}</h6>
        </div>
        <div class="flex items-center mb-4">
          <span class="material-symbols-outlined mr-10 ml-20 icon" style="font-size: 30px">
            mark_email_unread
          </span>
          <h5 class="mt-2">Email:</h5>
          <h6 class="ml-30">{{ tempInputs.email }}</h6>
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
</template>

<script setup lang="ts">
import { defineProps, defineEmits, onMounted, ref, computed } from 'vue';
import axios from 'axios';

import { useAuthStore } from '../../../stores/auth-store.ts';

// Get the auth store to manage user data
const authStore = useAuthStore();

interface ProfileData {
  name: string;
  phoneNumber: string;
  email: string;
  profile: string;
}

const props = defineProps<{
  showProfilePopup: boolean;
  tempInputs: ProfileData;
}>();

const emit = defineEmits<{
  (event: 'toggleEditPopup'): void;
  (event: 'toggleProfilePopup'): void;
}>();
// please make it get id denimic make it can 

const tempInputs = ref<ProfileData>({
  name: '',
  phoneNumber: '',
  email: '',
  profile: '',
});

const showProfilePopup = () => {
  emit('toggleProfilePopup');
};
const showEditPopup = () => {
  emit('toggleEditPopup');
};

const closeProfilePopup = () => {
  emit('toggleProfilePopup');

};

const getImage = (profile: string) => {
  return `http://127.0.0.1:8000/storage/${profile}`;
};

const fetchUserData = async () => {

  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/user/show/${authStore.user.id}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('access_token')}`,
      },
    });
    // Update tempInputs with response data
    Object.assign(tempInputs.value, response.data.user);
  } catch (error) {
    console.error('Error fetching user data:', error);
  }
};



const logout = () => {
  localStorage.removeItem('access_token');
  emit('toggleProfilePopup');
  window.location.href = '/';
};

// Fetch user data when component is mounted
onMounted(() => {
  fetchUserData();
});
</script>

<style scoped>
.profile-image {
  border: 2px solid rgb(238, 40, 228);
  border-radius: 50%;
}


@media screen and (min-width: 768px) and (max-width: 1024px) {
  .popup-content {
    width: 100%;
  }

  #contant {
    height: 60%;
    width: 70%;
  }

  .icon {
    font-size: 25px;
    margin-left: 12px;
  }

  .btn {
    padding: 6px 8px;
    font-size: 15px;
  }

  .profile-image {
    width: 150px;
    height: 150px;
  }

  h5 {
    font-size: 1.25rem;
  }

  h6 {
    font-size: 1rem;
  }

  .ml-20 {
    margin-left: 5%;
  }
}

@media screen and (max-width: 767px) {
  .popup-content {
    width: 95%;
  }

  .icon {
    margin-left: 5px;
    display: none;
    
  }
  .btn {
    padding: 2px 5px;
    font-size: 10px;
  }

  .profile-image {
    width: 80px;
    height: 80px;
  }

  .absolute.btn {
    top: 4px;
    right: 4px;
  }

  .absolute.flex {
    top: 4px;
    left: 4px;
  }

  h5 {
    font-size: 1rem;
  }

  h6 {
    font-size: 0.95rem;
  }

  #contant {
    height: 60%;
    width: 85%;
  }
  #edit {
    margin-top: 5px;
  }

  #arrow {
    margin-top: 5px;
  }
  .justify-end{
    justify-content: center;
  }
  .mb-4{
    margin-left: 15%;
  }
  .ml-30{
    margin-left: 30%;
  }
}
</style>
