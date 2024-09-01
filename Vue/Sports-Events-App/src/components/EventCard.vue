<template>
  <v-card class="v-card-custom mx-auto" elevation="10">
    <v-card-title class="text-center font-weight-bold wrap-text">
      {{ event.name }}
    </v-card-title>
    <v-card-subtitle class="font-weight-bold">
      Price: {{ event.price }}
    </v-card-subtitle>
    <v-card-text class="font-weight-bold">
      Location: {{ event.location }}
    </v-card-text>
    <v-card-text v-formatdate="event.dateTime" class="font-weight-bold">
      Date:
    </v-card-text>
    <v-card-actions class="justify-center">
      <v-btn
        @click="goToEventDetails"
        color="primary"
        text="More Details"
        class="font-weight-bold"
      />
    </v-card-actions>
  </v-card>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { defineProps } from 'vue'

const router = useRouter()

const props = defineProps({
  event: {
    type: Object,
    required: true
  }
})

const goToEventDetails = () => {
  router.push({ name: 'event-details', params: { id: props.event.id } })
}
</script>
