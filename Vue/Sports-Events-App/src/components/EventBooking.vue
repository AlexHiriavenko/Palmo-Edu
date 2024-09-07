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
  </v-container>
</template>

<script setup>
import { ref, computed, defineProps } from 'vue'
import { useUserStore } from '@/stores/userStore' // Подключаем userStore для получения данных о бронированиях пользователя

const props = defineProps({
  event: Object
})

const userStore = useUserStore() // Получаем доступ к userStore

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

const seats = computed(() => {
  return Array.from({ length: seatsParams.totalSeats }, (_, index) => {
    const seatNumber = index + 1
    return {
      number: seatNumber,
      isOccupied: props.event?.occupiedSeats.includes(seatNumber), // Занятое место (в общем)
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
  if (seat.isOccupiedByUser || seat.isSelected) return 'green' // Зеленый, если занято пользователем или выбрано
  if (seat.isOccupied) return 'orange' // Оранжевый, если занято другим пользователем
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

  // Проверка, если место уже выбрано пользователем
  if (seat.isSelected) {
    selectedSeats.value = selectedSeats.value.filter((s) => s !== seat.number)
  } else {
    // Проверка на лимит в 4 места
    const totalSelected =
      selectedSeats.value.length + userBookedSeats.value.length
    if (totalSelected >= 4) {
      alert('Нельзя забронировать более 4 мест')
      return
    }
    selectedSeats.value.push(seat.number)
  }
}
</script>
