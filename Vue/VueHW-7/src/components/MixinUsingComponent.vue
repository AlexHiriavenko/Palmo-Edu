<template>
  <div class="component">
    <h2>This component uses the base mixin</h2>
    <p>{{ sharedMessage }}</p>
    <div class="btn-group">
      <button @click="formatText">Format Text</button>
      <button @click="clearText">Clear Text</button>
      <button @click="setInitialText">Initial Text</button>
    </div>
    <div>
      <button @click="toggleComponent">toggle component</button>
      <MixinlifecycleComponent v-if="isMount" />
    </div>
  </div>
</template>

<script>
import MixinlifecycleComponent from './MixinlifecycleComponent.vue'
import { baseMixin } from '@/mixins/baseMixin'

export default {
  name: 'MixinUsingComponent',
  mixins: [baseMixin],
  components: {
    MixinlifecycleComponent
  },
  data() {
    return {
      isMount: false
    }
  },

  methods: {
    toggleComponent() {
      this.isMount = !this.isMount
    }
  }
}
</script>

<style scoped>
.component {
  padding: 16px;
  background-color: antiquewhite;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  gap: 8px;
  min-height: 150px;
}

.btn-group {
  display: flex;
  gap: 8px;
}
</style>
