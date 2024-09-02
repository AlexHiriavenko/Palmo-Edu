import { db } from '@/firebase'
import { collection, addDoc } from 'firebase/firestore'

export async function addEntityToDB(collectionPath, data) {
  try {
    const collectionRef = collection(db, collectionPath)
    const docRef = await addDoc(collectionRef, data)
    return docRef.id
  } catch (e) {
    console.error('Error adding document to Firestore:', e)
    throw e
  }
}
