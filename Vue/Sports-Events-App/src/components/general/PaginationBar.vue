<template>
  <v-pagination
    :modelValue="modelValue"
    :length="length"
    :total-visible="totalVisible"
    @update:modelValue="updatePage"
    color="white"
    class="mt-4"
    style="text-shadow: 1px 1px 1px black"
  ></v-pagination>
</template>

<script setup>
defineProps({
  length: {
    type: Number,
    default: 15
  },
  totalVisible: {
    type: Number,
    default: 6
  },
  modelValue: {
    type: Number,
    required: true
  }
})

const emit = defineEmits(['update:modelValue'])

function updatePage(val) {
  emit('update:modelValue', val)
}
</script>
