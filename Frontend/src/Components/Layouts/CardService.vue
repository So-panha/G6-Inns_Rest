<script>
export default {
  data() {
    return {
      houses: [
        {
          id: 1,
          name: 'stay with me',
          images: [
            'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX8C0PluoP1nO_bq6S5p5T3ffe_aKvmODJxAIRtiabxZiAW6XqltaBgkB-JPmgMSzh3jI&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3_6uMM_X8sVQZbz3lbEFs1YDmV5PephgwGHlihgTSuzvSi1ApMxQRy0gs7TmG7GkgpEo&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX8C0PluoP1nO_bq6S5p5T3ffe_aKvmODJxAIRtiabxZiAW6XqltaBgkB-JPmgMSzh3jI&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX8C0PluoP1nO_bq6S5p5T3ffe_aKvmODJxAIRtiabxZiAW6XqltaBgkB-JPmgMSzh3jI&usqp=CAU'
          ]
        },
        {
          id: 2,
          name: 'stay alone',
          images: [
            'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX8C0PluoP1nO_bq6S5p5T3ffe_aKvmODJxAIRtiabxZiAW6XqltaBgkB-JPmgMSzh3jI&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3_6uMM_X8sVQZbz3lbEFs1YDmV5PephgwGHlihgTSuzvSi1ApMxQRy0gs7TmG7GkgpEo&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX8C0PluoP1nO_bq6S5p5T3ffe_aKvmODJxAIRtiabxZiAW6XqltaBgkB-JPmgMSzh3jI&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX8C0PluoP1nO_bq6S5p5T3ffe_aKvmODJxAIRtiabxZiAW6XqltaBgkB-JPmgMSzh3jI&usqp=CAU'
          ]
        },
        {
          id: 3,
          name: 'stay alone',
          images: [
            'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX8C0PluoP1nO_bq6S5p5T3ffe_aKvmODJxAIRtiabxZiAW6XqltaBgkB-JPmgMSzh3jI&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3_6uMM_X8sVQZbz3lbEFs1YDmV5PephgwGHlihgTSuzvSi1ApMxQRy0gs7TmG7GkgpEo&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX8C0PluoP1nO_bq6S5p5T3ffe_aKvmODJxAIRtiabxZiAW6XqltaBgkB-JPmgMSzh3jI&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX8C0PluoP1nO_bq6S5p5T3ffe_aKvmODJxAIRtiabxZiAW6XqltaBgkB-JPmgMSzh3jI&usqp=CAU'
          ]
        },
        {
          id: 4,
          name: 'stay alone',
          images: [
            'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX8C0PluoP1nO_bq6S5p5T3ffe_aKvmODJxAIRtiabxZiAW6XqltaBgkB-JPmgMSzh3jI&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3_6uMM_X8sVQZbz3lbEFs1YDmV5PephgwGHlihgTSuzvSi1ApMxQRy0gs7TmG7GkgpEo&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX8C0PluoP1nO_bq6S5p5T3ffe_aKvmODJxAIRtiabxZiAW6XqltaBgkB-JPmgMSzh3jI&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX8C0PluoP1nO_bq6S5p5T3ffe_aKvmODJxAIRtiabxZiAW6XqltaBgkB-JPmgMSzh3jI&usqp=CAU'
          ]
        }
      ]
    }
  },

  methods: {
    scrollLeft(id) {
      const container = document.getElementById(`scrollContainer-${id}`)
      if (container) {
        container.scrollBy({
          left: -400, // Adjust the value to control the scroll amount
          behavior: 'smooth'
        })
      }
    },
    scrollRight(id) {
      const container = document.getElementById(`scrollContainer-${id}`)
      if (container) {
        container.scrollBy({
          left: 400, // Adjust the value to control the scroll amount
          behavior: 'smooth'
        })
      }
    },
    togglePopup() {
      this.showPopup = !this.showPopup
    }
  }
}
</script>
<template>
  <div class="container mt-4">
    <h2 class="mb-4">Popular Booking</h2>
    <div class="position-relative">
      <div id="cards-container" class="d-flex overflow-auto" style="white-space: nowrap; scroll-behavior: smooth">
        <div v-for="house in houses" :key="house.id" class="col-md-4 mb-4 d-inline-block" style="width: 400px;">
          <div class="card h-100 position-relative">
            <div class="overflow-auto" :id="'scrollContainer-' + house.id" style="white-space: nowrap; scroll-behavior: smooth">
              <div v-for="image in house.images" :key="image" class="d-inline-block">
                <img :src="image" :alt="house.name" class="card-img-top" style="width: 400px; height: 200px; object-fit: cover" />
              </div>
            </div>
            <button
              @click="scrollLeft(house.id)"
              class="position-absolute top-50 start-0 translate-middle-y btn btn-outline-info"
            >
              <span class="material-symbols-outlined">arrow_back</span>
            </button>
            <button
              @click="scrollRight(house.id)"
              class="position-absolute top-50 end-0 translate-middle-y btn btn-outline-info"
            >
              <span class="material-symbols-outlined">arrow_forward</span>
            </button>
            <div class="card-body">
              <div class="flex">
                <h6 class="card-title">{{ house.name }}</h6>
                <div class="flex ml-40">
                  <span class="material-symbols-outlined">star</span>
                  <span class="material-symbols-outlined">star</span>
                  <span class="material-symbols-outlined">star</span>
                  <span class="material-symbols-outlined">star</span>
                  <span class="material-symbols-outlined">star</span>
                </div>
              </div>
              <div class="location flex">
                <span class="material-symbols-outlined">home_pin</span>
                <p class="card-text">Some quick example text to build on</p>
              </div>
              <div class="mt-4 flex">
                <div class="mr-60">
                  <span class="material-symbols-outlined mr-4">wifi</span>
                  <span class="material-symbols-outlined">restaurant</span>
                </div>
                <button type="button" class="btn btn-outline-success">Detail</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
</style>