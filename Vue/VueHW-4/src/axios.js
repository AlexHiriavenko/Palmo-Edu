// // Додайте за допомогою пакетного менеджеру бібліотеку Axios до проєкту. Сформуйте в окремому файлі инстанс Axios, сконфігуруйте його та імпортуйте за потребою.

// import axiosConstructor from 'axios';

// const axios = axiosConstructor.create({
//   baseURL: 'https://min-api.cryptocompare.com/data/',
//   timeout: 1000,
//   headers: {
//     'Content-Type': 'application/json',
//     authorization:
//       'Apikey 260247a5c09824d11eacc4f26c9f6b8f1d20c900f0b366e746a65609f5dc05b5',
//   },
// });

// axios.interceptors.response.use(
//   (response) => {
//     return response.data;
//   },
//   (error) => {
//     // Централизованная обработка ошибок
//     if (error.response) {
//       console.error(
//         'Ошибка на сервере:',
//         error.response.status,
//         error.response.data,
//       );
//     } else if (error.request) {
//       console.error('Сервер не отвечает:', error.request);
//     } else {
//       console.error('Ошибка при настройке запроса:', error.message);
//     }

//     // можно передавать ошибку дальше, если нужно
//     return Promise.reject(error);
//   },
// );

// export default axios;

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
