<template>
  <div class="list-wrapper">
    <h2>Blockchain List Component. Получить данные используя axios instance</h2>
    <ul>
      <li
        v-for="cryptocurrency in blockchainList"
        :key="cryptocurrency.id"
      >
        {{ cryptocurrency.symbol }}
      </li>
    </ul>
  </div>
</template>

<script>
  import axios from '../axios.js';

  export default {
    name: 'BlockchainList',
    data() {
      return {
        blockchainList: [],
      };
    },
    async created() {
      try {
        const response = await axios.get('blockchain/list');
        const blockchainList = Object.values(response?.Data);
        blockchainList.length = 10;
        this.blockchainList = blockchainList;
        console.log(blockchainList);
      } catch (error) {
        console.error('Ошибка при получении списка блокчейнов:', error);
      }
    },
  };
</script>

<style>
  .list-wrapper {
  background-color: azure;
}
  li {
    text-align: left;
  }
</style>
