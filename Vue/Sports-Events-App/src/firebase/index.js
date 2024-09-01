import { initializeApp } from 'firebase/app'
import {
  getFirestore,
  collection,
  doc,
  addDoc,
  getDocs,
  query,
  where
} from 'firebase/firestore'
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
const db = getFirestore(firebaseApp)

const dbCollections = {
  users: 'users',
  basketballEvents: 'basketballEvents'
}

export {
  auth,
  db,
  dbCollections,
  createUserWithEmailAndPassword,
  signInWithEmailAndPassword,
  signOut,
  collection,
  addDoc,
  query,
  where,
  doc,
  getDocs
}
