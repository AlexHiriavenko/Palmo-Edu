<template>
  <form @submit.prevent="submitReview" class="review-form">
    <h3>Movie: {{ movieTitle }}</h3>

    <div class="form-group">
      <label for="name">Your Name</label>
      <input type="text" id="name" @input="setUserName" :value="user.name" required />
    </div>
    <div class="form-group">
      <label for="score">Movie Grade</label>
      <input id="score" v-model="movieGrade" required />
    </div>
    <button type="submit" class="submit-button">Submit</button>
    <p v-if="isNotValid" class="error">Please enter a valid score between 1 and 5.</p>
  </form>
</template>

<script>
export default {
  name: 'ReviewForm',
  props: {
    movieTitle: String,
    user: Object,
  },
  data() {
    return {
      movieGrade: null,
      isNotValid: false,
    }
  },
  methods: {
    // 2.6 Створіть метод, який буде перевіряти введені дані у формі на відповідність деяким правилам.
    validateScore() {
      const score = parseFloat(this.movieGrade);
      return !isNaN(score) && score >= 1 && score <= 5;
    },
    // 2.3 Створіть метод, який приймає подію і використовує ії для зміни даних інстанса.
    setUserName(event) {
      this.$emit('edit-user-name', event.target.value);
    },
    submitReview() {
      if (this.validateScore()) {
        this.$emit('submit-review', {
          movieTitle: this.movieTitle,
          userName: this.user.name,
          score: parseFloat(this.movieGrade)
        });
        this.movieGrade = null;
      } else {
        this.isNotValid = true
      }
    }
  }
}
</script>

<style scoped>
.review-form {
  min-width: 300px;
  max-width: 500px;
  margin: 20px auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  background-color: #f9f9f9;
}

.review-form h3 {
  margin-bottom: 20px;
  color: #333;
  text-align: center;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
  color: #555;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
}

.form-group input[disabled] {
  background-color: #e9ecef;
  cursor: not-allowed;
}

.submit-button {
  display: block;
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 5px;
  background-color: #4CAF50;
  color: white;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  text-align: center;
}

.submit-button:hover {
  background-color: #45a049;
}

.error {
  color: red;
}
</style>