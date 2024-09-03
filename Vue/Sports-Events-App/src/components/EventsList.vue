<template>
  <LoaderSpinner :isLoading="isLoading" :size="70" color="white" />
  <v-row style="max-width: 960px; min-height: 600px" class="mx-auto">
    <v-col v-for="event in paginatedEvents" :key="event.id" cols="12" md="4">
      <EventCard :event="event" />
    </v-col>
  </v-row>
  <div class="text-xs-center">
    <PaginationBar
      v-if="events.length > itemsPerPage"
      v-model="page"
      :length="totalPages"
      :total-visible="6"
      @update:model-value="handlePageChange"
    />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import PaginationBar from '@/components/general/PaginationBar.vue'
import EventCard from '@/components/EventCard.vue'

// Правильное использование defineProps
const props = defineProps({
  isLoading: Boolean,
  events: Array
})

const page = ref(1)
const itemsPerPage = 6

const paginatedEvents = computed(() => {
  const start = (page.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return props.events.slice(start, end)
})

const totalPages = computed(() => {
  return Math.ceil(props.events.length / itemsPerPage)
})

function handlePageChange(newPage) {
  page.value = newPage
}
</script>
