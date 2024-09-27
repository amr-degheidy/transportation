import { createRouter, createWebHistory} from "vue-router";

import NotFound from '../Components/NotFoundPage.vue'
import LoginView from "../Views/Login.vue";
import Dashboard from "../Views/Dashboard.vue";
import { userStore } from "../store/userStore.js";


const routes = [
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        name: 'Login',
        component: LoginView,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not_found',
        component: NotFound
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const user = userStore();
    console.log(user)
    if (to.meta.requiresAuth && !user.token) {
        next({name: 'Login'});
    } else if (to.meta.requiresGuest && user.token) {
        next({name: 'Dashboard'});
    } else {
        next();
    }
})

export default router
