<template>
  <v-container>
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
import { useUserStore } from '@/stores/userStore'
import { useEventsStore } from '@/stores/eventsStore'
import { getEntityByID } from '@/firebase/getEntityByID'
import { useRoute } from 'vue-router'

const userStore = useUserStore()
const eventsStore = useEventsStore()
const route = useRoute()
const eventId = route.params.id

// Состояние события
const event = ref(null)

// Получаем событие из базы данных
async function getEvent() {
  try {
    event.value = await getEntityByID('sportsEvents', eventId)
  } catch (error) {
    console.error('Ошибка при получении события:', error)
  }
}

// Вызываем получение события при монтировании компонента
onMounted(getEvent)

const seatsParams = {
  totalSeats: 50,
  rows: 5,
  cellsInRow: 10
}

// Получаем список забронированных пользователем мест для текущего события
const userBookedSeats = computed(() => {
  const booking = userStore.currentUser?.bookedEvents.find(
    (b) => b.eventID === eventId
  )
  return booking ? booking.bookedSeats : []
})

// Инициализируем выбранные места с учетом уже забронированных пользователем
const selectedSeats = ref([])

// Обновляем выбранные места при изменении `userBookedSeats` или `event`
watch(
  () => [userBookedSeats.value, event.value],
  () => {
    if (event.value) {
      selectedSeats.value = [...userBookedSeats.value]
    }
  },
  { immediate: true }
)

const seats = computed(() => {
  if (!event.value) return []
  return Array.from({ length: seatsParams.totalSeats }, (_, index) => {
    const seatNumber = index + 1
    return {
      number: seatNumber,
      isOccupied:
        event.value.occupiedSeats.includes(seatNumber) &&
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
  } else {
    if (selectedSeats.value.length >= 4) {
      alert('Нельзя забронировать более 4 мест')
      return
    }
    selectedSeats.value.push(seat.number)
  }
}

// Метод для подтверждения бронирования
const confirmBooking = () => {
  if (!event.value) return

  // Обновляем состояние userStore для текущего пользователя
  const bookingIndex = userStore.currentUser.bookedEvents.findIndex(
    (b) => b.eventID === eventId
  )

  console.log(bookingIndex)
  if (bookingIndex !== -1) {
    // Если бронирование уже существует, обновляем его
    userStore.currentUser.bookedEvents[bookingIndex].bookedSeats =
      selectedSeats.value
  } else {
    // Если бронирование не существует, добавляем его
    userStore.currentUser.bookedEvents.push({
      eventID: eventId,
      bookedSeats: selectedSeats.value
    })
  }

  // Обновляем состояние eventsStore для текущего события
  const eventIndex = eventsStore.events.findIndex((e) => e.id === eventId)

  if (eventIndex !== -1) {
    eventsStore.events[eventIndex].occupiedSeats = [
      ...new Set([...event.value.occupiedSeats, ...selectedSeats.value])
    ]
  }

  alert('Бронирование подтверждено!')
}
</script>
