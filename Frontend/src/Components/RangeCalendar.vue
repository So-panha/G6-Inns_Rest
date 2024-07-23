<template>
  <div class="container">
    <div class="w-auto">
      <div class="mx-auto mt-8 max-w-screen-lg px-2">
        <label class="text-lg font-semibold" style="color: #001063;">Select Date Range</label> <br>
        
        <div class="flex items-center space-x-4">
          <flat-pickr 
            v-model="startDate" 
            :config="startConfig" 
            class="border-2 border-gray-300 rounded px-3 py-2 w-56"
            placeholder="Start Date"
          ></flat-pickr>
          
          <flat-pickr 
            v-model="endDate" 
            :config="endConfig" 
            class="border-2 border-gray-300 rounded px-3 py-2 w-56"
            placeholder="End Date"
          ></flat-pickr>
        </div>
      </div>
    </div>
    <!-- {{ startDate }}
    {{ endDate }} -->
  </div>

</template>

<script>
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

export default {
  name: 'App',
  components: {
    flatPickr
  },
  data() {
    return {
      startDate: null, // Start date
      endDate: null,   // End date
      startConfig: {
        dateFormat: 'Y-m-d', // Format for the start date
        onChange: this.handleStartDateChange, // Handle changes to the start date
      },
      endConfig: {
        dateFormat: 'Y-m-d', // Format for the end date
        onChange: this.handleEndDateChange, // Handle changes to the end date
      }
    };
  },
  methods: {
    handleStartDateChange(selectedDates) {
      if (selectedDates.length > 0 && this.endDate) {
        this.redirectToFilteredPage();
      }
    }
    // handleEndDateChange(selectedDates) {
    //   if (selectedDates.length > 0 && this.startDate) {
    //     this.redirectToFilteredPage();
    //   }
    // },
    // redirectToFilteredPage() {
    //   if (this.startDate && this.endDate) {
    //     window.location.href = `/admin/transactions?startDate=${this.startDate}&endDate=${this.endDate}`;
    //   }
    // }
  }
};
</script>

<style>
.container {
  margin-top: 50px;
}

.flatpickr {
  border: 2px solid #d1d5db; /* Light gray border for flatpickr */
  border-radius: 0.375rem; /* Rounded corners */
  padding: 0.5rem; /* Padding inside the input */
  width: 14rem; /* Set a fixed width for the flatpickr input */
}

.flatpickr input {
  border: none; /* Remove the default border */
  outline: none; /* Remove the default outline */
}

.label {
  font-size: 1.125rem;
  font-weight: 600;
  margin-bottom: 0.5rem; 
}

.flex {
  display: flex;
}

.space-x-4 {
  margin-right: 1rem;
}

.btn {
  padding: 10px 20px;
  font-size: 16px;
}

.row {
  display: flex;
  justify-content: center;
  align-items: center;
  /* height: 100vh; */
}
</style>
