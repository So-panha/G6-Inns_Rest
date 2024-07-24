<template>
  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div
        v-for="(slide, index) in slides"
        :key="index"
        :class="['carousel-item', { active: index === 0 }]"
      >
        <img
          :src="slide.imageUrl"
          class="d-block w-100 h-half-screen"
          :alt="'Slide ' + (index + 1)"
        />
        <div class="carousel-caption d-none d-md-block">
          <h1>GuestHouses</h1>
          <h5>{{ slide.caption }}</h5>
        </div>
      </div>
    </div>
    <button
      class="carousel-control-prev"
      type="button"
      data-bs-target="#carouselExampleFade"
      data-bs-slide="prev"
    >
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button
      class="carousel-control-next"
      type="button"
      data-bs-target="#carouselExampleFade"
      data-bs-slide="next"
    >
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      slides: [
        {
          imageUrl:
            'https://www.christiesrealestate.com/blog/wp-content/uploads/2020/10/header-3-1600x550.jpg?is-pending-load=1',
          caption: 'Find the guesthouses that appeal to you the most'
        },
        {
          imageUrl: 'https://vyn-guesthouse.co.za/wp-content/uploads/2023/05/AMP_3994.jpg',
          caption: 'Find the guesthouses that appeal to you the most'
        },
        {
          imageUrl:
            'https://b-cdn.springnest.com/media/img/2d/20231023_1719098652bd4.jpg?crop=4000%2C1600%2C0%2C480&width=1500',
          caption: 'Find the guesthouses that appeal to you the most'
        }
      ]
    }
  },
  mounted() {
    // Initialize Bootstrap carousel after component is mounted
    new bootstrap.Carousel(document.getElementById('carouselExampleFade'), {
      interval: 2000 // Adjust interval as needed (in milliseconds)
    })
  }
}
</script>

<style lang="scss" scoped>
/* Custom styles for the carousel */
.carousel-item img {
  height: 70vh; /* Set height to 70% of viewport height */
  object-fit: cover; /* Ensure images cover entire space */
}

.carousel-caption {
  background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
  color: white; /* Text color */
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 10px; /* Padding for text */
  text-align: center;
  margin-top: -50%;
}
</style>
