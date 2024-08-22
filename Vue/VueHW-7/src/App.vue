<template>
  <h1>Vue HW-7</h1>
  <SlotDefaultContentFirst />
  <SlotDefaultContentSecond />
  <SlotDefault />
  <div class="parent-slot-sender">
    <h3>Get data from child component</h3>
    <SlotDataSender>
      <template #message&number="slotProps">
        <p>{{ slotProps.message }}</p>
        <p>{{ slotProps.number }}</p>
      </template>
    </SlotDataSender>
  </div>
  <SlotModalTrigger />
  <MixinUsingComponent />
</template>

<script setup>
import SlotDefault from './components/SlotDefault.vue'
import SlotDefaultContentFirst from '@/components/SlotDefaultContentFirst.vue'
import SlotDefaultContentSecond from '@/components/SlotDefaultContentSecond.vue'
import SlotDataSender from './components/SlotDataSender.vue'
import SlotModalTrigger from './components/SlotModalTrigger.vue'
import MixinUsingComponent from './components/MixinUsingComponent.vue'
</script>

<style>
h1,
h2,
h3 {
  padding: 8px;
}

.parent-slot-sender {
  background-color: antiquewhite;
}
</style>
