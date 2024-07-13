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
          <div class="text-center mt-3">
            <button @click="showSuccessAlert" class="btn btn-success mt-3">Ok</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import QrcodeVue from 'qrcode.vue';
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2';

export default defineComponent({
  name: 'qrCode',
  components: {
    QrcodeVue
  },
  setup() {
    const data = ref('');
    const qrCodeSrc = ref('');
    const router = useRouter();

    const generateQRCode = () => {
      qrCodeSrc.value = data.value;
    };

    const showSuccessAlert = () => {
      Swal.fire({
        icon: 'success',
        title: 'QR Code Generated Successfully!',
        text: 'You can now proceed with your payment.',
      }).then(() => {
        router.push('/qrCode');
      });
    };

    return {
      data,
      qrCodeSrc,
      generateQRCode,
      showSuccessAlert
    };
  }
});
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
