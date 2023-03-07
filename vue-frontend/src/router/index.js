import { createRouter, createWebHistory } from 'vue-router'
import Home from '../components/Home.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../components/auth/Login.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../components/auth/Register.vue')
    },
    // {
    //   path: '/apartments/:id/:title/:description/:room_number/:bed_number/:bath_number/:square_meters/:address/:latitude/:longitude/:visible/:img',
    //   name: 'view',
    //   component: () => import('../components/ViewCard.vue'),
    // },
    {
      path: '/apartment/:id',
      name: 'show',
      component: () => import('../components/ViewCard.vue'),


    },
    {
      path: '/forgot-password',
      name: 'forgotpassword',
      component: () => import('../components/auth/ForgotPassword.vue')
    },
    {
      path: '/password-reset/:token',
      name: 'resetpassword',
      component: () => import('../components/auth/ResetPassword.vue')
    },
    {
      path: '/dashboard/:id',
      name: 'dashboard',
      component: () => import('../components/auth/Dashboard.vue')
    },
    {
      path: '/dashboard/apartment/new',
      name: 'addApt',
      component: () => import('../components/auth/AddApt.vue')
    },
    {
      path: '/dashboard/apartment/edit',
      name: 'editApt',
      component: () => import('../components/auth/EditApt.vue')
    }

  ]
})

export default router

