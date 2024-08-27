// src/stores/modalStore.js
import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useModalStore = defineStore('modalStore', () => {
  const isOpen = ref(false)

  function openModal() {
    isOpen.value = true
  }

  function closeModal() {
    isOpen.value = false
  }

  function toggleModal() {
    isOpen.value = !isOpen.value
  }

  return {
    isOpen,
    openModal,
    closeModal,
    toggleModal
  }
})
