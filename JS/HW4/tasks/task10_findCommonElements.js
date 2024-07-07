function findCommonElements(array1, array2) {
  const longestArray = array1.length >= array2.length ? array1 : array2;
  const shortestArray = array1.length >= array2.length ? array2 : array1;

  const res = longestArray.filter((el) => shortestArray.includes(el));

  console.log(res);
  return res;
}

function findCommonElements2(...arrays) {
  if (arrays.length === 0) return [];

  const res = arrays.reduce((commonElements, currentArray) => {
    return commonElements.filter((element) => currentArray.includes(element));
  });

  console.log(res);
  return res;
}

const arrExample1 = [1, 2, 3, 4, 5];
const arrExample2 = [4, 5, 6, 7, 8];
const arrExample3 = [5, 8, 9, 4, 2];

export {
  findCommonElements,
  findCommonElements2,
  arrExample1,
  arrExample2,
  arrExample3,
};
