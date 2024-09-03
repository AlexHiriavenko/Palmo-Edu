import './assets/styles/main.css'
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'

import { createVuetify } from 'vuetify'
import directives from './directives'
import ModalDialog from '@/components/general/ModalDialog.vue'
import LoaderSpinner from './components/general/LoaderSpinner.vue'

import App from './App.vue'
import router from './router'

const vuetify = createVuetify({
  icons: {
    defaultSet: 'mdi',
    iconfont: 'mdi'
  }
})

const app = createApp(App)

app
  .use(vuetify)
  .use(createPinia())
  .use(router)
  .component('ModalDialog', ModalDialog)
  .component('LoaderSpinner', LoaderSpinner)

directives.forEach((directive) => {
  app.directive(directive.name, directive)
})

app.mount('#app')

import { db } from './firebase'
import { collection, addDoc } from 'firebase/firestore'

let classificationName = 'Volleyball'
let country = 'US'
let apiKey = 'LDRn3cJuA58ULBA8p8CA89FVdohz6tZK'
let url = `https://app.ticketmaster.com/discovery/v2/events.json?countryCode=${country}&classificationName=${classificationName}&page=0&size=20&apikey=${apiKey}`

async function addData(objectData) {
  try {
    const docRef = await addDoc(collection(db, 'sportsEvents'), objectData)
    console.log('Документ успешно добавлен с ID: ', docRef.id)
  } catch (e) {
    console.error('Ошибка добавления документа: ', e)
  }
}

async function addAllData(dataArray) {
  for (let i = 0; i < dataArray.length; i += 1) {
    await addData(dataArray[i])
  }
}

async function getData(url) {
  const response = await fetch(url)
  return response.json()
}

function getRandomSeats() {
  const seats = []
  const totalSeats = 50

  // Создаем массив случайных уникальных номеров от 1 до 50
  while (seats.length < Math.floor(Math.random() * totalSeats) + 1) {
    const seatNumber = Math.floor(Math.random() * totalSeats) + 1
    if (!seats.includes(seatNumber)) {
      seats.push(seatNumber)
    }
  }

  return seats
}

async function fetchAndSaveData() {
  try {
    const data = await getData(url)
    const events = data._embedded.events

    const result = events.map((event) => {
      return {
        name: event.name,
        dateTime: event.dates.start.dateTime,
        price: event.priceRanges ? event.priceRanges[0].min : null,
        location: event._embedded.venues[0].address.line1,
        category: classificationName,
        occupiedSeats: getRandomSeats()
      }
    })

    await addAllData(result)
  } catch (error) {
    console.error('Ошибка при получении или сохранении данных: ', error)
  }
}

// document.body.addEventListener('click', fetchAndSaveData)
