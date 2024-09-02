import {
  auth,
  onAuthStateChanged,
  createUserWithEmailAndPassword,
  signInWithEmailAndPassword,
  signOut,
  doc,
  setDoc,
  dbCollections
} from '@/firebase'
import { useModalStore } from '@/stores/modalStore'
import { getEntityByID } from '@/firebase/getEntityByID'

export const useUserStore = defineStore('userStore', () => {
  const currentUser = ref(null)
  const authError = ref('')
  const isLoggedIn = computed(() => currentUser.value)

  const { users } = dbCollections

  onAuthStateChanged(auth, async (user) => {
    if (user) {
      console.log('user logged in')
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
      const { user } = await createUserWithEmailAndPassword(
        auth,
        email,
        password
      )

      authError.value = ''

      if (user) {
        createUserDB(user)
        console.log(user)
        console.log(auth.currentUser)
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

  const createUserDB = async (user) => {
    try {
      const userData = {
        email: user.email,
        uid: user.uid,
        favoriteEvents: [],
        bookedEvents: []
      }

      const userRef = doc(users, user.uid)
      await setDoc(userRef, userData)
      currentUser.value = userData
      console.log('Document added or updated successfully!')
    } catch (e) {
      console.error('Ошибка добавления документа: ', e)
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

// const createUserDB = async () => {
//   try {
//     const docRef = await addDoc(collection(db, 'users'), {
//       email: currentUser.value.email,
//       uid: currentUser.value.uid
//     })
//     console.log('Документ успешно добавлен с ID: ', docRef.id)
//   } catch (e) {
//     console.error('Ошибка добавления документа: ', e)
//   }
// }
