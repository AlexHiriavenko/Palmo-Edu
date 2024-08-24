<template>
  <div class="modal-trigger">
    <h2>Modal Trigger Component</h2>
    <button @click="showModal" v-draggable>Open Modal</button>

    <SlotModalNaming v-model="isVisible">
      <template #header>
        <p>Header content from ModalTrigger</p>
      </template>

      <template #body>
        <p>Body content from ModalTrigger</p>
      </template>

      <template #footer>
        <p>Footer content from ModalTrigger</p>
      </template>
    </SlotModalNaming>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const isVisible = ref(false)

function showModal() {
  isVisible.value = true
}
</script>

<style scoped>
.modal-trigger {
  background-color: cadetblue;
  padding: 16px;
}
</style>
