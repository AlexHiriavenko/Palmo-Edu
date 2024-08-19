<template>
  <div class="component">
    <h2>Theme Switcher</h2>
    <button @click="$emit('toggle-theme')">Сменить Тему</button>
  </div>
</template>

<script>
  export default {
    name: 'ThemeSwitcher',
  };
</script>

<style></style>
