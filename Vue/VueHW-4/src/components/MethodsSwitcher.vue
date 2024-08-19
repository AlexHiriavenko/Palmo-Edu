<template>
  <div class="component">
    <h2>Methods Switcher</h2>
    <button @click="handleClick">Выполнить Метод</button>
    <button @click="toggleMethod">Сменить метод</button>
    <p>{{ message }}</p>
  </div>
</template>

<script>
  export default {
    name: 'MethodsSwitcher',
    data() {
      return {
        message: 'ожидается выполение метода по нажатию на кнопку',
        useFirstMethod: true,
      };
    },
    methods: {
      firstMethod() {
        this.message = 'Первый метод вызван';
      },
      secondMethod() {
        this.message = 'Второй метод вызван';
      },
      handleClick() {
        this.useFirstMethod ? this.firstMethod() : this.secondMethod();
      },
      toggleMethod() {
        this.useFirstMethod = !this.useFirstMethod;
      },
    },
  };
</script>

<style scoped>
  button {
    margin-right: 8px;
  }
</style>
