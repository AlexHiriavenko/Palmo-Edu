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
    meta: {
      title: 'Admin',
      requiresAuth: true,
      requiresAdmin: true,
      showInTabs: false
    }
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
    path: '/admin-required',
    name: 'admin-required',
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

router.beforeEach(async (to, from, next) => {
  const userStore = useUserStore()

  // Проверяем, требуется ли авторизация для маршрута
  if (to.meta.requiresAuth) {
    // Дождемся, пока флаг авторизации не будет установлен в true
    if (!userStore.isAuthReady) {
      await new Promise((resolve) => {
        const unwatch = watch(
          () => userStore.isAuthReady,
          (ready) => {
            if (ready) {
              unwatch()
              resolve()
            }
          }
        )
      })
    }

    // Проверяем, авторизован ли пользователь
    if (!userStore.isLoggedIn) {
      next({ name: 'auth-required', query: { redirect: to.fullPath } })
      return
    }

    // Проверяем, если маршрут требует права администратора
    if (to.meta.requiresAdmin && userStore.currentUser.role !== 'admin') {
      next({ name: 'admin-required' })
      return
    }
  }

  next() // все проверки пройдены
})

export default router
