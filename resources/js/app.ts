
import './bootstrap.js';
import '../css/app.css';

import { createApp } from 'vue';
// import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';
import App from './App.vue';
import router from './router';

const app = createApp(App);
app.use(router);
// app.use(ZiggyVue); // Optional
app.mount('#app');

// This will set light / dark mode on page load...
initializeTheme();
