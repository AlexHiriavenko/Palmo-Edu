export default {
  name: 'textcolor',
  beforeMount(el, binding) {
    el.style.color = binding.value || 'black'
  }
}
