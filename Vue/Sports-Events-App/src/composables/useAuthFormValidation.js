export function useAuthFormValidation() {
  const emailRules = [
    (value) => {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      return emailPattern.test(value) || 'Please enter a valid email address.'
    }
  ]

  const passwordRules = [
    (value) => {
      return value?.length >= 6 || 'Password must be at least 6 characters.'
    }
  ]

  return {
    emailRules,
    passwordRules
  }
}
