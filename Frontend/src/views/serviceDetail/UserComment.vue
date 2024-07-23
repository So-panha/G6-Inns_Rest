<template>
  <div class="container my-6 p-4 ml-2">
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
        <form class="p-6" @submit.prevent="submitComment">
          <div class="form-group flex">
            <div class="input-group mb-2 ml-32">
              <input
                type="text"
                style="width: 100%; height: 50px; border-radius: 50px"
                class="form-control bg-white col-10"
                name="class_name"
                id="classname"
                placeholder="Write your message here"
                v-model="newComment.message"
              />
              <button type="submit" class="btn text-primary">
                <span class="material-symbols-outlined fs-1">send</span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- ------------------------------------------------ -->
  <div class="row mt-10">
    <div class="col-12 d-flex align-items-start">
      <button class="btn btn-outline-dark scroll-btn" @click="scrollLeft">
        <span class="material-symbols-outlined">chevron_left</span>
      </button>
      <div class="scroll-container d-flex flex-nowrap  h-40 w-300">
        <div class="col-md-4" v-for="comment in comments" :key="comment.id">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start">
                <img
                  :src="comment.profileImageUrl"
                  class="rounded-circle me-3 h-10 w-10"
                  :alt="comment.name"
                />
                <div>
                  <div class="d-flex align-items-center">
                    <h6 class="card-title mb-0 me-2">{{ comment.name }}</h6>
                    <small>{{ comment.time }}</small>
                    <div class="dropdown ms-auto " v-if="isCommentOwner(comment)">
                      <a class="text-dark" id="dropRight" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="material-symbols-outlined ml-20">more_vert</span>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropRight">
                        <li>
                          <a class="dropdown-item" @click="editComment(comment)">Edit</a>
                        </li>
                        <li>
                          <a class="dropdown-item" @click="deleteComment(comment.id)">Delete</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <p class="card-text">{{ comment.comment }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="btn btn-outline-dark scroll-btn" @click="scrollRight">
        <span class="material-symbols-outlined">chevron_right</span>
      </button>
    </div>
  </div>
    <!-- ------------------------------------ -->
  </div>
</template>

<script>
import axios from 'axios'
import { useAuthStore } from '../../stores/auth-store.ts'

const authStore = useAuthStore()


export default {
  name: 'UserComment',
  data() {
    return {
      profileImageUrl: '',
      name: '',
      comments: [],
      newComment: { message: '', id: null } // Add id to track comment being edited
    }
  },
  mounted() {
    this.getUserProfile()
    this.fetchComments()
  },
  methods: {
        scrollLeft() {
      const container = this.$el.querySelector('.scroll-container');
      container.scrollBy({ left: -500, behavior: 'smooth' });
    },
    scrollRight() {
      const container = this.$el.querySelector('.scroll-container');
      container.scrollBy({ left: 500, behavior: 'smooth' });
    },
    isCommentOwner(comment) {
      return true; // Replace with actual logic to determine if the current user owns the comment
    },
    editComment(comment) {
      console.log('Edit comment:', comment); // Implement edit comment logic
    },
    deleteComment(commentId) {
      console.log('Delete comment ID:', commentId); // Implement delete comment logic
    },
  




    async getUserProfile() {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/user/show/${authStore.user.id}`)
        this.profileImageUrl = `http://127.0.0.1:8000/storage/${response.data.user.profile}`
        this.name = response.data.user.name
      } catch (error) {
        console.error('Error fetching user data:', error)
      }
    },
    async fetchComments() {
      try {
        const guestHouseId = this.$route.params.id
        const response = await axios.get(`http://127.0.0.1:8000/api/comment/show/${guestHouseId}`)
        if (response.data && response.data.comments) {
          this.comments = response.data.comments.map((comment) => {
            return {
              ...comment,
              profileImageUrl:
                comment.userNormal && comment.userNormal.profile
                  ? `http://127.0.0.1:8000/storage/${comment.userNormal.profile}`
                  : 'default-profile.png',
              name: comment.userNormal ? comment.userNormal.name : 'Anonymous',
              time: comment.created_at_human
            }
          })
        } else {
          console.error('No comments found for this guest house')
        }
      } catch (error) {
        console.error('Error fetching comments:', error)
      }
    },
    isCommentOwner(comment) {
      return authStore.user.id === comment.userNormal.id
    },
    async submitComment() {
      if (this.newComment.message) {
        try {
          if (this.newComment.id != null) {
            console.log(this.newComment.message);
            await axios.put(
              `http://127.0.0.1:8000/api/updateComment/${this.newComment.id}`,
              { comment: this.newComment.message },
              {
                headers: {
                  'Content-Type': 'application/json',
                  Authorization: `Bearer ${localStorage.getItem('access_token')}`
                }
              }
            )
            const index = this.comments.findIndex(comment => comment.id === this.newComment.id)
            if (index !== -1) {
              this.comments[index].comment = this.newComment.message
              this.comments[index].time = 'Just now'
            }
          } else {
            const guestHouseId = this.$route.params.id
            await axios.post(
              'http://127.0.0.1:8000/api/commentGuestHouse',
              {
                guestHouse_id: guestHouseId,
                comment: this.newComment.message
              },
              {
                headers: {
                  'Content-Type': 'application/json',
                  Authorization: `Bearer ${localStorage.getItem('access_token')}`
                }
              }
            )
          }
          this.newComment.message = ''
          this.newComment.id = null
          this.fetchComments()
        } catch (error) {
          console.error(
            'Error adding/updating comment:',
            error.response ? error.response.data : error.message
          )
        }
      }
    },
    editComment(comment) {
      this.newComment.message = comment.comment
      this.newComment.id = comment.id
    },
    async deleteComment(commentId) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/deleteComment/${commentId}`, {
          headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })
        this.fetchComments()
      } catch (error) {
        console.error('Error deleting comment:', error)
      }
    }
  }
}
</script>


<style scoped>
.scroll-container {
  overflow-x: auto;
}
.scroll-btn {
  white-space: normal;
}

/* Add any custom styling here */
</style>
