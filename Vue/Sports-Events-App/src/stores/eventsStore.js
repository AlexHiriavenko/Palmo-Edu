import { getEntitiesFromDB } from '@/firebase/getEntitiesFromDB'

export const useEventsStore = defineStore('eventsStore', () => {
  const events = ref([])
  const getEventsError = ref('')

  const getEvents = async () => {
    try {
      events.value = await getEntitiesFromDB('basketballEvents')
      return events.value
    } catch (e) {
      events.value = []
      getEventsError.value = 'Error receiving sports events'
    }
  }

  return {
    events,
    getEvents
  }
})
