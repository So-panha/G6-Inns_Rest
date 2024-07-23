<template>
  <div class="container my-6 p-4 ml-2">
    <div class="card" style="width: 100%">
      <div class="card-body">
        <h3 class="card-title text-center">Feedback</h3>
        <p class="card-text text-center">Tell us how we can improve</p>
        <div class="d-flex ml-30">
          <img :src="profileImageUrl" class="rounded-circle mr-3 h-10 w-10" :alt="name" />
          <div class="mt-2">
            <h6 class="card-title mb-0">{{ name }}</h6>
          </div>
        </div>
        <form class="p-6">
          <div class="form-group">
            <textarea class="form-control ml-25" rows="2" placeholder="Write your message here"
              style="width: 80%"></textarea>
          </div>
          <button type="button" class="btn mt-3 ml-300 btn-primary">Submit</button>
        </form>
      </div>
    </div>
    <!-- --------------------------------------------------------------- -->
    <div class="row mt-4 scroll-container">
      <div class="col-md-4" v-for="comment in comments" :key="comment.id">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-start">
              <img :src="profileImageUrl" class="rounded-circle mr-3 h-10 w-10" :alt="comment.name" />
              <div>
                <h6 class="card-title mb-0">{{ name }}</h6>
                <p class="card-text">{{ comment.timeAgo }}</p>
                <p class="card-text">{{ comment.text }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
  name: 'UserComment',
  setup() {
    const profileImageUrl = ref('');
    const name = ref('');
    const comments = ref([]);

    const getUserProfile = async () => {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/user/show/1'); // Adjust URL and user ID as needed
        profileImageUrl.value = `http://127.0.0.1:8000/storage/${response.data.user.profile}`;
        name.value = response.data.user.name;
      } catch (error) {
        console.error('Error fetching user data:', error);
      }
    };

    const fetchComments = async () => {
      try {
        // Replace with your API endpoint to fetch comments
        const response = await axios.get('http://127.0.0.1:8000/api/comments');
        comments.value = response.data.comments;
      } catch (error) {
        console.error('Error fetching comments:', error);
      }
    };

    onMounted(() => {
      getUserProfile();
      fetchComments();
    });

    return {
      profileImageUrl,
      name,
      comments: [
        {
          id: 1,
          timeAgo: '1 day ago',
          text: '" oh my got your service so good I really ressing about it "'
        },
        {
          id: 2,
          timeAgo: '2 days ago',
          text: '"this application so amazing its very comfortable and saety."'
        },
        { id: 3, timeAgo: '3 days ago', text: '"so good"' }
      ]
    };
  },
};
</script>

<style scoped>
/* Tablet Styles */
@media screen and (min-width: 768px) and (max-width: 1024px) {
  .container {
    padding: 2rem;
    margin-left: 1rem;
  }

  .form-control {
    width: 70%;
    margin-left: 15%;
  }

  .btn {
    margin-left: 83%;
  }

  .profile-img,
  .comment-img {
    height: 50px;
    width: 50px;
  }
  .card{
    width: 100%;
  }
}

/* Mobile Styles */
@media screen and (max-width: 767px) {
  .container {
    padding: 1rem;
    margin-left: 0;
  }

  .form-control {
    width: 90%;
    margin-left: 5%;
  }

  .btn {
    margin-left: 5%;
  }

  .profile-img,
  .comment-img {
    height: 40px;
    width: 40px;
  }
}
</style>