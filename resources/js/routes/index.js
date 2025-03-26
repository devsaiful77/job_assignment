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
            // isGuest: true,
        },
    },

    /* ====================== Protected Router ====================== */
    {
        path: "/",
        redirect: "/dashboard",
        component: () => import("../layouts/Master.vue"),
        meta: {
            // requiresAuth: true,
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

/* ================= Admin Middleware router =================== */
// router.beforeEach((to, from, next) => {
//   document.title = to.meta.title || "Admin Panel";
//   if (
//     to.matched.some((record) => record.meta.requiresAuth) &&
//     !store.state.user.token
//   ) {
//     next({
//       name: "backend_login",
//     });
//   } else if (
//     to.matched.some((record) => record.meta.isGuest) &&
//     store.state.user.token
//   ) {
//     next({
//       name: "backend_dashboard",
//     });
//   } else {
//     next(); // make sure to always call next()!
//   }
// });
/* ================= Protected router =================== */

export default router;
