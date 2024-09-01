export default {
  name: 'formatdate',

  mounted(el, binding) {
    const date = new Date(binding.value)
    const options = {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      timeZoneName: 'short'
    }
    el.textContent += date.toLocaleString('en-GB', options)
  }
}
