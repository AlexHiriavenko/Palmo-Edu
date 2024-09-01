import './assets/styles/main.css'
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'

import { createVuetify } from 'vuetify'
import directives from './directives'
import ModalDialog from '@/components/ModalDialog.vue'
import LoaderSpinner from './components/LoaderSpinner.vue'

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

const eventsDataBS = [
  {
    name: 'San Antonio Spurs vs Phoenix Suns',
    dateTime: '2025-02-21T02:30:00Z',
    price: 115,
    location: 'Moody Center ATX',
    occupiedSeats: [
      33, 18, 1, 24, 15, 19, 14, 12, 45, 50, 38, 48, 9, 39, 4, 32, 28, 44, 10,
      17, 37, 41, 29, 40, 30, 46, 16, 2
    ]
  },
  {
    name: 'Phoenix Suns vs. San Antonio Spurs',
    dateTime: '2024-12-04T02:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [
      8, 29, 17, 5, 21, 44, 37, 2, 23, 27, 49, 20, 46, 38, 42, 3, 41
    ]
  },
  {
    name: 'NBA Cup: Oklahoma City Thunder v Phoenix Suns',
    dateTime: '2024-11-16T01:00:00Z',
    price: 12,
    location: 'Paycom Center',
    occupiedSeats: [
      18, 8, 23, 38, 11, 34, 24, 28, 21, 15, 3, 2, 9, 32, 26, 29, 37, 5, 43, 25,
      7, 42, 6
    ]
  },
  {
    name: 'Utah Jazz v. Phoenix Suns (Emirates NBA Cup Group Play)',
    dateTime: '2024-11-13T02:00:00Z',
    price: null,
    location: 'Delta Center',
    occupiedSeats: [
      11, 40, 6, 35, 8, 5, 22, 14, 48, 36, 7, 39, 21, 17, 25, 12, 47, 2, 29, 3,
      24, 28, 1, 16, 46, 45, 44, 34, 49, 37, 31, 43, 38, 41, 9, 19, 26, 30, 27,
      18
    ]
  },
  {
    name: 'Phoenix Suns vs. Golden State Warriors',
    dateTime: '2024-12-01T02:00:00Z',
    price: 89,
    location: 'Footprint Center',
    occupiedSeats: [
      5, 17, 41, 12, 20, 4, 28, 9, 43, 13, 39, 37, 42, 24, 21, 50, 27, 46, 26,
      40, 30, 6, 18, 14
    ]
  },
  {
    name: 'Orlando Magic v Phoenix Suns',
    dateTime: '2024-12-08T23:30:00Z',
    price: 31,
    location: 'Kia Center',
    occupiedSeats: [
      49, 32, 24, 3, 40, 34, 9, 7, 2, 1, 39, 5, 23, 10, 26, 48, 17, 20, 46, 31,
      25, 19, 27, 12, 36, 28, 18, 29, 30, 41
    ]
  },
  {
    name: 'Phoenix Suns vs. Portland Trail Blazers',
    dateTime: '2024-11-03T02:00:00Z',
    price: 29,
    location: 'Footprint Center',
    occupiedSeats: [
      47, 46, 10, 4, 5, 26, 49, 20, 8, 29, 16, 23, 2, 9, 48, 36, 22, 50, 24, 6,
      30, 34, 17, 38, 19, 45, 32, 21, 37, 41, 39, 12, 35, 18, 42, 15, 3
    ]
  },
  {
    name: 'Miami Heat vs. Phoenix Suns',
    dateTime: '2024-12-08T01:00:00Z',
    price: 45,
    location: 'Kaseya Center',
    occupiedSeats: [3, 29, 8, 12, 14, 41, 30, 37]
  },
  {
    name: 'SACRAMENTO KINGS VS. PHOENIX SUNS',
    dateTime: '2024-11-14T03:00:00Z',
    price: 39,
    location: 'Golden 1 Center',
    occupiedSeats: [5, 34, 4, 2, 31, 20, 7, 36, 1, 33, 10]
  },
  {
    name: 'Phoenix Suns vs. Miami Heat',
    dateTime: '2024-11-07T02:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [22, 2, 9, 8, 14, 21, 17]
  },
  {
    name: 'Phoenix Suns vs. Memphis Grizzlies',
    dateTime: '2025-01-01T02:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [
      45, 29, 2, 19, 7, 41, 32, 18, 13, 16, 25, 11, 26, 22, 1, 37, 3, 38, 23,
      34, 27, 21, 31, 5, 9, 30, 42, 39, 12, 24, 28, 15, 6, 46, 44, 36, 49, 20,
      8, 14, 17, 4, 50, 35, 48, 10, 43
    ]
  },
  {
    name: 'Phoenix Suns vs. Sacramento Kings',
    dateTime: '2024-11-11T01:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [20, 34, 14, 46, 40, 5, 27, 7, 28, 31, 11, 25, 12, 44]
  },
  {
    name: 'Atlanta Hawks vs Phoenix Suns',
    dateTime: '2025-01-15T00:30:00Z',
    price: 38,
    location: 'State Farm Arena',
    occupiedSeats: [19, 32, 9, 42, 23, 33, 13, 24, 49, 5, 40]
  },
  {
    name: 'Phoenix Suns vs. Indiana Pacers',
    dateTime: '2024-12-20T02:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [48, 15, 21, 30, 46, 14, 16, 29, 1, 22, 13, 12]
  },
  {
    name: 'Phoenix Suns vs. Minnesota Timberwolves',
    dateTime: '2025-01-30T02:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [
      33, 16, 28, 13, 4, 47, 43, 46, 20, 18, 14, 45, 11, 27, 30, 6, 7, 26, 22,
      39, 10, 40, 15
    ]
  },
  {
    name: 'Charlotte Hornets vs. Phoenix Suns',
    dateTime: '2025-01-08T00:00:00Z',
    price: 18.5,
    location: 'Spectrum Center ',
    occupiedSeats: [
      48, 22, 8, 12, 2, 10, 47, 4, 13, 9, 34, 19, 26, 27, 40, 50, 43, 36, 38,
      29, 20, 7, 23, 37, 21, 16, 32, 35, 44, 24, 3, 17, 33, 1, 5, 41, 28, 45, 30
    ]
  },
  {
    name: 'Phoenix Suns vs. Brooklyn Nets',
    dateTime: '2024-11-28T02:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [
      17, 47, 8, 46, 22, 44, 2, 11, 28, 9, 23, 39, 43, 30, 15, 35, 10, 40, 31,
      36, 25, 50, 37, 38, 26, 34, 1, 41, 48, 12, 27, 45, 24, 5, 3, 16, 33, 6,
      19, 14, 21, 42, 4, 18, 49
    ]
  },
  {
    name: 'Phoenix Suns vs. Utah Jazz',
    dateTime: '2025-01-11T22:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [
      16, 19, 41, 26, 30, 49, 50, 28, 10, 21, 35, 13, 6, 39, 22, 38, 20
    ]
  },
  {
    name: 'Phoenix Suns vs. Orlando Magic',
    dateTime: '2024-11-19T02:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [38, 32, 14, 18, 5]
  },
  {
    name: 'Brooklyn Nets v. Phoenix Suns',
    dateTime: '2025-01-23T00:30:00Z',
    price: 53,
    location: 'Barclays Center',
    occupiedSeats: [
      30, 25, 17, 10, 36, 9, 26, 39, 29, 8, 15, 3, 50, 21, 2, 6, 5, 47, 24, 35,
      28, 40, 31, 12, 20, 43, 38, 7, 33, 42, 13, 1, 32, 41, 44, 46, 27, 22, 19,
      45, 18, 49, 14
    ]
  },
  {
    name: 'Phoenix Suns vs. Golden State Warriors',
    dateTime: '2025-04-09T02:00:00Z',
    price: 125,
    location: 'Footprint Center',
    occupiedSeats: [
      34, 38, 25, 32, 30, 11, 18, 19, 3, 43, 16, 41, 13, 26, 35, 33, 14, 27, 36,
      17, 47, 29, 20, 15, 31, 49, 48, 10, 44, 50, 2, 6, 45
    ]
  },
  {
    name: 'Phoenix Suns vs. Milwaukee Bucks',
    dateTime: '2025-03-25T02:00:00Z',
    price: 79,
    location: 'Footprint Center',
    occupiedSeats: [
      36, 26, 22, 17, 14, 20, 8, 33, 5, 15, 40, 12, 30, 42, 9, 7, 32, 50, 39
    ]
  },
  {
    name: 'Porland Trail Blazers v Phoenix Suns - Black History Night',
    dateTime: '2025-02-02T03:00:00Z',
    price: 25,
    location: 'Moda Center',
    occupiedSeats: [
      15, 31, 19, 29, 50, 30, 1, 16, 24, 11, 22, 26, 17, 13, 10, 21, 42, 49, 2,
      47, 40, 27, 4, 18, 44, 25, 14, 12, 3, 36, 35, 48, 39, 43
    ]
  },
  {
    name: 'SACRAMENTO KINGS VS. PHOENIX SUNS',
    dateTime: '2025-04-13T19:30:00Z',
    price: 40,
    location: 'Golden 1 Center',
    occupiedSeats: [2, 4, 38, 34, 9, 25, 14, 1, 35, 12, 22, 16, 13, 41, 3, 19]
  },
  {
    name: 'Indiana Pacers vs. Phoenix Suns',
    dateTime: '2025-01-05T00:00:00Z',
    price: 38,
    location: 'Gainbridge Fieldhouse',
    occupiedSeats: [
      27, 25, 4, 15, 16, 28, 39, 32, 19, 1, 17, 21, 6, 30, 46, 48, 10, 35, 3, 7,
      20
    ]
  },
  {
    name: 'Phoenix Suns vs. Minnesota Timberwolves',
    dateTime: '2025-03-03T02:30:00Z',
    price: 79,
    location: 'Footprint Center',
    occupiedSeats: [
      4, 34, 35, 28, 33, 25, 10, 7, 43, 30, 38, 48, 19, 20, 3, 27, 8, 15, 39
    ]
  },
  {
    name: 'Phoenix Suns vs. New Orleans Pelicans',
    dateTime: '2025-02-28T03:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [
      11, 3, 46, 21, 14, 23, 42, 22, 49, 28, 24, 19, 36, 4, 16, 29, 35, 40, 26,
      39, 12, 41, 32, 48, 7, 17, 27, 45, 44, 13, 30, 25, 34, 8, 6, 10, 15, 9, 5,
      31, 18, 37, 1, 33, 2, 20, 50, 47
    ]
  },
  {
    name: 'Phoenix Suns vs. Atlanta Hawks',
    dateTime: '2025-01-10T02:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [43, 8, 38, 35, 39, 22, 5]
  },
  {
    name: 'Phoenix Suns vs. Charlotte Hornets',
    dateTime: '2025-01-13T02:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [
      27, 15, 45, 49, 47, 34, 9, 32, 40, 6, 35, 19, 50, 18, 26, 48, 11, 31, 29,
      8, 41, 3, 37, 7, 4, 24, 28, 2, 22, 23, 16, 43, 12, 38, 13, 17, 30, 33, 5,
      25, 20, 36
    ]
  },
  {
    name: 'Portland Trail Blazers vs. Phoenix Suns',
    dateTime: '2025-02-04T03:00:00Z',
    price: 18,
    location: 'Moda Center',
    occupiedSeats: [
      4, 27, 12, 25, 37, 21, 13, 30, 50, 1, 16, 49, 41, 14, 39, 34, 47, 38, 15,
      22, 3, 18, 45
    ]
  },
  {
    name: 'Phoenix Suns vs. Memphis Grizzlies',
    dateTime: '2025-02-12T03:00:00Z',
    price: 39,
    location: 'Footprint Center',
    occupiedSeats: [
      31, 46, 7, 15, 50, 18, 8, 42, 11, 36, 14, 22, 10, 41, 24, 38, 16, 6, 25,
      21, 40, 35, 29, 47, 12, 48, 45, 28, 30, 20, 1, 27, 4, 34, 32, 33, 5, 37,
      43
    ]
  },
  {
    name: 'Milwaukee Bucks vs. Phoenix Suns',
    dateTime: '2025-04-02T00:00:00Z',
    price: 21,
    location: 'Fiserv Forum',
    occupiedSeats: [
      1, 5, 37, 29, 27, 43, 35, 16, 32, 14, 8, 22, 9, 4, 46, 19, 38, 36, 48, 24,
      33, 13, 45, 21, 44, 28, 50, 26, 49, 20, 7, 11, 23, 41, 31, 39, 47, 10, 42
    ]
  },
  {
    name: 'Memphis Grizzlies vs. Phoenix Suns',
    dateTime: '2025-02-26T01:00:00Z',
    price: 35,
    location: 'FedExForum',
    occupiedSeats: [
      28, 24, 39, 13, 50, 34, 23, 14, 27, 49, 8, 17, 2, 40, 42, 30, 9, 3, 4, 32,
      36, 7, 43, 5, 41, 29, 12, 15, 11, 16, 35, 25, 31, 44
    ]
  },
  {
    name: 'Memphis Grizzlies vs. Phoenix Suns',
    dateTime: '2025-03-11T00:00:00Z',
    price: 35,
    location: 'FedExForum',
    occupiedSeats: [
      48, 29, 38, 32, 36, 37, 10, 26, 24, 3, 25, 34, 21, 50, 40, 17, 9, 15, 12,
      43, 44, 23, 46, 11, 47, 31, 39, 45, 22, 1, 7, 6, 41, 35, 13, 49, 5, 14,
      30, 27, 20, 42, 28, 8, 2, 33, 16
    ]
  },
  {
    name: 'Phoenix Suns vs. Utah Jazz',
    dateTime: '2025-02-08T03:00:00Z',
    price: 79,
    location: 'Footprint Center',
    occupiedSeats: [
      27, 28, 46, 31, 9, 22, 11, 43, 45, 15, 36, 38, 50, 40, 12, 29, 44, 18, 20,
      7, 35, 17, 47, 42, 34, 10, 49, 33, 2, 1, 30, 26, 8, 24, 32, 13, 21, 41, 4,
      5, 48, 23, 3, 14, 25, 39, 19, 6, 37, 16
    ]
  },
  {
    name: 'Phoenix Suns vs. Oklahoma City Thunder',
    dateTime: '2025-04-10T02:00:00Z',
    price: 79,
    location: 'Footprint Center',
    occupiedSeats: [38, 34, 41, 24, 15, 36, 13, 16]
  },
  {
    name: 'Phoenix Suns vs. Sacramento Kings',
    dateTime: '2025-03-15T02:00:00Z',
    price: 79,
    location: 'Footprint Center',
    occupiedSeats: [
      20, 37, 44, 27, 12, 25, 32, 49, 48, 18, 1, 35, 10, 17, 3, 23, 8, 19, 40,
      31
    ]
  },
  {
    name: 'Phoenix Suns vs. San Antonio Spurs',
    dateTime: '2025-04-12T02:00:00Z',
    price: 79,
    location: 'Footprint Center',
    occupiedSeats: [33, 2, 9, 19, 4, 12, 37, 43]
  },
  {
    name: 'Minnesota Timberwolves vs. Phoenix Suns',
    dateTime: '2024-11-17T20:30:00Z',
    price: null,
    location: 'Target Center',
    occupiedSeats: [
      8, 15, 49, 32, 1, 27, 40, 18, 43, 17, 25, 11, 37, 29, 24, 19, 44, 28, 4,
      42, 50, 48, 3, 14, 26, 16, 21, 10, 38, 41, 47, 23, 46, 12, 9, 20, 34, 33,
      31, 7
    ]
  },
  {
    name: 'Phoenix Suns vs. New Orleans Pelicans',
    dateTime: '2025-03-01T02:00:00Z',
    price: 79,
    location: 'Footprint Center',
    occupiedSeats: [
      8, 31, 36, 34, 9, 27, 26, 50, 11, 23, 6, 37, 22, 28, 13, 32, 42, 15, 21,
      2, 12, 19, 24, 18, 5, 40, 45, 39, 4, 35, 41, 1, 44, 33, 49, 17, 43, 48,
      46, 38, 7, 20, 10, 3, 47
    ]
  }
]

import { db } from './firebase'
import { collection, addDoc } from 'firebase/firestore'

async function addData(objectData) {
  try {
    const docRef = await addDoc(collection(db, 'basketballEvents'), objectData)
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

// Вызов функции для добавления всех данных
// addAllData(eventsDataBS)
