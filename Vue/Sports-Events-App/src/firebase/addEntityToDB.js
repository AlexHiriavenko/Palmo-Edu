import { db } from '@/firebase'
import { collection, addDoc } from 'firebase/firestore'

export async function addEntityToDB(collectionPath, data) {
  const collectionRef = collection(db, collectionPath)
  const docRef = await addDoc(collectionRef, data)
  return docRef.id
}
