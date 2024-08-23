<template>
  <div class="parent-sender">
    <slot
      name="message&number"
      :message="message"
      :number="number"
      :currentCurrency="currentCurrency"
    ></slot>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const message = ref('Text from child component')
const number = ref(1123456.78)
const currentCurrency = ref('€')
</script>

<style scoped>
.parent-sender {
  padding: 20px;
  border: 1px solid #ccc;
}
</style>
