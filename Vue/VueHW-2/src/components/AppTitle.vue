<template>
  <h1>{{ msg }}</h1>
  <GlobalComponent />
</template>

<script>
  export default {
    name: 'AppTitle',
    props: {
      msg: String,
    },
  };
</script>

<style scoped>
  h1 {
  margin: 40px 0 0;
}
</style>
