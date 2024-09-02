import { db } from '@/firebase'
import { doc, setDoc } from 'firebase/firestore'

export async function setEntityInDB(collectionPath, id, data) {
  const docRef = doc(db, collectionPath, id)
  await setDoc(docRef, data)
}
