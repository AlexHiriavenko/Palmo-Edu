import './assets/styles/main.css'
import { createApp } from 'vue'
import { createVuetify } from 'vuetify'
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import { createPinia } from 'pinia'
import ModalDialog from '@/components/ModalDialog.vue'

import App from './App.vue'
import router from './router'

const vuetify = createVuetify({
  icons: {
    defaultSet: 'mdi',
    iconfont: 'mdi'
  }
})

const app = createApp(App)

app
  .use(vuetify)
  .use(createPinia())
  .use(router)
  .component('ModalDialog', ModalDialog)
  .mount('#app')
