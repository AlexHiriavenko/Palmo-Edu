import axiosConstructor from 'axios';

const axios = axiosConstructor.create({
  baseURL: 'https://restcountries.com/v3.1/',
  timeout: 1000,
  headers: {
    'Content-Type': 'application/json',
  },
});

axios.interceptors.response.use(
  (response) => {
    return response.data;
  },
  (error) => {
    // Централизованная обработка ошибок
    if (error.response) {
      console.error(
        'Ошибка на сервере:',
        error.response.status,
        error.response.data,
      );
    } else if (error.request) {
      console.error('Сервер не отвечает:', error.request);
    } else {
      console.error('Ошибка при настройке запроса:', error.message);
    }

    // можно передавать ошибку дальше, если нужно
    return Promise.reject(error);
  },
);

export default axios;
