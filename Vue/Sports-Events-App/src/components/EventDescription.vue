<template>
  <v-card elevation="3" class="pa-2 mx-auto event-details">
    <v-card-title class="text-h4 text-center">Event Details:</v-card-title>
    <v-card-text v-if="event">
      <v-row>
        <v-col cols="12" class="text-center d-flex justify-center align-center">
          <v-icon large class="mr-2">mdi-calendar</v-icon>
          <span class="text-h5 font-weight-bold">{{ event.name }}</span>
        </v-col>
        <v-col cols="12" class="text-center d-flex justify-center align-center">
          <v-icon large class="mr-2">mdi-currency-usd</v-icon>
          <span class="text-h6">Price: {{ event.price }}</span>
        </v-col>
        <v-col cols="12" class="text-center d-flex justify-center align-center">
          <v-icon large class="mr-2">mdi-map-marker</v-icon>
          <span class="text-h6">Location: {{ event.location }}</span>
        </v-col>
        <v-col cols="12" class="text-center d-flex justify-center align-center">
          <v-icon large class="mr-2">mdi-clock</v-icon>
          <span v-formatdate="event.dateTime" class="text-h6">Date:</span>
        </v-col>
      </v-row>
    </v-card-text>
    <v-card-actions class="justify-center">
      <v-btn color="white" @click="$emit('goBack')">Back to Events</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script setup>
defineProps({
  event: Object
})
</script>
