<template>
  <v-menu>
    <template #activator="{ props }">
      <slot name="menuActivator" :props="props">
        <v-btn icon="mdi-menu" variant="text" v-bind="props"></v-btn>
      </slot>
    </template>
    <v-list>
      <v-list-item
        v-for="(item, index) in items"
        :key="item.id || index"
        @click="itemClick(item)"
      >
        <v-list-item-title>{{ item.text || item.name }}</v-list-item-title>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script setup>
defineProps({
  modelValue: {
    type: String,
    default: ''
  },
  items: {
    type: Array,
    required: true
  }
})

const emit = defineEmits(['update:modelValue', 'itemClick'])

const itemClick = (item) => {
  emit('update:modelValue', item.action)
  emit('itemClick', item)
}
</script>
