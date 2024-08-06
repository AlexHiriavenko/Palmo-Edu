function flattenArray(arr) {
  console.log(arr.flat(Infinity));

  return arr.flat(Infinity);
}

const nestedArray = [1, 2, [3, 4, [5, 6], 7, 8], 9];

export { flattenArray, nestedArray };
