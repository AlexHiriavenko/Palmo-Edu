<template>
  <v-container class="event-container">
    <EventDescription :event="event" @goBack="goBack" />
    <EventBooking />
  </v-container>
</template>

<script setup>
import { useEventsStore } from '@/stores/eventsStore'
import EventDescription from '@/components/events/EventDescription.vue'
import EventBooking from '@/components/events/EventBooking.vue'

const route = useRoute()
const router = useRouter()
const eventsStore = useEventsStore()
const eventId = route.params.id

const event = computed(() => eventsStore.events.find((e) => e.id === eventId))

const goBack = () => router.push({ name: 'home' })

onMounted(() => {
  if (!event.value) eventsStore.getEvents()
})
</script>
