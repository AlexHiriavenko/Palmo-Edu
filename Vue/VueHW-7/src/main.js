import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import SlotModalNaming from './components/SlotModalNaming.vue'
import { formValidation } from './mixins/formValidation'
import directives from './directives'

const app = createApp(App)

app.component('SlotModalNaming', SlotModalNaming)

app.mixin(formValidation)

directives.forEach((directive) => {
  app.directive(directive.name, directive)
})

app.mount('#app')
