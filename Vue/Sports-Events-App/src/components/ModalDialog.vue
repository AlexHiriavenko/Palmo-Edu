<template>
  <v-dialog
    :model-value="isOpen"
    @update:model-value="closeModal"
    max-width="500px"
  >
    <v-card>
      <div class="d-flex justify-end">
        <v-btn icon @click="closeModal" class="mt-4 mr-4">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </div>

      <v-card-text>
        <slot name="modal-content"></slot>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { useModalStore } from '@/stores/modalStore'
import { computed } from 'vue'

const modalStore = useModalStore()

const isOpen = computed(() => modalStore.isOpen)

const closeModal = () => {
  modalStore.closeModal()
}
</script>
