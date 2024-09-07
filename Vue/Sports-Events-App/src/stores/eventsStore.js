import { getEntitiesFromDB } from '@/firebase/getEntitiesFromDB'
import { useUserStore } from './userStore'

export const useEventsStore = defineStore('eventsStore', () => {
  const events = ref([])
  const getEventsError = ref('')
  const currentEvent = ref({})
  const userStore = useUserStore()

  const getEvents = async () => {
    try {
      events.value = await getEntitiesFromDB('sportsEvents')
      return events.value
    } catch (e) {
      events.value = []
      getEventsError.value = 'Error receiving sports events'
    }
  }

  const favoritesEvents = computed(() => {
    return events.value.filter((event) => {
      return userStore.currentUser?.favoriteEvents?.includes(event.id)
    })
  })

  function setCurrentEvent(event) {
    currentEvent.value = event
  }

  return {
    events,
    getEvents,
    favoritesEvents,
    setCurrentEvent
  }
})
