<template>
    <div class="container mt-5">
      <div class="card shadow-sm mx-auto mb-5" style="max-width: 500px;">
        <div class="card-body text-center">
          <div class="mb-4">
            <img
              src="path_to_your_qr_code_image"
              alt="QR Code"
              class="img-fluid"
              style="max-width: 200px;"
            />
            <h1 class="mt-4">Scan QR Code to Make Payment</h1>
            <button @click="simulatePayment" class="btn btn-primary mt-3">Simulate Payment</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import VueSweetalert2 from 'vue-sweetalert2';
  import 'sweetalert2/dist/sweetalert2.min.css';
  
  export default {
    name: 'PaymentComponent',
    methods: {
      simulatePayment() {
        // Simulate payment logic (e.g., API call or other processing)
        // For demonstration, we use setTimeout to simulate asynchronous payment process
        setTimeout(() => {
          // Show success alert using SweetAlert2
          this.$swal({
            icon: 'success',
            title: 'Payment Successful!',
            text: 'Thank you for your payment.',
          });
        }, 2000); // Simulate a 2-second delay for payment processing
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add any additional styles here if necessary */
  </style>
  