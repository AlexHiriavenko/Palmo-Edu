import {
  auth,
  onAuthStateChanged,
  createUserWithEmailAndPassword,
  signInWithEmailAndPassword,
  signOut,
  deleteUser,
  updateProfile
} from '@/firebase'
import { useModalStore } from '@/stores/modalStore'
import { getEntityByID } from '@/firebase/getEntityByID'
import { setEntityInDB } from '@/firebase/setEntityInDB'

export const useUserStore = defineStore('userStore', () => {
  const currentUser = ref(null)
  const authError = ref('')
  const isLoggedIn = computed(() => currentUser.value)

  onAuthStateChanged(auth, async (user) => {
    if (user) {
      console.log('user logged in')
      console.log(auth.currentUser)
      const userId = auth.currentUser.uid
      currentUser.value = await getUserById(userId)
      console.log(currentUser.value)
    } else {
      console.log('no logged in users')
      currentUser.value = null
    }
  })

  const login = async (email, password) => {
    try {
      await signInWithEmailAndPassword(auth, email, password)

      authError.value = ''
    } catch (error) {
      if (error.code === 'auth/invalid-credential') {
        authError.value = 'Invalid Credentials.'
      } else {
        authError.value = 'Login Error'
      }
    }
  }

  const signup = async (email, password, name = 'unnamed') => {
    try {
      const { user } = await createUserWithEmailAndPassword(
        auth,
        email,
        password
      )

      authError.value = ''

      if (user) {
        createUserDB(user, name)
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

  const createUserDB = async (user, username) => {
    try {
      const userData = {
        name: username,
        email: user.email,
        uid: user.uid,
        favoriteEvents: [],
        bookedEvents: []
      }

      updateProfile(user, { displayName: username })
      await setEntityInDB('users', user.uid, userData)
      currentUser.value = userData
    } catch (e) {
      deleteUser(auth.currentUser)
      authError.value = 'Error writing to database. Try again later.'
    }
  }

  async function getUserById(userId) {
    return await getEntityByID('users', userId)
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
