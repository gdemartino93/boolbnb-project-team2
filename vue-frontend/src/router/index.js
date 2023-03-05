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
    {
      path: '/forgot-password',
      name: 'forgotpassword',
      component: () => import('../components/auth/ForgotPassword.vue')
    },
    // {
    //   path: '/reset-password',
    //   name: 'resetpassword',
    //   component: () => import('../components/auth/ResetPassword.vue')
    // },
    
  ]
})

export default router

