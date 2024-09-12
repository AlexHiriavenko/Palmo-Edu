export function useEventFormValidation() {
  const nameRules = [
    (value) =>
      (value && value.length > 2) || 'Event Name must be at least 3 characters.'
  ]

  const dateTimeRules = [
    (value) => !!value || 'Please select a date.',
    (value) =>
      new Date(value) > new Date() || 'Event date must be in the future.'
  ]

  const categoryRules = [(value) => !!value || 'Please select a category.']

  const locationRules = [
    (value) =>
      (value && value.length > 2) || 'Location must be at least 3 characters.'
  ]

  const priceRules = [
    (value) => value >= 0 || 'Price must be a positive number.'
  ]

  const categories = ['Basketball', 'Football', 'Volleyball']

  return {
    nameRules,
    dateTimeRules,
    categoryRules,
    locationRules,
    priceRules,
    categories
  }
}
