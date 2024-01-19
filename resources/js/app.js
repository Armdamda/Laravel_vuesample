import './bootstrap'
import { createApp } from 'vue';

import { createRouter, createWebHistory } from 'vue-router'
import routes from './routes/routes'
import auths from './routes/auths';
import App from './App.vue'

const router = createRouter({
  history: createWebHistory(),
  routes,
  auths,
})

const app = createApp(App)

app.use(router)

app.mount('#app')