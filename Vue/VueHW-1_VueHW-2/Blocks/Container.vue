<template>
  <div class="container">
    <h2>HW-1 Part2 Container</h2>
    <movie-review></movie-review>
    <crypto-calc-watcher></crypto-calc-watcher>
  </div>
</template>

<script>

export default {
  name: 'Container',

  components: {
    "movie-review": loadComponent("./Components/MovieReview.vue"),
    "crypto-calc-watcher": loadComponent("./Components/CryptoCalcWatcher.vue")
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