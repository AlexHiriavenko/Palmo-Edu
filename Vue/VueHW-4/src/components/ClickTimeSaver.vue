<template>
  <div class="component">
    <button @click="saveClickTime">Record Time</button>
    <ul>
      <li
        v-for="(time, index) in clickTimes"
        :key="index"
      >
        {{ time }}
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    name: 'ClickTimeSaver',
    data() {
      return {
        clickTimes: [],
      };
    },
    methods: {
      saveClickTime() {
        const currentTime = new Date().toLocaleTimeString();
        this.clickTimes.push(currentTime);
      },
    },
  };
</script>
