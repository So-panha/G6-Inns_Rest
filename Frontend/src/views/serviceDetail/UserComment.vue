<template>
  <div class="container my-6 p-6">
    <div class="card" style="width: 100%">
      <div class="card-body">
        <h3 class="card-title text-center">Feedback</h3>
        <p class="card-text text-center">Tell us how we can improve</p>
        <div class="d-flex ml-37">
          <img :src="profileImageUrl" class="rounded-circle mr-3 h-10 w-10" :alt="name" />
          <div class="mt-2">
            <h6 class="card-title mb-0">{{ name }}</h6>
          </div>
        </div>
        <form class="p-6">
          <div class="form-group flex">
            <div class="input-group mb-2 ml-32">
              <input
                type="text"
                style="width: 100%; height: 50px; border-radius: 50px"
                class="form-control bg-white col-10"
                name="class_name"
                id="classname"
                placeholder="Write your message here"
                v-model="message"
              />
              <button type="button" class="btn text-primary">
                <span class="material-symbols-outlined fs-1">send</span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- --------------------------------------------------------------- -->
    <div class="row mt-4 scroll-container">
      <div class="col-md-4" v-for="comment in comments" :key="comment.id">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-start">
              <img
                src=""
                class="rounded-circle mr-3 h-10 w-10"
                :alt="comment.name"
              />
              <div>
                <h6 class="card-title mb-0">{{ name }}</h6>
                <p class="card-text">{{ comment.timeAgo }}</p>
                <p class="card-text">{{ comment.message }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useAuthStore } from '../../stores/auth-store.ts'
// import { useAuthStore } from '../../../stores/auth-store.ts';
const authStore = useAuthStore()

export default {
  name: 'UserComment',
  data() {
    const profileImageUrl = ref('')
    const name = ref('')
    const comments = ref([])

    const getUserProfile = async () => {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/user/show/${authStore.user.id}`) // Adjust URL and user ID as needed
        profileImageUrl.value = `http://127.0.0.1:8000/storage/${response.data.user.profile}`
        name.value = response.data.user.name
      } catch (error) {
        console.error('Error fetching user data:', error)
      }
    }

    const CreatCommentFeedback = async () => {
      try {
        // Replace with your API endpoint to fetch comments
        const response = await axios.post(`http://127.0.0.1:8000/api/commentOther`)
        comments.value = response.data.comments
      } catch (error) {
        console.error('Error fetching comments:', error)
      }
    }
    onMounted(() => {
      getUserProfile()
      CreatCommentFeedback ()
    })
    return {
      // Replace with the actual user name
      name,
      profileImageUrl,
      comments: []
    }
  },
}
</script>
