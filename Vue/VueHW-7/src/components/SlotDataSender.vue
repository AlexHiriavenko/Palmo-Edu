<template>
  <div class="parent-sender">
    <slot name="message&number" :message="message" :number="number"></slot>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const message = ref('Text from child component')
const number = ref(1)
</script>

<style scoped>
.parent-sender {
  padding: 20px;
  border: 1px solid #ccc;
}
</style>
