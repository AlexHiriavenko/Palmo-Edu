import { db } from '@/firebase'
import { doc, getDoc } from 'firebase/firestore'

export async function getEntityByID(collectionPath, id) {
  const docRef = doc(db, collectionPath, id)
  const docSnap = await getDoc(docRef)

  if (docSnap.exists()) {
    const data = docSnap.data()
    return data
  } else {
    console.log('No such document!')
    return null
  }
}
