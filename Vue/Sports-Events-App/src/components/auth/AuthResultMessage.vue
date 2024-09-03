<template>
  <v-container
    class="d-flex flex-column ga-5 justify-center align-center"
    height="200px"
  >
    <p class="text-h4 text-center">{{ message }}</p>
    <v-btn text="OK" :color="buttonColor" @click="handleClose"></v-btn>
  </v-container>
</template>

<script setup>
import { useUserStore } from '@/stores/userStore'
import { useModalStore } from '@/stores/modalStore'

const userStore = useUserStore()
const modalStore = useModalStore()

const message = computed(() =>
  userStore.isLoggedIn ? 'You Logged In!' : userStore.authError
)

const buttonColor = computed(() => (userStore.isLoggedIn ? 'success' : 'error'))

const handleClose = () => {
  if (userStore.isLoggedIn) {
    modalStore.closeModal()
  }

  userStore.setAuthErrorState(false)
}
</script>
