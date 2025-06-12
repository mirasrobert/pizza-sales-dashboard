import { createRouter, createWebHistory } from 'vue-router';

import Login from '@/pages/auth/Login.vue';
import Register from '@/pages/auth/Register.vue';
import Dashboard from '@/pages/Dashboard.vue';
import Profile from '@/pages/settings/Profile.vue';

const routes = [
    { path: '/', name: 'home', component: Login },
    { path: '/login', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register },
    { path: '/dashboard', name: 'dashboard', component: Dashboard },
    { path: '/profile', name: 'profile', component: Profile },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
