<template>
  <v-container
    class="d-flex flex-column ga-5 justify-center align-center"
    height="200px"
  >
    <p class="text-h4 text-center">{{ userStore.authResultMessage }}</p>
    <v-btn text="OK" :color="buttonColor" @click="handleClose" v-focus></v-btn>
  </v-container>
</template>

<script setup>
import { useUserStore } from '@/stores/userStore'

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
