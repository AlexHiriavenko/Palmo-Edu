import { getEntitiesFromDB } from '@/firebase/getEntitiesFromDB'

export const useEventsStore = defineStore('eventsStore', () => {
  const events = ref([])
  const getEventsError = ref('')
  const filterBy = ref('')

  const getEvents = async () => {
    try {
      events.value = await getEntitiesFromDB('sportsEvents')
      return events.value
    } catch (e) {
      events.value = []
      getEventsError.value = 'Error receiving sports events'
    }
  }

  const setFilterBy = (criteria) => (filterBy.value = criteria)

  const filteredEvents = computed(() => {
    if (!filterBy.value || !events.value.length) {
      return events.value
    }
    return events.value.filter((event) => event?.category === filterBy.value)
  })

  return {
    events,
    filteredEvents,
    getEvents,
    setFilterBy
  }
})
