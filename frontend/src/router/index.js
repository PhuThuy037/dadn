import { createRouter, createWebHistory } from 'vue-router'

import SignUp from "@/pages/SignUp.vue";
import Login from "@/pages/Login.vue";
import HomeView from "@/pages/HomeView.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import RoomDetail from "@/components/RoomDetail.vue";
import AddRoom from "@/components/AddRoom.vue";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta: { layout: AuthLayout },
    },
    {
      path: '/signup',
      name: 'Signup',
      component: SignUp,
      meta: { layout: AuthLayout },
    },

    {
      path: '/',
      name: 'home',
      meta: { layout: DefaultLayout },
      component: HomeView,
    },
    {
      path: '/rooms/:id',
      name: 'RoomDetail',
      meta: { layout: DefaultLayout },
      component: RoomDetail,
    },
    {
      path: '/room/add',
      name: 'AddRoom',
      meta: { layout: DefaultLayout },
      component: AddRoom,
    },

  ],
})

export default router
