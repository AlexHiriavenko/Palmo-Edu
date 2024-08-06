function findMostCommonElement(arr) {
  const hashTable = arr.reduce((obj, key) => {
    obj[key] = (obj[key] || 0) + 1;
    return obj;
  }, {});

  let mostCommonElement = null;
  let count = 0;

  for (let key in hashTable) {
    if (hashTable[key] > count) {
      count = hashTable[key];
      mostCommonElement = key;
    }
  }

  mostCommonElement =
    typeof arr[0] === "number" ? +mostCommonElement : mostCommonElement;

  console.log(mostCommonElement);
  return mostCommonElement;
}

const numbers = [1, 2, 3, 1, 2, 1, 2, 2];
const words = [
  "one",
  "two",
  "three",
  "four",
  "five",
  "two",
  "three",
  "four",
  "five",
  "three",
  "four",
  "five",
  "four",
  "five",
  "five",
];

export { findMostCommonElement, numbers, words };
