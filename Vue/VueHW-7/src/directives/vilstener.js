// Розробіть власну директиву, яка приймає параметр і виконує різні дії в залежності від його значення.

export default {
  name: 'listener',

  beforeMount(el, binding) {
    const eventType = binding.value

    const changeBgToRed = () => {
      el.style.backgroundColor = 'red'
    }

    if (eventType === 'leftClick') {
      el.addEventListener('click', changeBgToRed)
    } else if (eventType === 'rightClick') {
      el.addEventListener('contextmenu', (event) => {
        event.preventDefault()
        changeBgToRed()
      })
    }
  },

  unmounted(el) {
    const removeBgChange = () => {
      el.style.backgroundColor = ''
    }

    el.removeEventListener('click', removeBgChange)
    el.removeEventListener('contextmenu', removeBgChange)
  }
}
