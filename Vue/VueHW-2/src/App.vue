<template>
  <AppTitle :msg="appTitle" />
</template>

<script>
import AppTitle from "./components/AppTitle.vue";

export default {
  name: "App",

  components: {
    AppTitle,
  },

  data() {
    return {};
  },

  created() {
    this.appTitle = "Vue HW-2";
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;

  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
