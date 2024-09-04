<template>
  <v-dialog
    :model-value="isOpen"
    @update:model-value="closeModal"
    max-width="500px"
  >
    <v-card min-height="400px">
      <div class="d-flex justify-end">
        <v-btn icon @click="closeModal" class="mt-4 mr-4">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </div>

      <v-card-text class="d-flex justify-center align-center">
        <slot name="modal-content"></slot>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { ref } from 'vue'

const isOpen = ref(false)

const closeModal = () => (isOpen.value = false)

const openModal = () => (isOpen.value = true)

defineExpose({ openModal, closeModal })
</script>
