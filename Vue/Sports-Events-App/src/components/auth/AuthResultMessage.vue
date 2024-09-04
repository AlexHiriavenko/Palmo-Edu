<template>
  <v-container
    class="d-flex flex-column ga-5 justify-center align-center"
    height="200px"
  >
    <p class="text-h4 text-center">{{ userStore.authResult }}</p>
    <v-btn text="OK" :color="buttonColor" @click="handleClose"></v-btn>
  </v-container>
</template>

<script setup>
import { computed } from 'vue'
import { useUserStore } from '@/stores/userStore'

// Получаем переданный метод через props
const props = defineProps({
  closeModal: Function
})

const userStore = useUserStore()

const buttonColor = computed(() => (userStore.isLoggedIn ? 'success' : 'error'))

const handleClose = () => {
  if (userStore.isLoggedIn) {
    props.closeModal()
  }
  userStore.setAuthResult('')
}
</script>
