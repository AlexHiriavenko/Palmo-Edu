// import './assets/styles/main.css'

// import { createApp } from 'vue'
// import { createVuetify } from 'vuetify'
// import 'vuetify/styles'
// import { createPinia } from 'pinia'

// import App from './App.vue'
// import router from './router'

// const vuetify = createVuetify()
// const app = createApp(App)

// app.use(vuetify).use(createPinia()).use(router).mount('#app')

import './assets/styles/main.css'

import { createApp } from 'vue'
import { createVuetify } from 'vuetify'
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

// Создание экземпляра Vuetify с настройкой для MDI иконок
const vuetify = createVuetify({
  icons: {
    defaultSet: 'mdi', // Настройка использования MDI как основного набора иконок
    iconfont: 'mdi' // Явное указание на использование MDI
  }
})

const app = createApp(App)

app
  .use(vuetify) // Подключение Vuetify с MDI иконками
  .use(createPinia()) // Подключение Pinia
  .use(router) // Подключение роутера
  .mount('#app') // Монтирование приложения
