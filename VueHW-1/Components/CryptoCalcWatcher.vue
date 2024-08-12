<template>
  <div class="crypto-container component">
    <h2>Crypto Prices</h2>
    <select v-model="currentCryptocurrency">
      <option value="BTC">BTC</option>
      <option value="ETH">ETH</option>
      <option value="XRP">XRP</option>
    </select>
    <ul>
      <li>{{ currentCryptocurrency }}-USD: {{ cryptoPrices[currentCryptocurrency].USD }}</li>
      <li>{{ currentCryptocurrency }}-EUR: {{ cryptoPrices[currentCryptocurrency].EUR }}</li>
      <li>{{ currentCryptocurrency }}-JPY: {{ cryptoPrices[currentCryptocurrency].JPY }}</li>
    </ul>
    <p :style="{ backgroundColor: backgroundColor }">
      0.5 {{ currentCryptocurrency }} its {{ halfCryptoToUSD }} USD;
    </p>
    <p> {{ halfCryptoToUSD }} USD its {{ halfCryptoToHRN }} HRN</p>
  </div>
</template>

<script>
export default {
  name: 'CryptoPrices',
  data() {
    return {
      currentCryptocurrency: 'BTC',
      cryptoPrices: {
        BTC: {
          USD: 0,
          EUR: 0,
          JPY: 0
        },
        ETH: {
          USD: 0,
          EUR: 0,
          JPY: 0
        },
        XRP: {
          USD: 0,
          EUR: 0,
          JPY: 0
        }
      },
      apiKey: '260247a5c09824d11eacc4f26c9f6b8f1d20c900f0b366e746a65609f5dc05b5',
      basicUrl: 'https://min-api.cryptocompare.com/data/',
      backgroundColor: 'white'
    };
  },
  computed: {
    // Створіть computed property, яке комбінує дані відповіді від HTTP запиту та з рекативною змінною.
    halfCryptoToUSD() {
      return this.cryptoPrices[this.currentCryptocurrency].USD / 2;
    },
    // Створіть кілька computed properties, які залежать одне від одного.
    halfCryptoToHRN() {
      return Math.ceil(this.halfCryptoToUSD * 41);
    }
  },
  watch: {
    currentCryptocurrency: {
      // Використовуйте watcher для відправлення API запитів при зміні реактивних даних.
      handler(newVal) {
        this.fetchCryptoPrices(newVal);
      },
      // Використовуйте опцію immediate для виклику watcher при ініціалізації компонента.
      immediate: true
    },
    // Створіть watcher, який реагує на зміни в computed property.
    halfCryptoToUSD() {
      this.backgroundColor = this.halfCryptoToUSD > 10000 ? 'red' : 'green';
    },

    cryptoPrices: {
      // Використовуйте watcher для відстеження змін у реактивному об’єкті та виведення повідомлення про це.
      handler(newVal) {
        console.log('cryptoPrices изменился:', JSON.parse(JSON.stringify(newVal, null, 2)));
      },
      // Використовуйте deep опцію для відстеження властивостей внутрішніх об’єктів.
      deep: true
    },
    // Використовуйте watcher для відстеження змін однієї властивості у реактивному об’єкті та виведення повідомлення про це.
    'cryptoPrices.BTC.USD'(newVal) {
      console.log(`USD price for BTC changed: ${newVal}`);
    }
  },
  methods: {
    async fetchCryptoPrices(cryptocurrency) {
      const response = await fetch(`${this.basicUrl}price?fsym=${cryptocurrency}&tsyms=USD,JPY,EUR&api_key=${this.apiKey}`);
      const data = await response.json();
      this.cryptoPrices[cryptocurrency].USD = data.USD;
      this.cryptoPrices[cryptocurrency].EUR = data.EUR;
      this.cryptoPrices[cryptocurrency].JPY = data.JPY;
    }
  }
}
</script>