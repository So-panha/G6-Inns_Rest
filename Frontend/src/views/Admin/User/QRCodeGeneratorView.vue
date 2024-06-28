<template>
  <div id="app" class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <h1 class="text-center mb-4">QR Code Generator</h1>
        <div class="form-group">
          <label for="qr-data">Enter data for QR code:</label>
          <input id="qr-data" v-model="data" class="form-control" placeholder="e.g., URL, text, etc." />
        </div>
        <div class="text-center">
          <button @click="generateQRCode" class="btn btn-primary">Generate QR Code</button>
        </div>
        <div v-if="qrCodeSrc" class="qr-code-container text-center mt-4">
          <qrcode-vue :value="qrCodeSrc" :size="200" level="H" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import QrcodeVue from 'qrcode.vue';

export default {
  name: 'App',
  components: {
    QrcodeVue
  },
  data() {
    return {
      data: '',
      qrCodeSrc: ''
    }
  },
  methods: {
    generateQRCode() {
      this.qrCodeSrc = this.data;
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
