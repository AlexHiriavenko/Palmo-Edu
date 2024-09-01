<template>
  <v-container>
    <v-row justify="center" class="py-4">
      <v-col cols="12" md="8" lg="6">
        <v-card elevation="3" class="pa-4">
          <v-card-title class="text-h4 text-center">Event Details</v-card-title>
          <v-card-text v-if="event">
            <v-row>
              <v-col cols="12" class="text-center mb-2">
                <v-icon large class="mr-2">mdi-calendar</v-icon>
                <span class="text-h5 font-weight-bold">{{ event.name }}</span>
              </v-col>
              <v-col cols="12" class="text-center mb-2">
                <v-icon large class="mr-2">mdi-currency-usd</v-icon>
                <span class="text-h6">Price: {{ event.price }}</span>
              </v-col>
              <v-col cols="12" class="text-center mb-2">
                <v-icon large class="mr-2">mdi-map-marker</v-icon>
                <span class="text-h6">Location: {{ event.location }}</span>
              </v-col>
              <v-col cols="12" class="text-center mb-2">
                <v-icon large class="mr-2">mdi-clock</v-icon>
                <span v-formatdate="event.dateTime" class="text-h6">Date:</span>
              </v-col>
            </v-row>
          </v-card-text>
          <v-card-text v-else class="text-center">
            <v-progress-circular
              indeterminate
              color="primary"
              class="ma-4"
            ></v-progress-circular>
            <p>Loading event details...</p>
          </v-card-text>
          <v-card-actions class="justify-center">
            <v-btn color="primary" @click="goBack">Back to Events</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { useEventsStore } from '@/stores/eventsStore'

const route = useRoute()
const router = useRouter()
const eventsStore = useEventsStore()
const eventId = route.params.id

const event = computed(() => {
  return eventsStore.events.find((e) => e.id === eventId)
})

const goBack = () => {
  router.push({ name: 'home' })
}

onMounted(async () => {
  if (!event.value) {
    await eventsStore.getEvents()
  }
})
</script>
