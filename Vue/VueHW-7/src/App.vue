<template>
  <h1 v-tooltip="{ text: 'tooltip right', position: 'right' }" v-listener="'rightClick'">
    Vue HW-7 <span>(check v-tooltip and v-listener)</span>
  </h1>
  <SlotDefaultContentFirst />
  <SlotDefaultContentSecond />
  <SlotDefault />
  <div class="parent-slot-sender">
    <h3 v-tooltip="{ text: 'tooltip top', position: 'top' }" v-listener="'leftClick'">
      Get data from child component <span>(check v-tooltip and v-listener)</span>
    </h3>
    <SlotDataSender>
      <template v-slot:message&number="slotProps">
        <p v-textcolor="'orangered'">{{ slotProps.message }}</p>
        <p v-currency="{ amount: slotProps.number, currency: slotProps.currentCurrency }">
          тут директивой v-currency будет сформирован текст в формате: $1 111,11
        </p>
      </template>
    </SlotDataSender>
  </div>
  <SlotModalTrigger />
  <MixinUsingComponent />
  <MixinFormComponent />
  <div class="draggable-container">
    <h2>Druggable Container</h2>
    <div class="draggable-element" v-draggable>Draggable Element</div>
  </div>
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
  cursor: default;
}

h1 {
  max-width: 360px;
  cursor: pointer;
}

h3 {
  max-width: 460px;
  cursor: pointer;
}

h1 span,
h3 span {
  font-size: 14px;
  color: blueviolet;
}

.parent-slot-sender {
  background-color: antiquewhite;
}

.draggable-container {
  height: 200px;
  background-color: chocolate;
}

.draggable-element {
  height: 120px;
  width: 120px;
  background-color: darkcyan;
  cursor: pointer;
  color: white;
  text-align: center;
}
</style>
