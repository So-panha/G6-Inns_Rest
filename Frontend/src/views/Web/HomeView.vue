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
        <span @click="goToTicketNoti" class="material-symbols-outlined mr-6" style="font-size: 40px"> shopping_cart </span>
        <div @click="showProfilePopup = true">
          <img :src="profileImageUrl" class="profile-image rounded-full mr-3 h-10 w-10" />
        </div>
      </div>
    </div>
  </navbar>

  <!-- ----------------------------------pop up ticket notification-------------------------------- -->

  <!-- Home page components -->
  <MapViewVue />
  <ListCardView />

  <!-- Show profile popup -->
  <div v-show="showProfilePopup" class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50">
    <!-- Profile popup content -->
  </div>

  <!-- Show edit profile popup -->
  <div v-show="showEditPopup" class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50">
    <!-- Edit profile popup content -->
  </div>

  <!-- Ticket notification modal -->
  <div v-show="showTicketNotiPopup" class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50 z-50">
      <TicketNotiView @close-popup="closeTicketNotiPopup" />
  </div>

  <FooterView />
</template>

<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue';
import LogoInn from '@/assets/LogoInn.svg';
import MapViewVue from './MapSearch/MapView.vue';
import ListCardView from './Post/ListCardView.vue';
import FooterView from './Post/FooterView.vue';
import TicketNotiView from './TicketNoti/TicketNotiView.vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth-store';

const router = useRouter();
const authStore = useAuthStore();

const showProfilePopup = ref(false);
const showEditPopup = ref(false);
const showTicketNotiPopup = ref(false);
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
    const response = await axios.get('http://127.0.0.1:8000/api/user/show/1'); // Adjust URL and user ID as needed
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

const goToTicketNoti = () => {
  showTicketNotiPopup.value = true;
};

const closeTicketNotiPopup = () => {
  showTicketNotiPopup.value = false;
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

.btn-upload {
  background: #8706ff;
  color: white;
}

.btn-purple {
  background: #ab2cff;
  color: white;
}

.text-edit {
  color: #8f06ff;
}

.popup2 {
  border: 3px solid rgb(199, 13, 255);
}
</style>
