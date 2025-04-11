import './index.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import ToastPlugin from "vue-toast-notification";

const app = createApp(App)

app.use(createPinia())
app.use(ToastPlugin, {
  position: 'top',
})
app.use(router)

app.mount('#app')

