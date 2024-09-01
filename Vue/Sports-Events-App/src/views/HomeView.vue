<template>
  <v-container fluid class="views">
    <h2 class="text-h3 text-white text-center py-4">Upcoming events</h2>
    <LoaderSpinner :isLoading="isLoading" :size="70" color="white" />
    <v-row style="max-width: 960px; min-height: 600px" class="mx-auto">
      <v-col v-for="event in paginatedEvents" :key="event.id" cols="12" md="4">
        <EventCard :event="event" />
      </v-col>
    </v-row>
    <div class="text-xs-center">
      <PaginationBar
        v-if="eventsStore.events.length"
        v-model="page"
        :length="totalPages"
        :total-visible="6"
        @update:model-value="handlePageChange"
      />
    </div>
  </v-container>
</template>

<script setup>
import { useEventsStore } from '@/stores/eventsStore'
import PaginationBar from '@/components/PaginationBar.vue'
import EventCard from '@/components/EventCard.vue'

const eventsStore = useEventsStore()
const page = ref(1)
const itemsPerPage = 6
const isLoading = ref(false)

const paginatedEvents = computed(() => {
  const start = (page.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return eventsStore.events.slice(start, end)
})

const totalPages = computed(() => {
  const total = Math.ceil(eventsStore.events.length / itemsPerPage)
  return total
})

function handlePageChange(newPage) {
  page.value = newPage
}

onMounted(async () => {
  if (!eventsStore.events.length) {
    isLoading.value = true
    await eventsStore.getEvents()
    isLoading.value = false
  }
})
</script>
