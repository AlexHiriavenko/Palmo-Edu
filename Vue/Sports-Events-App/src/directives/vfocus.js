export default {
  name: 'focus',

  mounted(el, { value: predicate }) {
    // Выполняем функцию, если predicate не передан (undefined) или равен true
    if (predicate === false) return

    const focusableSelectors = [
      'input',
      'select',
      'textarea',
      'button',
      'a[href]',
      '[tabindex]:not([tabindex="-1"])'
    ]

    const isFocusable = (element) =>
      focusableSelectors.some((selector) => element.matches(selector))

    if (isFocusable(el)) {
      el.focus()
    } else {
      const focusableChild = el.querySelector(focusableSelectors.join(', '))

      if (focusableChild) {
        focusableChild.focus()
      }
    }
  }
}
