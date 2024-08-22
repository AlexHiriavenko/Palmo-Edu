<template>
  <div class="component">
    <h2>Default Slot Component</h2>
    <slot>
      <p>This is fallback content for the default slot.</p>
    </slot>
  </div>
</template>

<script setup></script>

<style scoped>
.component {
  padding: 20px;
  border: 1px solid #ccc;
  background-color: azure;
}
</style>
