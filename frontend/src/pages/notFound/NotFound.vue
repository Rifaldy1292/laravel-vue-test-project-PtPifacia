<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div
      class="text-center p-6 bg-white rounded-lg shadow-xl w-full sm:w-2/3 lg:w-1/2 xl:w-1/3"
    >
      <h1 class="text-6xl font-bold text-gray-900">404</h1>
      <p class="text-2xl text-gray-700 mt-4">
        Oops! The page you're looking for doesn't exist.
      </p>
      <p class="text-lg text-gray-500 mt-2">
        Maybe it was moved or deleted? Try going back to the homepage.
      </p>
      <router-link
        to="/"
        class="mt-6 inline-block bg-indigo-600 text-white text-lg font-semibold px-6 py-3 rounded-md hover:bg-indigo-700 transition"
      >
        Go to Homepage
      </router-link>
    </div>
  </div>
</template>

<script setup>
// Tidak ada script khusus untuk halaman ini
</script>

<style scoped>
/* Anda bisa menambahkan gaya tambahan di sini jika diperlukan */
</style>
