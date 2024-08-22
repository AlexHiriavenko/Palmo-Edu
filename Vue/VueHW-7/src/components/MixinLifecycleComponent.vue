<template>
  <h2>Mixin Lifecycle Logger Component</h2>
</template>

<script>
import { lifecycleLogger } from '@/mixins/lifecycleLogger'

export default {
  name: 'MixinLifecycleComponent',
  mixins: [lifecycleLogger]
}
</script>

<style scoped></style>
