import { createRouter, createWebHistory } from 'vue-router'
import { useUserStore } from '@/stores/userStore'
import HomeView from '../views/HomeView.vue'
import BookingEvents from '@/views/BookingEvents.vue'
import AdminPanel from '@/views/AdminPanel.vue'
import FavoriteEvents from '@/views/FavoriteEvents.vue'
import NotFound from '@/views/NotFound.vue'
import EventDetails from '@/views/EventDetails.vue'
import EditEvent from '@/components/events/EditEvent.vue'
import CreateEvent from '@/components/events/CreateEvent.vue'

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
    },
    children: [
      {
        path: 'edit-event',
        name: 'edit-event',
        component: EditEvent,
        meta: { title: 'Edit Event', requiresAuth: true, requiresAdmin: true }
      },
      {
        path: 'create-event',
        name: 'create-event',
        component: CreateEvent,
        meta: { title: 'Create Event', requiresAuth: true, requiresAdmin: true }
      }
    ]
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

  if (to.meta.requiresAuth) {
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

    if (!userStore.isLoggedIn) {
      next({ name: 'auth-required', query: { redirect: to.fullPath } })
      return
    }

    if (to.meta.requiresAdmin && userStore.currentUser.role !== 'admin') {
      next({ name: 'admin-required', query: { redirect: to.fullPath } })
      return
    }
  }

  next()
})

export default router
