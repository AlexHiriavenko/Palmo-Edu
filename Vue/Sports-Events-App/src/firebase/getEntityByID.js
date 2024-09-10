import { db } from '@/firebase'
import { doc, getDoc } from 'firebase/firestore'

export async function getEntityByID(collectionPath, id) {
  try {
    const docRef = doc(db, collectionPath, id)
    const docSnap = await getDoc(docRef)

    if (docSnap.exists()) {
      return docSnap.data()
    }

    console.log('Документ не найден!')
    return null
  } catch (error) {
    console.error('Ошибка при получении данных по ID. ', error)
    throw error
  }
}
