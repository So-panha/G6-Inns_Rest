<template>
  <Navbar :profileImageUrl="profileImageUrl" @toggleProfilePopup="toggleProfilePopup"
    @toggleTicketNotiPopup="toggleTicketNotiPopup" />
  <MapViewVue />
    <ProfilePopup
    v-if="showProfilePopup"
    :showProfilePopup="showProfilePopup"
    :tempInputs="inputs"
    @toggleProfilePopup="toggleProfilePopup"
    @toggleEditPopup="toggleEditPopup"
    @updateProfile="updateProfile"
  />
  <EditProfilePopup
    v-show="showEditPopup"
    :tempInputs="tempInputs"
    @saveChanges="saveChanges"
    @closeEditPopup="closeEditPopup"
  />
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

const toggleProfilePopup = () => {
  showProfilePopup.value = !showProfilePopup.value
}


const closeEditPopup = () => {
  showEditPopup.value = false
  showProfilePopup.value = true // Show profile popup after closing edit popup
}

const saveChanges = (updatedInputs: any) => {
  // Update profile data
  Object.assign(inputs, updatedInputs)
  closeEditPopup() // Close edit popup and show profile popup
}

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
</script>
