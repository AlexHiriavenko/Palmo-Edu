<template>
  <div v-if="isLoading" class="loader-container">
    <v-container width="100%" class="d-flex justify-center align-center">
      <v-progress-circular :size="size" :color="color" indeterminate />
    </v-container>
  </div>
</template>

<script setup>
defineProps({
  isLoading: {
    type: Boolean,
    required: true,
    default: false
  },
  size: {
    type: Number,
    required: false,
    default: 50
  },
  color: {
    type: String,
    required: false,
    default: 'primary'
  }
})
</script>
