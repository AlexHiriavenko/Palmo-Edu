function mergeTwoArrays(arr1, arr2) {
  const res = [...arr1, ...arr2];

  console.log(res);
  return res;
}

function mergeArrays(...arrays) {
  let res = [];

  while (arrays.length) {
    res = [...arrays.pop(), ...res];
  }

  console.log(res);
  return res;
}

const array1 = [1, 2, 3];
const array2 = [4, 5, 6];
const array3 = [7, 8, 9];

export { mergeTwoArrays, mergeArrays, array1, array2, array3 };
