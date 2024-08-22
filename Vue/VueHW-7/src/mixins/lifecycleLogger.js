export const lifecycleLogger = {
  created() {
    console.log(`Компонент ${this.$options.name} был создан`)
  },
  unmounted() {
    console.log(`Компонент ${this.$options.name} размонтирован`)
  }
}
