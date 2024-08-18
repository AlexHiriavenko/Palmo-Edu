import axiosConstructor from "axios";

const axios = axiosConstructor.create({
  baseURL: "https://min-api.cryptocompare.com/data/",
  timeout: 1000,
  headers: {
    "Content-Type": "application/json",
    authorization:
      "Apikey 260247a5c09824d11eacc4f26c9f6b8f1d20c900f0b366e746a65609f5dc05b5", // Добавил "Apikey"
  },
});

axios.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    // Обработка ошибок
    return Promise.reject(error);
  }
);

export default axios;
