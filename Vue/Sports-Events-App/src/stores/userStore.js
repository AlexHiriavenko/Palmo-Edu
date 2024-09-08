import {
  auth,
  onAuthStateChanged,
  createUserWithEmailAndPassword,
  signInWithEmailAndPassword,
  signOut,
  deleteUser,
  updateProfile
} from '@/firebase'
import { getEntityByID } from '@/firebase/getEntityByID'
import { setEntityInDB } from '@/firebase/setEntityInDB'
import { useRouter } from 'vue-router'

export const useUserStore = defineStore('userStore', () => {
  const currentUser = ref(null)
  const authResultMessage = ref('')
  const isAuthReady = ref(false)
  const isLoggedIn = ref(false)
  const router = useRouter()

  onAuthStateChanged(auth, async (user) => {
    if (user) {
      isLoggedIn.value = true
      const userId = auth.currentUser.uid
      currentUser.value = await getUserById(userId)
    } else {
      isLoggedIn.value = false
      currentUser.value = null
    }
    isAuthReady.value = true
  })

  async function login(email, password) {
    try {
      await signInWithEmailAndPassword(auth, email, password)

      authResultMessage.value = 'You Logged In!'
    } catch (error) {
      if (error.code === 'auth/invalid-credential') {
        authResultMessage.value = 'Invalid Credentials.'
      } else {
        authResultMessage.value = 'Login Error'
      }
    }
  }

  const signup = async (email, password, name = 'NoName') => {
    try {
      const { user } = await createUserWithEmailAndPassword(
        auth,
        email,
        password
      )

      authResultMessage.value = 'You have successfully registered !'

      if (user) {
        const userData = {
          name: name,
          email: user.email,
          uid: user.uid,
          favoriteEvents: [],
          bookedEvents: []
        }
        createUserDB(userData)
        updateProfile(user, { displayName: name })
      }
    } catch (error) {
      if (error.code === 'auth/email-already-in-use') {
        authResultMessage.value = 'This Email Is Already In Use.'
      } else {
        authResultMessage.value = 'An unexpected error. Please try again later.'
      }
    }
  }

  const logout = async () => {
    try {
      await signOut(auth)
      currentUser.value = null
      authResultMessage.value = ''
    } catch (error) {
      authResultMessage.value = 'LogOut Error - try later'
    }
  }

  const createUserDB = async (userData) => {
    try {
      await setEntityInDB('users', userData.uid, userData)
      currentUser.value = userData
    } catch (e) {
      deleteUser(auth.currentUser)
      authResultMessage.value = 'Error writing to database. Try again later.'
    }
  }

  async function getUserById(userId) {
    return await getEntityByID('users', userId)
  }

  const setAuthResult = (value) => (authResultMessage.value = value)

  function toggleFavorite(eventId) {
    if (!isLoggedIn.value) {
      return
    }
    const index = currentUser.value.favoriteEvents.indexOf(eventId)
    if (index === -1) {
      currentUser.value.favoriteEvents.push(eventId)
    } else {
      currentUser.value.favoriteEvents.splice(index, 1)
    }
  }

  function setUserBookedEvent(eventID, bookingData) {
    const eventIndex = currentUser?.value.bookedEvents?.findIndex(
      (b) => b.eventID === eventID
    )

    if (eventIndex !== -1) {
      currentUser.value.bookedEvents[eventIndex] = bookingData
    } else {
      currentUser.value.bookedEvents.push(bookingData)
    }
  }

  watch(
    currentUser,
    (newValue, oldValue) => {
      if (oldValue !== null && newValue && isLoggedIn.value) {
        setEntityInDB('users', newValue.uid, newValue)
      }
    },
    { deep: true }
  )

  watch(isLoggedIn, (newValue) => {
    if (!newValue) {
      if (router.currentRoute.value.meta.requiresAuth) {
        router.push({ name: 'home' })
      }
    }
  })

  return {
    currentUser,
    authResultMessage,
    isAuthReady,
    isLoggedIn,
    login,
    signup,
    logout,
    setAuthResult,
    toggleFavorite,
    setUserBookedEvent
  }
})
