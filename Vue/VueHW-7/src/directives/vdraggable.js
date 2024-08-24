export default {
  name: 'draggable',

  mounted(el) {
    el.style.position = 'absolute'

    const onMouseDown = (event) => {
      const rect = el.getBoundingClientRect() // Получаем размеры и позицию элемента

      const startX = event.clientX
      const startY = event.clientY

      const offsetX = startX - rect.left // Смещение курсора внутри элемента по оси X
      const offsetY = startY - rect.top // Смещение курсора внутри элемента по оси Y

      const onMouseMove = (moveEvent) => {
        const newLeft = moveEvent.clientX - offsetX // Новая позиция по X
        const newTop = moveEvent.clientY - offsetY + window.scrollY // Новая позиция по Y с учетом прокрутки

        el.style.left = `${newLeft}px`
        el.style.top = `${newTop}px`
      }

      const onMouseUp = () => {
        document.removeEventListener('mousemove', onMouseMove)
        document.removeEventListener('mouseup', onMouseUp)
      }

      document.addEventListener('mousemove', onMouseMove)
      document.addEventListener('mouseup', onMouseUp)
    }

    el.addEventListener('mousedown', onMouseDown)

    // Сохраняем ссылку на обработчик для последующего удаления
    el._onMouseDown = onMouseDown
  },

  unmounted(el) {
    // Удаляем слушатель события при размонтировании
    el.removeEventListener('mousedown', el._onMouseDown)
  }
}
