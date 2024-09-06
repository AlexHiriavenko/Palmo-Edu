<template>
  <v-container fluid class="views">
    <h2 class="text-h3 text-white text-center py-4">
      {{ eventsStore.getEventsError || 'Upcoming events' }}
    </h2>
    <EventsList :isLoading="isLoading" :events="eventsStore.favoritesEvents" />
  </v-container>
</template>

<script setup>
import { useEventsStore } from '@/stores/eventsStore'
import EventsList from '@/components/EventsList.vue'

const eventsStore = useEventsStore()
const isLoading = ref(false)

console.log(eventsStore.favoritesEvents)

onMounted(async () => {
  if (!eventsStore.events.length) {
    isLoading.value = true
    await eventsStore.getEvents()
    isLoading.value = false
  }
})
</script>
