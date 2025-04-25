import { createRouter, createWebHistory } from "vue-router";
import Index from "../pages/Index.vue"; // Import halaman-halaman Vue yang ada
import NotFound from "../pages/notFound/NotFound.vue";
import Login from "../pages/auth/Login.vue";
import Register from "../pages/auth/Register.vue";
import Dashboard from "../pages/dashboard/Index.vue";
import DashboardAdmin from "../pages/dashboardAdmin/Index.vue";
const routes = [
  {
    path: "/",
    name: "home",
    component: Index,
  },
  {
    path: "/login",
    name: "login",
    component: Login,
  },
  {
    path: "/register",
    name: "register",
    component: Register,
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: Dashboard,
  },
  {
    path: "/dashboard-admin",
    name: "dashboard-admin",
    component: DashboardAdmin,
  },
  { path: "/:pathMatch(.*)*", component: NotFound },

  // Tambahkan rute lainnya sesuai kebutuhan
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
