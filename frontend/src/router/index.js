import VueRouter from 'vue-router'
import Vue from "vue";

const routes = [
  {
    path: "/",
    name: "login",
    component: () => import('../views/Login.vue'),
    meta: {
      auth: false,
      notFoundRedirect: { name: 'error-404' },
      forbiddenRedirect: function () {
        return '/';
      }
    }
  },

  {
    path: "/dashboard",
    name: "DashboardHome",
    component: () => import("../views/DashboardContainer.vue"),
    meta: {
      auth: false,
    },
    children: [
      {
        path: "/dashboard",
        name: "dashboard",
        component: () => import('../views/Dashboard.vue'),
        auth: false

      },
      {
        path: "/transaction-details",
        name: "Transaction",
        component: () => import('../views/Transaction.vue'),
        auth: false

      },
    ]
  },
];


const router = new VueRouter({
  mode: "history",
  routes,
  base: '/merchant-backoffice'
})

Vue.use(VueRouter)
export default router;









