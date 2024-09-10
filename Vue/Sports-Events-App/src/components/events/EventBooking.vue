<template>
  <v-container class="booking-container mx-auto">
    <v-container class="info-container mb-4">
      <v-row class="justify-center" :class="{ notEditable: !editable }">
        <v-col cols="4" class="text-center">
          <v-avatar color="green" size="24" class="ma-2"></v-avatar>
          <span class="booking-info">Booked by you</span>
        </v-col>

        <v-col cols="4" class="text-center">
          <v-avatar color="orange" size="24" class="ma-2"></v-avatar>
          <span class="booking-info">Occupied by others</span>
        </v-col>

        <v-col cols="4" class="text-center">
          <v-avatar color="white" size="24" class="ma-2"></v-avatar>
          <span class="booking-info">Available</span>
        </v-col>
      </v-row>
    </v-container>

    <v-container :class="{ notEditable: !editable }" class="seats-container">
      <v-row v-for="row in rows" :key="row" class="justify-space-between">
        <div
          v-for="seat in getSeatsForRow(row)"
          :key="seat.number"
          class="seat"
        >
          <v-btn :color="getSeatColor(seat)" @click="selectSeat(seat)">
            {{ seat.number }}
          </v-btn>
        </div>
      </v-row>
    </v-container>

    <v-container v-if="userStore.isLoggedIn" class="booking-btngroup">
      <v-btn
        color="primary"
        @click="confirmBooking"
        :disabled="!editable"
        style="width: 110px"
      >
        Confirm
      </v-btn>
      <v-btn
        color="primary"
        @click="editBookingClick"
        :disabled="editable"
        style="width: 110px"
      >
        Edit
      </v-btn>
    </v-container>
  </v-container>

  <ModalDialog ref="modalRef">
    <template #modal-content>
      <v-container class="text-center">
        <v-card-text class="text-h5">{{ currentMessage }}</v-card-text>
        <v-btn @click="closeModal">OK</v-btn>
      </v-container>
    </template>
  </ModalDialog>
</template>

<script setup>
import { useUserStore } from '@/stores/userStore'
import { useEventsStore } from '@/stores/eventsStore'

const userStore = useUserStore()
const eventsStore = useEventsStore()
const route = useRoute()
const eventId = route.params.id

const event = ref(null)
const selectedSeats = ref([])
const editable = ref(false)
const modalRef = ref(null)
const currentMessage = ref('')

function showModal(message) {
  currentMessage.value = message
  modalRef.value.openModal()
}

function closeModal() {
  modalRef.value.closeModal()
}

const seatsParams = {
  totalSeats: 50,
  rows: 5,
  cellsInRow: 10
}

const userBookedSeats = computed(
  () =>
    userStore.currentUser?.bookedEvents.find((b) => b.eventID === eventId)
      ?.bookedSeats || []
)

const seats = computed(() => {
  if (!event.value) return []
  return Array.from({ length: seatsParams.totalSeats }, (_, index) => {
    const seatNumber = index + 1
    return {
      number: seatNumber,
      isOccupied:
        event.value.occupiedSeats.includes(seatNumber) &&
        !userBookedSeats.value.includes(seatNumber), // место занято не юзером а кем-то другим
      isOccupiedByUser: userBookedSeats.value.includes(seatNumber), // место занято юзером
      isSelected: selectedSeats.value.includes(seatNumber) // место выбрано юзером
    }
  })
})

const rows = computed(() =>
  Array.from({ length: seatsParams.rows }, (_, i) => i + 1)
)

const getSeatsForRow = (row) => {
  const startIndex = (row - 1) * seatsParams.cellsInRow
  const endIndex = row * seatsParams.cellsInRow

  return seats.value.slice(startIndex, endIndex)
}

const getSeatColor = (seat) => {
  if (userStore.isLoggedIn && seat.isSelected) return 'green'
  if (seat.isOccupied) return 'orange'
  return 'white'
}

function editBookingClick() {
  editable.value = true
}

async function confirmBooking() {
  if (!event.value) return

  // Удаляем старые места, забронированные пользователем ранее
  const updatedOccupiedSeats = event.value.occupiedSeats.filter(
    (seat) => !userBookedSeats.value.includes(seat)
  )

  // Добавляем новые места, забронированные пользователем
  updatedOccupiedSeats.push(...selectedSeats.value)

  // Обновляем состояние событий и отправляем данные на сервер
  await eventsStore.setOccupiedSeatsByID(eventId, [
    ...new Set(updatedOccupiedSeats)
  ])

  // Обновляем локальное состояние события (event) после изменения
  event.value.occupiedSeats = [...new Set(updatedOccupiedSeats)]

  const bookingData = {
    eventID: eventId,
    bookedSeats: selectedSeats.value
  }

  // Обновляем состояние пользователя и отправляем данные на сервер
  userStore.setUserBookedEvent(eventId, bookingData)

  // Запрещаем редактирование
  editable.value = false
  if (!selectedSeats.value.length) {
    showModal('Забронировано: 0 мест. Бронирование отменено')
  }
  if (selectedSeats.value.length) {
    showModal('Бронирование подтверждено!')
  }
}

const selectSeat = (seat) => {
  if (!userStore.isLoggedIn) {
    showModal('Пожалуйста, залогиньтесь, чтобы забронировать место.')
    return
  }
  if (seat.isOccupied && !seat.isOccupiedByUser) {
    showModal(
      'Это место нельзя забронировать, оно уже забронировано другим пользователем'
    )
    return
  }
  if (seat.isSelected) {
    selectedSeats.value = selectedSeats.value.filter((s) => s !== seat.number)
  } else {
    if (selectedSeats.value.length >= 4) {
      showModal('Нельзя забронировать более 4 мест')
      return
    }
    selectedSeats.value.push(seat.number)
  }
}

onMounted(async () => {
  event.value = await eventsStore.getEventFromDB(eventId)
  editable.value = !userBookedSeats.value.length
})

watch(
  () => [event.value],
  () => {
    if (event.value) {
      selectedSeats.value = [...userBookedSeats.value]
    }
  },
  { immediate: true }
)
</script>
