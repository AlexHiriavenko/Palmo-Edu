<template>
  <div class="container">
    <h2>HW-1 Part2 Container</h2>
    <movie-review></movie-review>
  </div>
</template>

<script>

export default {
  name: 'Container',

  components: {
    "movie-review": loadComponent("./Components/MovieReview.vue"),
  }
}
</script>

<style scoped>
.container {
  margin-top: 20px;
  background-color: rgb(236, 166, 166);
  padding: 8px;
}
</style>