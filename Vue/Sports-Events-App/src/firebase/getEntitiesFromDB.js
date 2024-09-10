import { db } from '@/firebase'
import { collection, getDocs, query } from 'firebase/firestore'

export async function getEntitiesFromDB(collectionPath) {
  try {
    const collectionRef = collection(db, collectionPath)
    const q = query(collectionRef)
    const querySnapshot = await getDocs(q)

    const entities = querySnapshot.docs.map((doc) => ({
      id: doc.id,
      ...doc.data()
    }))

    return entities
  } catch (error) {
    console.error('Ошибка при получении данных из БД. ', error)
    throw error
  }
}
