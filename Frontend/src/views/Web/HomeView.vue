<template>
  <Navbar :profileImageUrl="profileImageUrl" @toggleProfilePopup="toggleProfilePopup" />
  <MapViewVue />
  <ListCardView />
  <!-- <ProfilePopup /> -->
  <ProfilePopup
    v-if="showProfilePopup"
    :showProfilePopup="showProfilePopup"
    :profileImageUrl="profileImageUrl"
    :inputs="inputs"
    @toggleProfilePopup="toggleProfilePopup"
    @toggleEditPopup="toggleEditPopup"
  />
  <!-- <EditProfilePopup /> -->
  <EditProfilePopup
    v-show="showEditPopup"
    :profileImageUrl="profileImageUrl"
    :tempInputs="tempInputs"
    @closeEditPopup="closeEditPopup"
    @saveChanges="saveChanges"
  />
  <FooterView />
  <!-- {{authStore}} -->
</template>

<script setup lang="ts">
import Navbar from './Post/Navbar.vue'
import MapViewVue from './MapSearch/MapView.vue'
import ListCardView from './Post/ListCardView.vue'
import ProfilePopup from './Profile/ProfilePopup.vue'
import EditProfilePopup from './Profile/EditProfilePopup.vue'
import FooterView from './Post/FooterView.vue'
import { ref, reactive, onMounted } from 'vue'
import axiosInstance from '@/plugins/axios'
import { useRouter } from 'vue-router'

const profileImageUrl = ref<string>('')
const showProfilePopup = ref(false)
const router = useRouter()
const showEditPopup = ref(false)
const fileInputRef = ref<HTMLInputElement | null>(null)

const toggleProfilePopup = () => {
  showProfilePopup.value = !showProfilePopup.value
}

const toggleEditPopup = () => {
  showEditPopup.value = true
  showProfilePopup.value = false
}

setTimeout(() => {
  profileImageUrl.value = 'https://example.com/profile-image.jpg'
}, 1000) // Simulating delay in fetching profile image URL

const inputs = reactive({
  name: '',
  email: '',
  phoneNumber: '',
  profile: ''
})

const tempInputs = reactive({
  name: '',
  email: '',
  phoneNumber: '',
  profile: ''
})

const updateUser = async () => {
  const formData = new FormData()
  formData.append('_method', 'PUT')
  formData.append('name', tempInputs.name)
  formData.append('email', tempInputs.email)
  formData.append('phoneNumber', tempInputs.phoneNumber)
  if (fileInputRef.value && fileInputRef.value.files && fileInputRef.value.files[0]) {
    formData.append('profile', fileInputRef.value.files[0])
  }
}

const closeEditPopup = () => {
  showEditPopup.value = false
}

const saveChanges = (updatedInputs: any) => {
  inputs.name = updatedInputs.name
  inputs.email = updatedInputs.email
  inputs.phoneNumber = updatedInputs.phoneNumber

  // Close the edit popup
  closeEditPopup()
}
</script>
