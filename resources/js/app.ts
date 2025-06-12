
import './bootstrap.js';
import '../css/app.css';

import { createApp } from 'vue';
import { initializeTheme } from './composables/useAppearance';
import App from './App.vue';
import router from './router';

const app = createApp(App);
app.use(router);
app.mount('#app');

initializeTheme();
