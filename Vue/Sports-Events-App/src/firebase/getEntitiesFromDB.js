import { db } from '@/firebase'
import { collection, getDocs, query } from 'firebase/firestore'

export async function getEntitiesFromDB(collectionPath) {
  const collectionRef = collection(db, collectionPath)
  const q = query(collectionRef)
  const querySnapshot = await getDocs(q)

  const entities = querySnapshot.docs.map((doc) => ({
    id: doc.id,
    ...doc.data()
  }))

  return entities
}
