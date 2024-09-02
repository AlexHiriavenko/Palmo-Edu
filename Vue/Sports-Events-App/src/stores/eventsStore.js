import { getDocs, dbCollections, query } from '@/firebase'

const { basketballEvents } = dbCollections

export const useEventsStore = defineStore('eventsStore', () => {
  const events = ref([])
  const getEventsError = ref('')

  async function getEvents() {
    try {
      const q = query(basketballEvents)
      const querySnapshot = await getDocs(q)
      events.value = querySnapshot.docs.map((doc) => {
        return {
          id: doc.id,
          ...doc.data()
        }
      })
      return events.value
    } catch (e) {
      getEventsError.value = 'Error receiving sports events'
    }
  }

  return {
    events,
    getEvents
  }
})
