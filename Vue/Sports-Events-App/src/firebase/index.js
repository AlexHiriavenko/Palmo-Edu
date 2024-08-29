import { initializeApp } from 'firebase/app'
import {
  getAuth,
  createUserWithEmailAndPassword,
  signInWithEmailAndPassword,
  signOut
} from 'firebase/auth'

const firebaseConfig = JSON.parse(import.meta.env.VITE_FIREBASE_CONFIG)

// Initialize Firebase
const firebaseApp = initializeApp(firebaseConfig)

const auth = getAuth(firebaseApp)

export {
  auth,
  createUserWithEmailAndPassword,
  signInWithEmailAndPassword,
  signOut
}
