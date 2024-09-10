import { db } from '@/firebase'
import { collection, addDoc } from 'firebase/firestore'

export async function addEntityToDB(collectionPath, data) {
  try {
    const collectionRef = collection(db, collectionPath)
    const docRef = await addDoc(collectionRef, data)

    return docRef.id
  } catch (error) {
    console.error('Ошибка при добавлении данных в базу. ', error)
    throw error
  }
}
