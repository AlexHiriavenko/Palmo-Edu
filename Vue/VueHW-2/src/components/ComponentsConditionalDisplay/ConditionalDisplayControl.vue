<!-- 
    Створіть декілька компонентів і динамічно переключайте між ними за допомогою v-if, 
    в залежності від вибору користувача (наприклад, використовуючи радіокнопки або випадаючий список). 
-->

<template>
  <div class="components-conditional-display">
    <h2>Выберите компонент для отображения:</h2>
    <select v-model="selectedComponent">
      <option value="componentA">Компонент A</option>
      <option value="componentB">Компонент B</option>
      <option value="componentC">Компонент C</option>
    </select>

    <div>
      <ComponentA v-if="selectedComponent === 'componentA'" />
      <ComponentB v-if="selectedComponent === 'componentB'" />
      <ComponentC v-if="selectedComponent === 'componentC'" />
    </div>
  </div>
</template>

<script>
  import ComponentA from './componentA.vue';
  import ComponentC from './componentC.vue';
  import ComponentB from './componentB.vue';

  export default {
    components: {
      ComponentA,
      ComponentC,
      ComponentB,
    },
    data() {
      return {
        selectedComponent: 'componentA',
      };
    },
  };
</script>

<style>
  .components-conditional-display {
    background-color: lightgreen;
    padding-block: 20px;
  }
</style>
