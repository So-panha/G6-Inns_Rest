

<template>
  <div
    v-show="showEditPopup"
    class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50"
  >
    <div class="popup2 bg-white p-10 rounded-sm shadow-sm relative w-1/2 max-w-2xl">
      <div class="absolute flex top-4 left-2">
        <h3 class="mt-2 ml-10 text-edit">Edit Profile</h3>
      </div>
      <div class="text-center mt-5">
        <!-- Display the user's profile image -->
        <img class="profile-image w-30 h-30 mx-auto rounded-full" :src="profileImageUrl" />
      </div>
      <div class="absolute top-43 right-68">
        <!-- Button to upload a new profile image -->
        <button class="btn btn-upload btn-sm" @click="triggerFileInput" title="Edit Profile">
          <span class="material-symbols-outlined" style="font-size: 15px"> add_circle </span>
        </button>
        <input type="file" ref="fileInputRef" @change="handleFileChange" class="hidden" />
      </div>
      <div class="mt-4">
        <!-- Input for the user's name -->
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
            v-model="tempInputs.name"
          />
        </div>
        <!-- Input for the user's phone number -->
        <div class="flex items-center">
          <span class="material-symbols-outlined mr-2 ml-3" style="font-size: 30px"> call </span>
          <h6>Phone:</h6>
        </div>
        <div class="input-group mb-2">
          <input
            type="text"
            class="form-control ml-3 mt-2"
            placeholder="Enter your phone number"
            v-model="tempInputs.phoneNumber"
          />
        </div>
        <!-- Input for the user's email -->
        <div class="flex items-center mb-2">
          <span class="material-symbols-outlined mr-2 ml-3" style="font-size: 30px">
            mark_email_unread
          </span>
          <h6 class="mt-2">Email:</h6>
        </div>
        <div class="input-group">
          <input
            type="text"
            class="form-control ml-3 mt-2"
            placeholder="Enter your email"
            v-model="tempInputs.email"
          />
        </div>
      </div>
      <div class="mt-4 flex justify-end">
        <!-- Button to save changes -->
        <button @click="saveChanges" class="btn btn-primary text-white px-4 py-2 rounded mr-3">
          Save
        </button>
        <!-- Button to cancel editing -->
        <button @click="closeEditPopup" class="btn btn-danger text-white px-4 py-2 rounded">
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import axios from 'axios';
import { ref, reactive, onMounted, defineEmits } from 'vue';
import { useAuthStore } from '../../../stores/auth-store.ts';

// Get the auth store to manage user data
const authStore = useAuthStore();

// Define reactive variables for the component
const showEditPopup = ref(false); // Controls visibility of the edit popup
const profileImageUrl = ref<string>(''); // Holds the URL of the profile image

const tempInputs = reactive({
  name: '',
  email: '',
  phoneNumber: '',
  profile: '',
});

// Define the expected props for the component
const props = defineProps<{
  tempInputs: {
    name: string;
    phoneNumber: string;
    email: string;
    profile: string;
  };
  showEditPopup: boolean;
}>();

// Define emitted events from the component
const emit = defineEmits<{
  (event: 'saveChanges', updatedInputs: typeof props.tempInputs): void;
  (event: 'closeEditPopup'): void;
}>();

const fileInputRef = ref<HTMLInputElement | null>(null); // Reference to the file input


// Lifecycle hook to set initial data when component is mounted
onMounted(() => {
  const savedProfileData = localStorage.getItem('profileData'); // Check local storage for saved data
  if (savedProfileData) {
    const parsedData = JSON.parse(savedProfileData);
    // Populate the tempInputs with user data from auth store
    tempInputs.name = authStore.user.name;
    tempInputs.email = authStore.user.email;
    tempInputs.phoneNumber = authStore.user.phoneNumber;
    profileImageUrl.value = `http://127.0.0.1:8000/storage/${authStore.user.profile}`; // Set profile image URL
  } else {
    // Fallback to auth store data
    tempInputs.name = authStore.user.name;
    tempInputs.email = authStore.user.email;
    tempInputs.phoneNumber = authStore.user.phoneNumber;
    profileImageUrl.value = `http://127.0.0.1:8000/storage/${authStore.user.profile}`; // Set profile image URL
  }
});

// Handle file input change event to update profile image preview
const handleFileChange = (event: Event) => {
  const target = event.target as HTMLInputElement;
  if (target.files) {
    const file = target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        if (e.target && typeof e.target.result === 'string') {
          profileImageUrl.value = e.target.result; // Update profile image URL with selected file
        }
      };
      reader.readAsDataURL(file); // Read file as Data URL
    }
  }
};

// Trigger the file input click
const triggerFileInput = () => {
  fileInputRef.value?.click();
};

// Emit an event to close the edit popup
const closeEditPopup = () => {
  emit('closeEditPopup');
};

// Function to update the user profile
const updateUser = async () => {
  const formData = new FormData();
  formData.append('_method', 'PUT'); // Method override for PUT request
  formData.append('name', tempInputs.name);
  formData.append('email', tempInputs.email);
  formData.append('phoneNumber', tempInputs.phoneNumber);
  
  // Add profile image to form data if available
  if (fileInputRef.value && fileInputRef.value.files && fileInputRef.value.files[0]) {
    formData.append('profile', fileInputRef.value.files[0]);
  }
  
  try {
    const response = await axios.post(
      `http://127.0.0.1:8000/api/user/update/${authStore.user.id}`, // API endpoint for updating user
      formData,
      {
        headers: {
          'Content-Type': 'multipart/form-data', // Set content type for form data
          Authorization: `Bearer ${localStorage.getItem('access_token')}` // Authorization token
        }
      }
    );
    const updatedUser = response.data.user; // Get updated user data from response
    // Update auth store with new user data
    authStore.user.name = updatedUser.name;
    authStore.user.email = updatedUser.email;
    authStore.user.phoneNumber = updatedUser.phoneNumber;
    authStore.user.profile = updatedUser.profile;
    profileImageUrl.value = `http://127.0.0.1:8000/storage/${updatedUser.profile}`; // Update profile image URL
    emit(updatedUser); // Emit the updated user data
  } catch (error) {
    console.error('Error updating user:', error); // Log any errors
  }
};

// Function to save changes made in the edit popup
const saveChanges = async () => {
  await updateUser(); // Call function to update user
  emit('saveChanges', { ...props.tempInputs }); // Emit the updated profile data
  closeEditPopup(); // Close the popup
};
</script>

<style scoped>
.profile-image {
  border: 2px solid rgb(238, 40, 228); /* Style for the profile image */
  border-radius: 50%; /* Make the image circular */
}
.btn-upload {
  background: #8706ff; /* Style for the upload button */
  color: white; /* Text color for the button */
}
.text-edit {
  color: #8f06ff; /* Color for the edit text */
}
.popup2 {
  border: 3px solid rgb(199, 13, 255); /* Border style for the popup */
}
</style>

