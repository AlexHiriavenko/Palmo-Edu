let classificationName = "basketball";
let country = "US";
let apiKey = "LDRn3cJuA58ULBA8p8CA89FVdohz6tZK";
let url = `https://app.ticketmaster.com/discovery/v2/events.json?countryCode=${country}&classificationName=${classificationName}&page=0&size=40&apikey=${apiKey}`;

async function getData(url) {
  const response = await fetch(url);
  return response.json();
}

function getRandomSeats() {
  const seats = [];
  const totalSeats = 50;
  // Создаем массив случайных уникальных номеров от 1 до 50
  while (seats.length < Math.floor(Math.random() * totalSeats) + 1) {
    const seatNumber = Math.floor(Math.random() * totalSeats) + 1;
    if (!seats.includes(seatNumber)) {
      seats.push(seatNumber);
    }
  }
  return seats;
}

async function fetchAndSaveData() {
  try {
    const data = await getData(url);
    const events = data._embedded.events;
    const result = events.map((event) => {
      return {
        name: event.name,
        dateTime: event.dates.start.dateTime,
        price: event.priceRanges ? event.priceRanges[0].min : null,
        location: event._embedded.venues[0].address.line1,
        category: classificationName,
        occupiedSeats: getRandomSeats(),
      };
    });
    console.log(result);
  } catch (error) {
    console.error("Ошибка при получении или сохранении данных: ", error);
  }
}

fetchAndSaveData();
