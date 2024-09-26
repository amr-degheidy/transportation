import { createRouter, createWebHistory} from "vue-router";

import NotFound from '../Components/NotFoundPage.vue'

const routes = [
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

export default router
