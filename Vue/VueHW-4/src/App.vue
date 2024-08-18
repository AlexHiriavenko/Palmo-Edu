<template>
  <div>
    <h1>Vue HW-4</h1>
    <ClickTimeSaver />
    <FormSubscription />
  </div>
</template>

<script>
  import ClickTimeSaver from './components/ClickTimeSaver.vue';
  import FormSubscription from './components/FormSubscription.vue';

  export default {
    name: 'App',

    components: {
      ClickTimeSaver,
      FormSubscription,
    },

    data() {
      return {};
    },
  };
</script>

<style>
  body {
  background-color: lightgray;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;

  text-align: left;
  color: #2c3e50;
  margin-top: 60px;
}

h1 {
  text-align: center;
}

button {
  cursor: pointer;
  font-size: 14px;
  padding: 4px;
  border-radius: 6px;
}

.component {
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  max-width: 400px;
  margin-block: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #c2eca9;
}
</style>
