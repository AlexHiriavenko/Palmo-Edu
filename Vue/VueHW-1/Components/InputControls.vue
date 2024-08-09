  <!-- Завдання 7: Створіть ще один окремий файл з компонентом, зареєструйте та використуйте його у існуючему компоненті.  -->

<template>
  <div>
    <h3>Text Input Child Component</h3>
    <button @click="clearInput">Clear Input</button>
    <button @click="resetInput">Reset Input</button>
  </div>
</template>

<script>
export default {
  name: 'InputControls',
  methods: {
    clearInput() {
      this.$emit('clear-input');
    },
    resetInput() {
      this.$emit('reset-input');
    }
  }
}
</script>

<style scoped>
div {
  background-color: rgb(255, 220, 62);
  padding: 8px;
}

h3 {
  color: rgb(13, 89, 189);
}

button {
  margin-right: 8px;
}
</style>