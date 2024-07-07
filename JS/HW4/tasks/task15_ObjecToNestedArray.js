//  {a: 1, b: 2} → [['a', 1], ['b', 2]]

function objecToNestedArray(obj) {
  const res = Object.entries(obj);

  console.log(res);
  return res;
}

export { objecToNestedArray };
