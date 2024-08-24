export default {
  name: 'tooltip',

  beforeMount(el, binding) {
    el.setAttribute('data-tooltip', binding.value.text || binding.value)

    el.classList.add('with-tooltip')

    const position = binding.value.position || 'top'
    el.classList.add(`tooltip--${position}`)
  },

  unmounted(el) {
    el.removeAttribute('data-tooltip')
    el.classList.remove('with-tooltip')
    el.classList.forEach((className) => {
      if (className.startsWith('tooltip--')) {
        el.classList.remove(className)
      }
    })
  }
}
