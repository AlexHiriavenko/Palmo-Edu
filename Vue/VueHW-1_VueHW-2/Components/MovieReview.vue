<template>
  <h2>Movie Reviews. User: {{ user.name }}</h2>
  <div class="container">
    <div>
      <button @click="resetFilters">Reset Filters</button>
      <button @click="filterByType('unrated')">Filter by Unrated</button>
      <button @click="filterByType('rated')">Filter by Rated</button>
      <div class="rating-filter">
        <p>Filter by Average Rating:
          <button @click="decreaseRate">-</button>
          <span>{{ rate.toFixed(1) }}</span>
          <button @click="increaseRate">+</button>
        </p>
      </div>
      <movies-list :movies="filterByRate" :user="user" @open-form="openReviewForm"></movies-list>
    </div>
    <review-form v-if="showForm" :movieTitle="selectedMovie" :user="user" @edit-user-name="editUserName"
      @submit-review="addUserReview"></review-form>
  </div>
</template>

<script>
const moviesData = [
  { title: "The Shawshank Redemption", averageRating: 4.9, ratingsCount: 9 },
  { title: "Forrest Gump", averageRating: 4.1, ratingsCount: 7 },
  { title: "The Dark Knight", averageRating: 3.8, ratingsCount: 8 },
  { title: "12 Angry Men", averageRating: 4.6, ratingsCount: 7 },
  { title: "Schindler's List", averageRating: 4.5, ratingsCount: 6 },
  { title: "Pulp Fiction", averageRating: 4.4, ratingsCount: 4 },
  { title: "The Lord of the Rings", averageRating: 5, ratingsCount: 12 },
  { title: "Fight Club", averageRating: 4.2, ratingsCount: 8 },
  { title: "The Godfather", averageRating: 4.8, ratingsCount: 9 },
  { title: "Inception", averageRating: 3.6, ratingsCount: 5 },
  { title: "Movie A", averageRating: 2.4, ratingsCount: 4 },
  { title: "Movie B", averageRating: 1.7, ratingsCount: 4 }
];

export default {
  name: "MovieReview",
  components: {
    "movies-list": loadComponent("./Components/MoviesList.vue"),
    "review-form": loadComponent("./Components/ReviewForm.vue"),
  },
  data() {
    return {
      movies: moviesData,
      // 2.1 Створіть реактивний об'єкт і виведіть його властивості в шаблон.
      user: {
        id: 1,
        name: "John Doe",
        ratedMovies: [
          { title: "The Shawshank Redemption", userScore: 5 },
          { title: "The Godfather", userScore: 4 },
          { title: "The Dark Knight", userScore: 5 },
          { title: "12 Angry Men", userScore: 4 },
          { title: "Movie A", userScore: 3 },
        ]
      },
      rate: 1,
      showForm: false,
      selectedMovie: ''
    }
  },
  computed: {
    // 2.7 Створіть обчислювальну властивість для виведення даних, обчислених на основі інших реактивних даних.
    // 2.8 Створіть computed property для фільтрації списку об'єктів.
    filterByRate() {
      return this.movies.filter(movie => movie.averageRating >= this.rate);
    }
  },
  methods: {
    getUserScore(movieTitle) {
      const targetMovie = this.user.ratedMovies.find(movie => movie.title === movieTitle)
      return targetMovie?.userScore || null;
    },
    increaseRate() {
      if (this.rate < 5) {
        this.rate += 1;
      }
    },
    decreaseRate() {
      if (this.rate > 1) {
        this.rate -= 1;
      }
    },
    resetFilters() {
      this.movies = moviesData;
      this.rate = 1;
    },
    // 2.4 Створіть метод для фільтрації масиву об'єктів за деяким критерієм.
    filterByType(type) {
      this.movies = moviesData.filter(movie => type === "rated" ? this.getUserScore(movie.title) : !this.getUserScore(movie.title));
    },
    // 2.2 Створіть метод, який буде викликатися при кліку на кнопку і змінювати деякі дані в інстансі
    openReviewForm(movieTitle) {
      this.showForm = true;
      this.selectedMovie = movieTitle;
    },

    // 2.5 Використайте метод для обробки події кліку, який змінює стан інших компонентів.
    addUserReview({ movieTitle, userName, score }) {
      const userReview = { title: movieTitle, userScore: score };
      this.user.ratedMovies.push(userReview);

      const targetMovie = this.movies.find(movie => movie.title === movieTitle);
      if (targetMovie) {
        targetMovie.ratingsCount += 1;
        targetMovie.averageRating = +(((targetMovie.averageRating * (targetMovie.ratingsCount - 1)) + score) / targetMovie.ratingsCount).toFixed(1)
      }


      this.showForm = false;
    },
    editUserName(name) {
      this.user.name = name
    }
  },
}
</script>

<style scoped>
.container {
  display: flex;
}

.rating-filter {
  margin: 20px 0;
  display: flex;
  align-items: center;
}

.rating-filter p {
  margin: 0;
  font-size: 16px;
}

.rating-filter button {
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 5px 10px;
  margin: 0 5px;
  cursor: pointer;
  font-size: 16px;
}

.rating-filter button:hover {
  background-color: #45a049;
}

.rating-filter span {
  font-size: 18px;
  font-weight: bold;
  margin: 0 10px;
}

button {
  margin-right: 8px;
}
</style>
