<template>
  <div class="component">
    <h2>Dynamic Еlements List</h2>
    <ul>
      <li
        v-for="(item, index) in items"
        :key="index"
        :style="item.style"
        @click="updateStyles(index)"
      >
        Елемент № {{ index + 1 }}
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    name: 'DynamicЕlementsList',
    data() {
      return {
        items: [],
      };
    },
    methods: {
      generateRandomStyle() {
        const MAX_HEX_COLOR_VALUE = 16777215;

        const randomColor = `#${Math.floor(Math.random() * MAX_HEX_COLOR_VALUE).toString(16)}`; // рандомный hex
        const randomFontSize = `${Math.floor(Math.random() * 15) + 14}px`; // от 14 до 28 px
        const randomWidth = `${Math.floor(Math.random() * 201) + 100}px`; // от 100 до 300 px
        const randomHeight = `${Math.floor(Math.random() * 201) + 100}px`; // от 100 до 300 px

        return {
          backgroundColor: randomColor,
          fontSize: randomFontSize,
          width: randomWidth,
          height: randomHeight,
        };
      },
      generateItems() {
        for (let i = 0; i < 4; i += 1) {
          this.items.push({ style: this.generateRandomStyle() });
        }
      },
      updateStyles(index) {
        const randomTop = `${Math.floor(Math.random() * 300) - 150}px`;
        const randomLeft = `${Math.floor(Math.random() * 300) - 150}px`;

        this.items[index].style = {
          ...this.generateRandomStyle(),
          top: randomTop,
          left: randomLeft,
        };
      },
    },
    created() {
      this.generateItems();
    },
  };
</script>

<style scoped>
  .component {
    min-width: 90vw;
  }

  ul {
    min-width: 100%;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    list-style-type: none;
  }

  li {
    position: relative;
    transition: all 0.5s ease;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 8px;
    cursor: pointer;
  }
</style>
