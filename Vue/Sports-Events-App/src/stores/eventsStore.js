import { getEntitiesFromDB } from '@/firebase/getEntitiesFromDB'
import { useUserStore } from './userStore'
import { getEntityByID } from '@/firebase/getEntityByID'
import { setEntityInDB } from '@/firebase/setEntityInDB'

export const useEventsStore = defineStore('eventsStore', () => {
  const events = ref([])
  const getEventsError = ref('')
  const userStore = useUserStore()

  const favoritesEvents = computed(() => {
    return events.value.filter((event) => {
      return userStore.currentUser?.favoriteEvents?.includes(event.id)
    })
  })

  const bookedEvents = computed(() => {
    const userBookedEventIDs =
      userStore.currentUser?.bookedEvents.map(
        (bookedEvent) => bookedEvent.eventID
      ) || []

    return events.value.filter((event) => userBookedEventIDs.includes(event.id))
  })

  async function getEvents() {
    try {
      events.value = await getEntitiesFromDB('sportsEvents')
      return events.value
    } catch (e) {
      events.value = []
      getEventsError.value = 'Error receiving sports events'
    }
  }

  async function getEventFromDB(eventID) {
    return getEntityByID('sportsEvents', eventID)
  }

  async function writeEventToDB(eventID, updatedEvent) {
    setEntityInDB('sportsEvents', eventID, updatedEvent)
  }

  function setOccupiedSeatsByID(eventID, occupiedSeats) {
    const eventIndex = events.value.findIndex((e) => e.id === eventID)

    if (eventIndex !== -1) {
      events.value[eventIndex].occupiedSeats = occupiedSeats

      writeEventToDB(eventID, events.value[eventIndex])
    }
  }

  return {
    events,
    getEvents,
    favoritesEvents,
    bookedEvents,
    getEventFromDB,
    setOccupiedSeatsByID
  }
})
