<template>
  <LoaderSpinner :isLoading="isLoading" :size="70" color="white" />

  <div class="text-center pb-2">
    <DropMenu :items="categories" @itemClick="handleCategoryClick">
      <template #menuActivator="{ props }">
        <span v-bind="props" style="cursor: pointer">
          <v-btn variant="text" color="white" style="font-weight: 600"
            >Filter Events</v-btn
          >
          <v-icon icon="mdi-filter" color="white"></v-icon>
        </span>
      </template>
    </DropMenu>
  </div>

  <v-row style="max-width: 960px; min-height: 560px" class="mx-auto">
    <v-col v-for="event in paginatedEvents" :key="event.id" cols="12" md="4">
      <EventCard :event="event" />
    </v-col>
  </v-row>

  <PaginationBar
    v-if="events.length > itemsPerPage"
    v-model="page"
    :length="totalPages"
    :total-visible="6"
    @update:model-value="handlePageChange"
  />
</template>

<script setup>
import { useEventsStore } from '@/stores/eventsStore'
import { usePagination } from '@/composables/usePagination'
import PaginationBar from '@/components/general/PaginationBar.vue'
import EventCard from '@/components/EventCard.vue'
import DropMenu from './general/DropMenu.vue'

const props = defineProps({
  isLoading: Boolean,
  events: Array
})

const {
  page,
  paginatedItems: paginatedEvents,
  totalPages,
  handlePageChange,
  itemsPerPage
} = usePagination(computed(() => props.events))

const categories = [
  { text: 'Football', action: 'Football' },
  { text: 'Basketball', action: 'Basketball' },
  { text: 'Volleyball', action: 'Volleyball' },
  { text: 'All', action: '' }
]

const eventsStore = useEventsStore()

const handleCategoryClick = (category) => {
  eventsStore.setFilterBy(category.action)
}
</script>
