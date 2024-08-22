<template>
  <div class="modal" v-if="modelValue">
    <div class="modal-overlay" @click="closeModal"></div>
    <div class="modal-content">
      <header class="modal-header" style="background-color: aquamarine">
        <slot name="header">
          <h3>Default modal header content</h3>
        </slot>
      </header>
      <section class="modal-body" style="background-color: bisque">
        <slot name="body">
          <p>Default modal body content</p>
        </slot>
      </section>
      <footer class="modal-footer" style="background-color: aquamarine">
        <slot name="footer">
          <p>Fallback content for footer</p>
        </slot>
        <button @click="closeModal">Close</button>
      </footer>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'

defineProps({
  modelValue: {
    type: Boolean,
    required: true
  }
})

const emit = defineEmits(['update:modelValue'])

function closeModal() {
  emit('update:modelValue', false)
}
</script>

<style scoped>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-overlay {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  position: relative;
  z-index: 10;
}

.modal-header,
.modal-footer {
  padding: 10px 8px;
  border-bottom: 1px solid #eee;
}

.modal-footer {
  border-top: 1px solid #eee;
  border-bottom: none;
}

section,
header,
footer {
  padding: 8px;
}

button {
  display: block;
  margin-top: 8px;
  margin-inline: auto;
}
</style>
