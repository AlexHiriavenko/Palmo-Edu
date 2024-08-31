<template>
  <v-container
    v-if="isLoading"
    width="100%"
    class="d-flex justify-center align-center"
  >
    <v-progress-circular
      :size="50"
      color="primary"
      indeterminate
    ></v-progress-circular>
  </v-container>
</template>

<script setup>
defineProps({
  isLoading: {
    type: Boolean,
    required: true,
    default: false
  }
})
</script>
