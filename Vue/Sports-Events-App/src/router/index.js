import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import BookingEvents from '@/views/BookingEvents.vue'
import AdminPanel from '@/views/AdminPanel.vue'
import FavoriteEvents from '@/views/FavoriteEvents.vue'
import NotFound from '@/views/NotFound.vue'
import EventDetails from '@/views/EventDetails.vue' // Добавьте импорт страницы карточки

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
    meta: { title: 'Favorites', showInTabs: true }
  },
  {
    path: '/booking',
    name: 'booking',
    component: BookingEvents,
    meta: { title: 'Booking', showInTabs: true }
  },
  {
    path: '/admin-panel',
    name: 'admin-panel',
    component: AdminPanel,
    meta: { title: 'Admin', showInTabs: true }
  },
  {
    path: '/event/:id', // Новый маршрут для страницы карточки
    name: 'event-details',
    component: EventDetails,
    props: true,
    meta: { title: 'Event Details', showInTabs: false }
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

export default router
