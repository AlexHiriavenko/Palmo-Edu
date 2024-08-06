const temperatureConverter = {
  validateNumber(value) {
    if (typeof value !== "number" || isNaN(value)) {
      throw new Error("Value must be a valid number");
    }
  },

  celsiusToFahrenheit(celsius) {
    this.validateNumber(celsius);
    return (celsius * 9) / 5 + 32;
  },

  celsiusToKelvin(celsius) {
    this.validateNumber(celsius);
    return celsius + 273.15;
  },

  fahrenheitToCelsius(fahrenheit) {
    this.validateNumber(fahrenheit);
    return ((fahrenheit - 32) * 5) / 9;
  },

  fahrenheitToKelvin(fahrenheit) {
    this.validateNumber(fahrenheit);
    return ((fahrenheit - 32) * 5) / 9 + 273.15;
  },

  kelvinToCelsius(kelvin) {
    this.validateNumber(kelvin);
    return kelvin - 273.15;
  },

  kelvinToFahrenheit(kelvin) {
    this.validateNumber(kelvin);
    return ((kelvin - 273.15) * 9) / 5 + 32;
  },
};

export { temperatureConverter };
