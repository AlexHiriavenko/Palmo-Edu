<template>
  <AppTitle :msg="appTitle" />
  <BlockchainList />
  <ConditionalDisplay />
  <ConditionalDisplayControl />
</template>

<script>
  import AppTitle from './components/AppTitle.vue';
  import BlockchainList from './components/BlockchainList.vue';
  import ConditionalDisplay from './components/ConditionalDisplay.vue';
  import ConditionalDisplayControl from './components/ComponentsConditionalDisplay/ConditionalDisplayControl.vue';

  export default {
    name: 'App',

    components: {
      AppTitle,
      BlockchainList,
      ConditionalDisplay,
      ConditionalDisplayControl,
    },

    data() {
      return {};
    },

    created() {
      this.appTitle = 'Vue HW-3';
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

  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
