<template>
  <div id="app" class="container mt-5">
    <div class="card shadow-sm">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You have success with booking .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <div class="card-body">
        <h1 class="text-center mb-4">Scan To Paid</h1>
        <div class="qr-code-container text-center mt-4">
          <img :src="qrCodeUrl" alt="" class="w-full h-full">
          <div class="text-center mt-3">
            <span>Please, click on button ok to motify you already pay</span><br />
            <button @click="showSuccessAlert" class="btn btn-success mt-3">Ok</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      qrCodeUrl: ''
    }
  },
  mounted() {
    this.fetchQRCode()
  },
  methods: {
    fetchQRCode() {
      axios
        .get(`http://127.0.0.1:8000/api/QR-code/show/3`)
        .then((response) => {
          if (response.data && response.data.QR_code) {
            console.log(1);
            let url = response.data.QR_code.qr_codes
            this.qrCodeUrl = `http://127.0.0.1:8000${url}`;
          } else {
            console.error('Error: Invalid response data format')
          }
        })
        .catch((error) => {
          console.error('Error fetching QR code:', error)
          // Display an error message to the user or take other appropriate action
        })
    },
    showSuccessAlert() {
      this.$router.push(`/service-detail/${this.$route.params.roomId}`)
    }
  }
}
</script>

<style scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 70vh;
}

.card {
  width: 100%;
  max-width: 400px;
  border: none;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.card-body {
  padding: 2rem;
}

.form-group {
  margin-bottom: 1.5rem;
}

.btn-primary {
  width: 100%;
}

.qr-code-container {
  margin-top: 20px;
}
</style>
