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
            'https://i.pinimg.com/736x/9a/3c/f4/9a3cf46c1b566ead3cfeb1abc2981c5d.jpg',
            'https://cdn.pixabay.com/photo/2014/07/10/17/18/large-home-389271_640.jpg',
            'https://cdn.pixabay.com/photo/2017/04/10/22/28/residence-2219972_640.jpg',
            'https://cdn.pixabay.com/photo/2016/11/29/03/53/house-1867187_640.jpg',
            'https://i.pinimg.com/564x/64/e7/74/64e774ef7556c260955272b0aada12e9.jpg',
          ]
        },
        {
          id: 2,
          name: 'stay alone',
          images: [
            'https://cdn.pixabay.com/photo/2018/01/17/15/52/driveway-3088488_640.jpg',
            'https://cdn.pixabay.com/photo/2018/01/31/14/37/house-3121253_640.jpg',
            'https://cdn.pixabay.com/photo/2018/01/15/14/46/house-3084040_640.jpg',
            'https://cdn.pixabay.com/photo/2018/01/16/15/49/house-3086212_640.jpg',
            'https://cdn.pixabay.com/photo/2018/03/19/18/46/house-3240836_640.jpg'
          ]
        },
        {
          id: 3,
          name: 'stay alone',
          images: [
            'https://cdn.pixabay.com/photo/2014/03/20/21/23/white-brick-home-291661_640.jpg',
            'https://i.pinimg.com/736x/ce/75/90/ce75904199d9f0410ed889be55919576.jpg',
            'https://i.pinimg.com/564x/da/44/da/da44da50b7d680b6b87d3ad84b71de81.jpg',
            'https://i.pinimg.com/564x/42/34/26/4234269874247b7ab2dab261857e5f67.jpg',
            'https://i.pinimg.com/564x/f0/ae/d9/f0aed9d48ad651d6c0b4a76205a45826.jpg'
          ]
        },
        {
          id: 4,
          name: 'stay alone',
          images: [
            'https://i.pinimg.com/564x/b5/12/c6/b512c675fd6601a276c74871e9550f52.jpg',
            'https://i.pinimg.com/564x/d3/fb/f7/d3fbf7d57a3be1deafe06b4e983997f5.jpg',
            'https://i.pinimg.com/564x/f2/b7/b7/f2b7b7729052a43764691b9145cb90bd.jpg',
            'https://i.pinimg.com/564x/e2/0e/f2/e20ef2b9bfc1345e74cad88efc7c8ac8.jpg',
            'https://i.pinimg.com/564x/18/be/92/18be92f08bd68d45e44b8e78afb1d370.jpg'
          ]
        },
        {
          id: 5,
          name: 'stay alone',
          images: [
            'https://i.pinimg.com/564x/01/75/4d/01754d322716717ec88808f9bc10c792.jpg',
            'https://i.pinimg.com/564x/3a/92/7b/3a927bfbce67c10345c64b225224bced.jpg',
            'https://i.pinimg.com/564x/e8/45/73/e8457350c14fa4c1caab9904bd48841b.jpg',
            'https://i.pinimg.com/564x/e5/34/85/e53485d5087af4d50fabaf2b0a6740df.jpg',
            'https://i.pinimg.com/564x/fa/a0/5b/faa05b36ebf7184fe689fb3aae78d450.jpg',
            'https://i.pinimg.com/564x/44/03/a6/4403a6c3970641bb497329872e4803d4.jpg',
            'https://i.pinimg.com/564x/8e/03/86/8e0386c2ed7c6f894fb4ca46c3ceacb2.jpg',
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
  <div class="container mt-4 mb-15">
    <h2 class="mb-4">Popular Booking</h2>
    <div class="position-relative">
      <div id="cards-container" class="d-flex overflow-auto" style="white-space: nowrap; scroll-behavior: smooth">
        <div v-for="house in houses" :key="house.id" class="col-md-4 mb-4 mr-3 d-inline-block "  style="width: 400px;">
          <div class="card h-100 position-relative">
            <div class="overflow-auto" :id="'scrollContainer-' + house.id" style="white-space: nowrap; scroll-behavior: smooth">
              <div v-for="image in house.images" :key="image" class="d-inline-block">
                <img :src="image" :alt="house.name" class="card-img-top" style="width: 400px; height: 200px; object-fit: cover" />
              </div>
            </div>
            <button
              @click="scrollLeft(house.id)"
              class="position-absolute top-50 start-0 translate-middle-y btn btn-outline-dark"
            >
              <span class="material-symbols-outlined">arrow_back</span>
            </button>
            <button
              @click="scrollRight(house.id)"
              class="position-absolute top-50 end-0 translate-middle-y btn btn-outline-dark"
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

                  <router-link to="/service-detail"> <button type="button" class="btn btn-outline-success">Detail</button></router-link>
                  
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