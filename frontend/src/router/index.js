import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import Login from "../views/Login.vue";
import NotFound from "../views/NotFound.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import store from "../store";

const routes = [
  {
    path: "/",
    name: "Login",
    component: Login,
    meta: { isGuest: true },
  },

  {
    path: "/dashboard",
    redirect: "/dashboard",
    component: DefaultLayout,
    meta: { requiresAuth: true },
    children: [
      { path: "/dashboard", name: "Dashboard", component: Dashboard },

      // { path: "/dashboard", name: "Dashboard", component: Dashboard },

      {
        path: "/users",
        component: () => import("../views/user/Index.vue"),
        name: "users",
        meta: {
          title: "User list",
        },
      },

      {
        path: "/user/create",
        component: () => import("../views/user/Create.vue"),
        name: "user_create",
        meta: {
          title: "User Create",
        },
      },

      {
        path: "/user/edit/:id",
        name: "user_edit",
        component: () => import("../views/user/Edit.vue"),
        meta: {
          title: "User Edit",
        },
      },


      // project

      {
        path: "/projects",
        component: () => import("../views/project/Index.vue"),
        name: "projects",
        meta: {
          title: "Project list",
        },
      },

      {
        path: "/project/create",
        component: () => import("../views/project/Create.vue"),
        name: "project_create",
        meta: {
          title: "Project Create",
        },
      },

      {
        path: "/project/edit/:id",
        name: "project_edit",
        component: () => import("../views/project/Edit.vue"),
        meta: {
          title: "Project Edit",
        },
      },


      // Tasks

      {
        path: "/tasks",
        component: () => import("../views/task/Index.vue"),
        name: "tasks",
        meta: {
          title: "Task list",
        },
      },

      {
        path: "/task/create",
        component: () => import("../views/task/Create.vue"),
        name: "task_create",
        meta: {
          title: "Task Create",
        },
      },

      {
        path: "/task/edit/:id",
        name: "task_edit",
        component: () => import("../views/task/Edit.vue"),
        meta: {
          title: "Task Edit",
        },
      },

      {
        path: "/task-user/edit/:id",
        name: "task_user",
        component: () => import("../views/task/TaskUpdate.vue"),
        meta: {
          title: "User Task",
        },
      },


      {
        path: "/task-import",
        name: "task_import",
        component: () => import("../views/task/TaskImport.vue"),
        meta: {
          title: "User Task",
        },
      },

      


      // end 
    ],
  },

  {
    path: "/404",
    name: "NotFound",
    component: NotFound,
  },
];

// const router = createRouter({
//   history: createWebHistory(),
//   routes,
// });


const router = createRouter({
  history: createWebHistory(),
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
  document.title = to.meta.title || "Admin Panel";
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: "Login" });
  } else if (store.state.user.token && to.meta.isGuest) {
    next({ name: "Dashboard" });
  } else {
    next();
  }
});

export default router;
