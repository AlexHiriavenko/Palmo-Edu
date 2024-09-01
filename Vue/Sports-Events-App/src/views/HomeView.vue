<template>
  <v-container fluid class="views">
    <v-row g-4>
      <v-col
        v-for="event in eventsStore.events"
        :key="event.id"
        cols="12"
        md="4"
      >
        <v-card class="v-card-custom" elevation="10">
          <v-card-title class="text-center font-weight-bold">
            {{ event.name }}
          </v-card-title>
          <v-card-subtitle class="font-weight-bold"
            >Price: {{ event.price }}</v-card-subtitle
          >
          <v-card-text class="font-weight-bold"
            >Location: {{ event.location }}</v-card-text
          >
          <v-card-text v-formatdate="event.dateTime" class="font-weight-bold"
            >Date:</v-card-text
          >
          <v-card-actions class="justify-center">
            <v-btn
              color="primary"
              text="More Details"
              class="font-weight-bold"
            />
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { useEventsStore } from '@/stores/eventsStore'

const eventsStore = useEventsStore()

onMounted(() => {
  eventsStore.getEvents()
})
</script>
