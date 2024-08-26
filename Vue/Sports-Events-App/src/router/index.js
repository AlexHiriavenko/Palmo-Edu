import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import BookingEvents from '@/views/BookingEvents.vue'
import AdminPanel from '@/views/AdminPanel.vue'
import FavoritEvents from '@/views/FavoritEvents.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/booking',
      name: 'booking',
      component: BookingEvents
    },
    {
      path: '/favorites',
      name: 'favorites',
      component: FavoritEvents
    },
    {
      path: '/admin-panel',
      name: 'admin-panel',
      component: AdminPanel
    }
  ]
})

export default router
