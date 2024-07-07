const temperatureConverter = {
  celsiusToFahrenheit(celsius) {
    return (celsius * 9) / 5 + 32;
  },

  celsiusToKelvin(celsius) {
    return celsius + 273.15;
  },

  fahrenheitToCelsius(fahrenheit) {
    return ((fahrenheit - 32) * 5) / 9;
  },

  fahrenheitToKelvin(fahrenheit) {
    return ((fahrenheit - 32) * 5) / 9 + 273.15;
  },

  kelvinToCelsius(kelvin) {
    return kelvin - 273.15;
  },

  kelvinToFahrenheit(kelvin) {
    return ((kelvin - 273.15) * 9) / 5 + 32;
  },
};

export { temperatureConverter };
