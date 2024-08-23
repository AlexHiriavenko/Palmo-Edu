<template>
  <h1 v-tooltip="{ text: 'tooltip top', position: 'top' }">
    Vue HW-7 <span>(check v-tooltip)</span>
  </h1>
  <SlotDefaultContentFirst />
  <SlotDefaultContentSecond />
  <SlotDefault />
  <div class="parent-slot-sender">
    <h3 v-tooltip="{ text: 'tooltip right', position: 'right' }">Get data from child component</h3>
    <SlotDataSender>
      <template #message&number="slotProps">
        <p v-textcolor="'green'">{{ slotProps.message }}</p>
        <p v-currency="{ amount: slotProps.number, currency: slotProps.currentCurrency }">
          тут директивой v-currency будет сформирован текст в формате: $1 111,11
        </p>
      </template>
    </SlotDataSender>
  </div>
  <SlotModalTrigger />
  <MixinUsingComponent />
  <MixinFormComponent />
</template>

<script setup>
import SlotDefault from './components/SlotDefault.vue'
import SlotDefaultContentFirst from '@/components/SlotDefaultContentFirst.vue'
import SlotDefaultContentSecond from '@/components/SlotDefaultContentSecond.vue'
import SlotDataSender from './components/SlotDataSender.vue'
import SlotModalTrigger from './components/SlotModalTrigger.vue'
import MixinUsingComponent from './components/MixinUsingComponent.vue'
import MixinFormComponent from './components/MixinFormComponent.vue'
</script>

<style>
h1,
h2,
h3 {
  padding: 8px;
}

h1 {
  cursor: pointer;
}

h1 span {
  font-size: 14px;
}

.parent-slot-sender {
  background-color: antiquewhite;
}
</style>
