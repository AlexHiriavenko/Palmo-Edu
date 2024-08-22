export const baseMixin = {
  data() {
    return {
      sharedMessage: 'This is message from mixin  '
    }
  },
  methods: {
    formatText() {
      this.sharedMessage = this.sharedMessage.trim().toUpperCase()
    },

    clearText() {
      this.sharedMessage = ''
    },

    setInitialText() {
      this.sharedMessage = 'This is message from mixin  '
    }
  }
}
