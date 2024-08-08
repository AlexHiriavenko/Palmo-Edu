<template>
  <div>
    <h1>Hello, Vue 3!</h1>
    <my-component />
  </div>
</template>

<script type="module">

export default {
  name: 'AppVue',
  components: {
    "my-component": loadComponent("./Components/MyComponent.vue"),
  },
};
</script>

<style>
h1 {
  color: blue;
}
</style>
