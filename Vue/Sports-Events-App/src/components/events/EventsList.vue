<template>
  <LoaderSpinner :isLoading="isLoading" :size="70" color="white" />

  <div v-show="events.length" class="text-center pb-2">
    <DropMenu :items="categories" v-model="filterBy">
      <template #menuActivator="{ props }">
        <span v-bind="props" style="cursor: pointer">
          <v-btn variant="text" color="white" style="font-weight: 600">
            Filter By: {{ filterBy || 'All' }}
          </v-btn>
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
import { usePagination } from '@/composables/usePagination'
import PaginationBar from '@/components/general/PaginationBar.vue'
import EventCard from '@/components/events/EventCard.vue'
import DropMenu from '@/components/general/DropMenu.vue'

const props = defineProps({
  isLoading: Boolean,
  events: Array
})

const filterBy = ref('')

const filteredEvents = computed(() => {
  if (!filterBy.value || !props.events.length) {
    return props.events
  }
  return props.events.filter((event) => event?.category === filterBy.value)
})

const categories = [
  { text: 'Football', action: 'Football' },
  { text: 'Basketball', action: 'Basketball' },
  { text: 'Volleyball', action: 'Volleyball' },
  { text: 'All', action: '' }
]

const {
  page,
  paginatedItems: paginatedEvents,
  totalPages,
  handlePageChange,
  itemsPerPage
} = usePagination(filteredEvents)

watch(filterBy, () => (page.value = 1))
</script>
