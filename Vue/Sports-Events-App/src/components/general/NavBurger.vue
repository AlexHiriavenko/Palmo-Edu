<template>
  <v-navigation-drawer
    :model-value="modelValue"
    :location="'top'"
    temporary
    @input="$emit('update:modelValue', $event)"
  >
    <v-list>
      <v-list-item v-for="route in routes" :key="route.name" :to="route.path">
        <v-list-item-title>
          {{ route.meta?.title || route.name }}
        </v-list-item-title>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script setup>
defineProps({
  routes: {
    type: Array,
    required: true
  },
  modelValue: {
    type: Boolean,
    required: true
  }
})
</script>
