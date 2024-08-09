<!-- 2.1 Створіть реактивний об'єкт і виведіть його властивості в шаблон. 
  Змініть властивість об'єкта і спостерігайте за змінами в DOM. -->

<template>
  <div>
    <h2>Reactive Object Component</h2>
    <p>{{ user.name }}</p>
    <p>{{ user.age }}</p>
    <button @click="changeName">Change Name</button>
  </div>
</template>

<script>
export default {
  name: 'ReactiveObject',

  data() {
    return {
      user: {
        name: "Joe",
        age: 21,
      }
    };
  },
  methods: {
    // 2.2 Створіть метод, який буде викликатися при кліку на кнопку і змінювати деякі дані в інстансі
    changeName() {
      this.user.name = "Mary"
    }
  }
}
</script>

<style scoped></style>