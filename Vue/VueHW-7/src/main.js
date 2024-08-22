import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import SlotModalNaming from './components/SlotModalNaming.vue'

const app = createApp(App)

app.component('SlotModalNaming', SlotModalNaming)

app.mount('#app')
