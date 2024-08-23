function formatCurrency(amount, currency = '$') {
  const parsedAmount = parseFloat(amount)

  if (isNaN(parsedAmount)) {
    return `${currency}0.00`
  }

  return `${currency}${parsedAmount.toLocaleString()}`
}

export default {
  name: 'currency',

  beforeMount(el, binding) {
    el.textContent = formatCurrency(binding.value.amount, binding.value.currency)
  },

  updated(el, binding) {
    el.textContent = formatCurrency(binding.value.amount, binding.value.currency)
  }
}
