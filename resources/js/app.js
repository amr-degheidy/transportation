import './bootstrap';

import {createApp} from "vue";
import app from './App.vue'

import router from './router'
import { createPinia } from "pinia";

createApp(app).use(createPinia()).use(router).mount('#app')
