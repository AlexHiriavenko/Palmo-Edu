import { db, getDocs, collection, dbCollections, query } from '@/firebase'

const { basketballEvents } = dbCollections

export const useEventsStore = defineStore('eventsStore', () => {
  const events = ref([])
  const getEventsError = ref('')

  async function getEvents() {
    try {
      const eventsRef = collection(db, basketballEvents)
      const q = query(eventsRef)
      const querySnapshot = await getDocs(q)
      events.value = querySnapshot.docs.map((doc) => {
        return {
          id: doc.id,
          ...doc.data()
        }
      })
      console.log(events)
    } catch (e) {
      getEventsError.value = 'Error receiving sports events'
    }
  }

  return {
    events,
    getEvents
  }
})
