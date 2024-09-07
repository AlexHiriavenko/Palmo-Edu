<template>
  <v-container>
    <!-- Сетка мест -->
    <v-row v-for="row in rows" :key="row">
      <v-col
        v-for="seat in getSeatsForRow(row)"
        :key="seat.number"
        cols="1"
        class="d-flex justify-center align-center"
      >
        <v-btn :color="getSeatColor(seat)" @click="selectSeat(seat)">
          {{ seat.number }}
        </v-btn>
      </v-col>
    </v-row>
    <v-btn color="primary" @click="confirmBooking"
      >Подтвердить бронирование</v-btn
    >
  </v-container>
</template>

<script setup>
import { ref, computed, defineProps } from 'vue'
import { useUserStore } from '@/stores/userStore'
import { useEventsStore } from '@/stores/eventsStore'
import { getEntityByID } from '@/firebase/getEntityByID'

///////////////////////////////
const route = useRoute()
const eventId = route.params.id

async function getEvent() {
  const event = await getEntityByID('sportsEvents', eventId)
  console.log(event) // я проверил у меня получилось получить данные
}

getEvent()
//////////////////////////////

const props = defineProps({
  event: Object
})

const userStore = useUserStore()
const eventsStore = useEventsStore()

const seatsParams = {
  totalSeats: 50,
  rows: 5,
  cellsInRow: 10
}

// Получаем список забронированных пользователем мест для текущего события
const userBookedSeats = computed(() => {
  const booking = userStore.currentUser?.bookedEvents.find(
    (b) => b.eventID === props.event?.id
  )
  return booking ? booking.bookedSeats : []
})

// Инициализируем выбранные места с учетом уже забронированных пользователем
const selectedSeats = ref([...userBookedSeats.value])
console.log(selectedSeats)

const seats = computed(() => {
  return Array.from({ length: seatsParams.totalSeats }, (_, index) => {
    const seatNumber = index + 1
    return {
      number: seatNumber,
      isOccupied:
        props.event?.occupiedSeats.includes(seatNumber) &&
        !userBookedSeats.value.includes(seatNumber), // Занятое место (кроме заняты пользователем)
      isOccupiedByUser: userBookedSeats.value.includes(seatNumber), // Занятое место пользователем
      isSelected: selectedSeats.value.includes(seatNumber)
    }
  })
})

const rows = computed(() =>
  Array.from({ length: seatsParams.rows }, (_, i) => i + 1)
)

// Метод для получения мест для текущего ряда
const getSeatsForRow = (row) => {
  const startIndex = (row - 1) * seatsParams.cellsInRow
  const endIndex = row * seatsParams.cellsInRow
  return seats.value.slice(startIndex, endIndex)
}

// Метод для определения цвета кнопки в зависимости от состояния места
const getSeatColor = (seat) => {
  if (seat.isSelected) return 'green' // Зеленый, если занято пользователем или выбрано
  if (seat.isOccupied && !seat.isSelected) return 'orange' // Оранжевый, если занято другим пользователем
  return 'white' // Белый, если свободно
}

const selectSeat = (seat) => {
  // Проверка авторизации
  if (!userStore.isLoggedIn) {
    alert('Пожалуйста, залогиньтесь, чтобы забронировать место.')
    return
  }

  // Проверка, если место занято другим пользователем
  if (seat.isOccupied && !seat.isOccupiedByUser) {
    alert(
      'Это место нельзя забронировать, оно уже забронировано другим пользователем'
    )
    return
  }

  // Логика для отмены или выбора места
  if (seat.isSelected) {
    selectedSeats.value = selectedSeats.value.filter((s) => s !== seat.number)
    console.log(selectedSeats.value)
  } else {
    if (selectedSeats.value.length >= 4) {
      alert('Нельзя забронировать более 4 мест')
      return
    }
    selectedSeats.value.push(seat.number)
    console.log(selectedSeats.value)
  }
}

// Метод для подтверждения бронирования
const confirmBooking = () => {
  // Обновляем состояние userStore для текущего пользователя
  const bookingIndex = userStore.currentUser.bookedEvents.findIndex(
    (b) => b.eventID === props.event.id
  )

  if (bookingIndex !== -1) {
    // Если бронирование уже существует, обновляем его
    userStore.currentUser.bookedEvents[bookingIndex].bookedSeats =
      selectedSeats.value
  } else {
    // Если бронирование не существует, добавляем его
    userStore.currentUser.bookedEvents.push({
      eventID: props.event.id,
      bookedSeats: selectedSeats.value
    })
  }

  // Обновляем состояние eventsStore для текущего события
  const eventIndex = eventsStore.events.findIndex(
    (e) => e.id === props.event.id
  )

  if (eventIndex !== -1) {
    eventsStore.events[eventIndex].occupiedSeats = [
      ...new Set([...props.event.occupiedSeats, ...selectedSeats.value])
    ]
  }

  alert('Бронирование подтверждено!')
}
</script>
