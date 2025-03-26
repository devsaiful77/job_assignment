import { createRouter, createWebHistory } from "vue-router";
import store from "../store";

const routes = [
    /* ====================== Public Router ====================== */
    {
        path: "/login",
        component: () => import("../views/Login.vue"),
        name: "admin_login",
        meta: {
            title: "Admin Login",
            isGuest: true,
        },
    },

    /* ====================== Protected Router ====================== */
    {
        path: "/",
        redirect: "/dashboard",
        component: () => import("../layouts/Master.vue"),
        meta: {
            requiresAuth: true,
        },
        children: [
            /* ====================== Start Admin Dashboard Routing ====================== */
            {
                path: "/dashboard",
                component: () => import("../views/Dashboard.vue"),
                name: "admin_dashboard",
                meta: {
                    title: "Admin Dashboard",
                },
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory("/admin"),
    base: "admin",
    routes,
    scrollBehavior(to, from, savedPosition) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                resolve({
                    x: 0,
                    y: 0,
                });
            }, 500);
        });
    },
});


router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({ name: "admin_login" });
    } else if (store.state.user.token && to.meta.isGuest) {
        next({ name: "admin_dashboard" });
    } else {
        next();
    }
});

export default router;
