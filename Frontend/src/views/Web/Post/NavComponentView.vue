<template>
  <nav class="bg-gray-800 py-2">
    <div class="container mx-auto flex justify-center items-center space-x-8">
      <router-link to="/home" class="text-white hover:text-yellow-500 transition-colors">
        HOME
      </router-link>
      <router-link to="/guesthouse-card" class="text-white hover:text-yellow-500 transition-colors">
        Find Guesthouses
      </router-link>
    </div>
  </nav>
</template>

<style scoped>
nav {
  background-color: #333; /* Darkened background */
  color: #fff;
  height: 60px; /* Adjust height as needed */
  display: flex;
  justify-content: center;
  align-items: center;
}

nav a {
  color: #fff;
  text-decoration: none;
  margin: 0 15px;
  font-size: 16px;
  padding: 10px 15px; /* Padding inside each link */
  border-radius: 5px; /* Rounded corners */
  transition:
    background-color 0.3s ease,
    color 0.3s ease; /* Smooth transitions */
}

nav a:hover {
  background-color: #7606ff; /* Darkened background on hover */
  color: white;
}
</style>
