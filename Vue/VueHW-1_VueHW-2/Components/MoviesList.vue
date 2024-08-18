<template>
  <ul class="component">
    <li v-for="movie in movies" :key="movie.title" class="list-item">
      <div class="item-wrapper">
        <strong>{{ movie.title }}</strong> - Average Rating: <strong>{{ movie.averageRating }}</strong> - Your Score:
        <strong v-if="getUserScore(movie.title)"> {{ getUserScore(movie.title) }}</strong>
        <strong v-else>Unrated</strong>
      </div>
      <!-- // 2.2 Створіть метод, який буде викликатися при кліку на кнопку і змінювати деякі дані в інстансі -->
      <button v-if="!getUserScore(movie.title)" @click="openReviewForm(movie.title)">Add Rate</button>
    </li>
  </ul>
</template>

<script>
export default {
  name: 'MoviesList',
  props: {
    movies: Array,
    user: Object,
  },
  methods: {
    getUserScore(movieTitle) {
      const targetMovie = this.user.ratedMovies.find(movie => movie.title === movieTitle)
      return targetMovie?.userScore || null;
    },
    // 2.2 Створіть метод, який буде викликатися при кліку на кнопку і змінювати деякі дані в інстансі

    openReviewForm(movieTitle) {
      this.$emit('open-form', movieTitle);
    }
  },
}
</script>

<style scoped>
ul {
  padding-left: 16px;
  max-width: 540px;
  height: 400px;
  min-height: 400px;
  overflow-y: auto;
}

.list-item {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 8px;
}

.list-item button {
  font-size: 14px;
  font-weight: 400;
  padding: 4px;
}

.item-wrapper {
  width: 440px;
}
</style>