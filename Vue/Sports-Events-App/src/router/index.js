import { createRouter, createWebHistory } from 'vue-router'
import { useUserStore } from '@/stores/userStore'
import HomeView from '../views/HomeView.vue'
import BookingEvents from '@/views/BookingEvents.vue'
import AdminPanel from '@/views/AdminPanel.vue'
import FavoriteEvents from '@/views/FavoriteEvents.vue'
import NotFound from '@/views/NotFound.vue'
import EventDetails from '@/views/EventDetails.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta: { title: 'Home', showInTabs: true }
  },
  {
    path: '/favorites',
    name: 'favorites',
    component: FavoriteEvents,
    meta: { title: 'Favorites', requiresAuth: true, showInTabs: true }
  },
  {
    path: '/booking',
    name: 'booking',
    component: BookingEvents,
    meta: { title: 'Booking', requiresAuth: true, showInTabs: true }
  },
  {
    path: '/admin-panel',
    name: 'admin-panel',
    component: AdminPanel,
    meta: { title: 'Admin', showInTabs: true }
  },
  {
    path: '/event/:id',
    name: 'event-details',
    component: EventDetails,
    props: true,
    meta: { title: 'Event Details', showInTabs: false }
  },
  {
    path: '/auth-required',
    name: 'auth-required',
    component: NotFound,
    meta: { title: 'Authorization Required', showInTabs: false }
  },
  {
    path: '/:catchAll(.*)',
    name: 'not-found',
    component: NotFound,
    meta: { title: '404', showInTabs: false }
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: routes
})

router.beforeEach((to, from, next) => {
  const userStore = useUserStore()
  const isLoggedIn = userStore.isLoggedIn

  if (to.meta.requiresAuth && !isLoggedIn) {
    // query - чтобы отследить куда хотел попать юзер и после логина редиректнуть именно туда
    next({ name: 'auth-required', query: { redirect: to.fullPath } })
  } else {
    next()
  }
})

export default router
