<template>
  <v-card class="v-card-custom mx-auto" elevation="10">
    <v-card-text class="font-weight-bold text-center py-1">
      Category: <span class="text-blue-darken-1"> {{ event.category }}</span>
    </v-card-text>
    <v-card-title
      class="text-center font-weight-bold wrap-text"
      style="cursor: default"
    >
      {{ event.name }}
      <v-tooltip activator="parent" location="top">{{ event.name }}</v-tooltip>
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
    <v-card-text v-if="isBooking" class="font-weight-bold text-blue">
      Booked Seats: <span>{{ bookedSeats }}</span>
    </v-card-text>
    <v-card-actions class="justify-center">
      <v-btn
        @click="goToEventDetails"
        color="primary"
        text="More Details"
        class="font-weight-bold"
      />
      <v-btn @click="toggleFavorite" :color="buttonColor">
        <v-tooltip activator="parent" location="top"
          >add to Favorites</v-tooltip
        >
        <v-icon icon="mdi-heart"></v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>

  <ModalDialog ref="modalRef">
    <template #modal-content>
      <v-container class="d-flex flex-column align-center justify-center">
        <v-card-title class="text-h5">You need to LogIn</v-card-title>
        <v-spacer style="height: 20px"></v-spacer>
        <v-btn @click="modalRef.closeModal">OK</v-btn>
      </v-container>
    </template>
  </ModalDialog>
</template>

<script setup>
import { useUserStore } from '@/stores/userStore'
const userStore = useUserStore()
const router = useRouter()

const props = defineProps({
  event: {
    type: Object,
    required: true
  }
})

const isBooking = inject('isBooking', false)

const modalRef = ref(null)

const isFavorite = computed(
  () => userStore.currentUser?.favoriteEvents?.includes(props.event.id) ?? false
)
const buttonColor = computed(() =>
  isFavorite.value ? 'orange-lighten-1' : 'brown-lighten-4'
)

const bookedSeats = computed(() => {
  if (!userStore.isLoggedIn || !isBooking) return ''

  const targetEvent = userStore.currentUser?.bookedEvents.find(
    (event) => event.eventID === props.event.id
  )

  return targetEvent?.bookedSeats.join(', ') || ''
})

function goToEventDetails() {
  router.push({ name: 'event-details', params: { id: props.event.id } })
}

function toggleFavorite() {
  if (!userStore.isLoggedIn) {
    modalRef.value.openModal()
  }
  userStore.toggleFavorite(props.event.id)
}
</script>
