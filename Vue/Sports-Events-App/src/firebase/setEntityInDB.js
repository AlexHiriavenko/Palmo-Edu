import { db } from '@/firebase'
import { doc, setDoc } from 'firebase/firestore'

export async function setEntityInDB(collectionPath, id, data) {
  try {
    const docRef = doc(db, collectionPath, id)
    await setDoc(docRef, data)
  } catch (error) {
    console.error('Ошибка при сохранении данных. ', error)
    throw error
  }
}
