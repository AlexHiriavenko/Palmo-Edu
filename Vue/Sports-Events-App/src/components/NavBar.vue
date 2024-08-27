<template>
  <v-tabs>
    <v-tab v-for="route in routes" :key="route.name" :to="route.path">
      {{ route.meta?.title || route.name }}
    </v-tab>
  </v-tabs>
</template>

<script setup>
defineProps({
  routes: {
    type: Array,
    required: true
  }
})
</script>
