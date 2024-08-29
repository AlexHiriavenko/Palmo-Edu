import {
  auth,
  createUserWithEmailAndPassword,
  signInWithEmailAndPassword,
  signOut
} from '@/firebase'
import { useModalStore } from '@/stores/modalStore'

export const useUserStore = defineStore('userStore', () => {
  const currentUser = ref(null)
  const authError = ref('')
  const isLoading = ref(false)
  const isLoggedIn = computed(() => currentUser.value && !isLoading.value)

  const login = async (email, password) => {
    isLoading.value = true
    try {
      const userCredential = await signInWithEmailAndPassword(
        auth,
        email,
        password
      )
      currentUser.value = userCredential.user
      authError.value = ''
      console.log('User logged in:', currentUser.value)
    } catch (error) {
      if (error.code === 'auth/invalid-credential') {
        authError.value = 'Invalid Credentials.'
        console.log(authError.value)
      } else {
        authError.value = 'Login Error'
      }
      console.log('Login Error:', error.message)
    } finally {
      isLoading.value = false
    }
  }

  const signup = async (email, password) => {
    isLoading.value = true
    try {
      const userCredential = await createUserWithEmailAndPassword(
        auth,
        email,
        password
      )
      currentUser.value = userCredential.user
      authError.value = ''
      console.log('User registered:', currentUser.value)
    } catch (error) {
      if (error.code === 'auth/email-already-in-use') {
        authError.value = 'This Email Is Already In Use.'
      } else {
        authError.value = 'An unexpected error. Please try again later.'
      }
      console.log('Error signup:', error)
    } finally {
      isLoading.value = false
    }
  }

  const logout = async () => {
    isLoading.value = true
    try {
      await signOut(auth)
      currentUser.value = null
      authError.value = ''
      console.log('User logged out')
    } catch (error) {
      authError.value = 'LogOut Error - try later'
      console.error('Error logout:', error)
    } finally {
      isLoading.value = false
    }
  }

  const setAuthErrorState = (value) => {
    authError.value = value
  }

  const modalStore = useModalStore()

  watch(
    () => modalStore.isOpen,
    (isOpen) => {
      if (!isOpen) {
        authError.value = ''
      }
    }
  )

  return {
    currentUser,
    authError,
    isLoading,
    isLoggedIn,
    login,
    signup,
    logout,
    setAuthErrorState
  }
})
