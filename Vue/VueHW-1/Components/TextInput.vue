<!-- Завдання 5: Створіть окремий файл з компонентом, зареєструйте та додайте до проєкту. -->

<template>
  <div class="text-input-component">
    <h2>Text Input Component</h2>
    <!-- Завдання 6: Створіть форму вводу тексту та зв'яжіть введене значення з властивістю об'єкта Vue. Виведіть введений
    текст на сторінці. -->
    <input v-model="inputText" placeholder="Enter text" class="text-input" />
    <p class="entered-text">Entered text: {{ inputText }}</p>
    <!-- Завдання 7: Створіть ще один окремий файл з компонентом, зареєструйте та використуйте його у існуючему
    компоненті. -->
    <input-controls @clear-input="inputText = ''" @reset-input="resetInput" />
  </div>
</template>

<script>
export default {
  name: 'TextInputComponent',

  // Завдання 7: Створіть ще один окремий файл з компонентом, зареєструйте та використуйте його у існуючему компоненті. 
  components: {
    "input-controls": loadComponent("./Components/InputControls.vue"),
  },

  data() {
    return {
      inputText: ''
    };
  },
  methods: {
    resetInput() {
      this.inputText = 'Default Text';
    }
  }
}
</script>

<style scoped>
.text-input-component {
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  max-width: 400px;
  margin-block: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #f9f9f9;
}

.text-input-component h2 {
  font-size: 1.5em;
  color: #333;
  margin-bottom: 10px;
}

.text-input {
  width: 100%;
  padding: 10px;
  font-size: 1em;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 10px;
}

.entered-text {
  font-size: 1em;
  color: #555;
}
</style>