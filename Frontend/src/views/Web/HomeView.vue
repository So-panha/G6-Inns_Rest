<template>
  <Navbar :profileImageUrl="profileImageUrl" @toggleProfilePopup="toggleProfilePopup"
    @toggleTicketNotiPopup="toggleTicketNotiPopup" />
  <MapViewVue />
  <ProfilePopup v-if="showProfilePopup" :showProfilePopup="showProfilePopup" :profileImageUrl="profileImageUrl"
    :inputs="inputs" @toggleProfilePopup="toggleProfilePopup" @toggleEditPopup="toggleEditPopup" />
  <EditProfilePopup v-show="showEditPopup" :profileImageUrl="profileImageUrl" :tempInputs="tempInputs"
    @closeEditPopup="closeEditPopup" @saveChanges="saveChanges" />
  <TicketNotiPopup v-show="showTicketNotiPopup" @close-popup="closeTicketNotiPopup"  />

  <FooterView />
</template>

<script setup lang="ts">
import Navbar from './Post/Navbar.vue'
import MapViewVue from './MapSearch/MapView.vue'
import ProfilePopup from './Profile/ProfilePopup.vue'
import EditProfilePopup from './Profile/EditProfilePopup.vue'
import TicketNotiPopup from './TicketNoti/TicketNotiView.vue'
import FooterView from './Post/FooterView.vue'
import { ref, reactive } from 'vue'

const profileImageUrl = ref<string>('')
const showProfilePopup = ref(false)
const showEditPopup = ref(false)
const showTicketNotiPopup = ref(false)

const toggleProfilePopup = () => {
  showProfilePopup.value = !showProfilePopup.value
}

const toggleEditPopup = () => {
  showEditPopup.value = true
  showProfilePopup.value = false
}

const toggleTicketNotiPopup = () => {
  showTicketNotiPopup.value = !showTicketNotiPopup.value
}

const closeTicketNotiPopup = () => {
  showTicketNotiPopup.value = false
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
