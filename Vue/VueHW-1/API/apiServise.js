const apiService = {
  apiKey: "260247a5c09824d11eacc4f26c9f6b8f1d20c900f0b366e746a65609f5dc05b5", // правильно получать из переменных окружения
  basicUrl: "https://min-api.cryptocompare.com/data/",

  async fetchCryptoPrices(cryptocurrency) {
    try {
      const response = await fetch(
        `${this.basicUrl}price?fsym=${cryptocurrency}&tsyms=USD,JPY,EUR&api_key=${this.apiKey}`
      );
      return await response.json();
    } catch (error) {
      console.error("Error fetching crypto prices:", error);
      throw error;
    }
  },
};
