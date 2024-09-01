import {
  auth,
  createUserWithEmailAndPassword,
  signInWithEmailAndPassword,
  signOut,
  db,
  addDoc,
  collection
} from '@/firebase'
import { useModalStore } from '@/stores/modalStore'

export const useUserStore = defineStore('userStore', () => {
  const currentUser = ref(null)
  const authError = ref('')
  const isLoggedIn = computed(() => currentUser.value)

  const login = async (email, password) => {
    try {
      const userCredential = await signInWithEmailAndPassword(
        auth,
        email,
        password
      )
      currentUser.value = userCredential.user
      console.log(currentUser.value)
      authError.value = ''
    } catch (error) {
      if (error.code === 'auth/invalid-credential') {
        authError.value = 'Invalid Credentials.'
      } else {
        authError.value = 'Login Error'
      }
    }
  }

  const signup = async (email, password) => {
    try {
      const userCredential = await createUserWithEmailAndPassword(
        auth,
        email,
        password
      )
      currentUser.value = userCredential.user
      authError.value = ''

      if (currentUser.value) {
        createUserDB()
      }
    } catch (error) {
      if (error.code === 'auth/email-already-in-use') {
        authError.value = 'This Email Is Already In Use.'
      } else {
        authError.value = 'An unexpected error. Please try again later.'
      }
    }
  }

  const logout = async () => {
    try {
      await signOut(auth)
      currentUser.value = null
      authError.value = ''
    } catch (error) {
      authError.value = 'LogOut Error - try later'
    }
  }

  const createUserDB = async () => {
    try {
      const docRef = await addDoc(collection(db, 'users'), {
        email: currentUser.value.email,
        uid: currentUser.value.uid
      })
      console.log('Документ успешно добавлен с ID: ', docRef.id)
    } catch (e) {
      console.error('Ошибка добавления документа: ', e)
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
    isLoggedIn,
    login,
    signup,
    logout,
    setAuthErrorState
  }
})
