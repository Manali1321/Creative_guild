import { createRouter, createWebHistory } from 'vue-router'
import SignIn from '../views/SignInView.vue'
import SignupView from '../views/SignUpView.vue'
import ChangePasswordView from '../views/ChangePasswordView.vue'
import ResetPasswordView from '../views/ResetPasswordView.vue'
import ProfileView from '../views/ProfileView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: SignIn
    },
    {
      path: '/profile/:id',
      name: 'profile',
      component: ProfileView
    },
    {
      path: '/signup',
      name: 'signup',
      component: SignupView
    },
    {
      path: '/change_password',
      name: 'changePassword',
      component: ChangePasswordView
    },
    {
      path: '/reset_password',
      name: 'resetPassword',
      component: ResetPasswordView
    }
  ]
})

export default router
