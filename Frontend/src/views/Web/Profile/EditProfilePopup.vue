<template>
  <div
    v-show="showEditPopup"
    class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50"
  >
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
</template>

<script setup lang="ts">
import { ref, reactive, defineEmits } from 'vue'

const emit = defineEmits(['closeEditPopup'])

const showEditPopup = ref(false)
const profileImageUrl = ref<string>('')

const tempInputs = reactive({
  name: '',
  email: '',
  phoneNumber: ''
})

const handleFileChange = (event: Event) => {
  const target = event.target as HTMLInputElement
  if (target.files) {
    const file = target.files[0]
    if (file) {
      const reader = new FileReader()
      reader.onload = (e: any) => {
        profileImageUrl.value = e.target.result as string
      }
      reader.readAsDataURL(file)
    }
  }
}

const closeEditPopup = () => {
  emit('closeEditPopup')
}

const saveChanges = () => {
  // Simulate updating user profile (replace with your actual logic)
  console.log('Saving changes...', tempInputs)
  // After saving changes, close the popup
  //   closeEditPopup()
}
</script>

<style scoped>
.profile-image {
  border: 2px solid rgb(238, 40, 228);
  border-radius: 50%;
}
.btn-upload {
  background: #8706ff;
  color: white;
}
.text-edit {
  color: #8f06ff;
}
.popup2 {
  border: 3px solid rgb(199, 13, 255);
}
</style>
