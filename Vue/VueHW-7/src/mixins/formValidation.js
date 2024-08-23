export const formValidation = {
  methods: {
    validateField(value, rules) {
      for (const rule of rules) {
        const validationResult = rule(value)
        if (validationResult !== true) {
          return validationResult
        }
      }
      return true
    },
    validateForm(formData, validationRules) {
      const errors = {}
      for (const fieldName in validationRules) {
        const validation = this.validateField(formData[fieldName], validationRules[fieldName])
        if (validation !== true) {
          errors[fieldName] = validation
        }
      }
      return Object.keys(errors).length === 0 ? true : errors
    }
  }
}
