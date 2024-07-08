//  {a: 1, b: 2} → [['a', 1], ['b', 2]]

function simpleObjectToNestedArray(obj) {
  const res = Object.entries(obj);

  console.log(res);
  return res;
}

function nestedObjectToNestedArray(obj) {
  const res = Object.entries(obj).reduce((array, [key, value]) => {
    if (typeof value !== "object" || value === null) {
      array.push([key, value]);
    } else {
      array.push([key, nestedObjectToNestedArray(value)]);
    }
    return array;
  }, []);

  return res;
}

const simpleObject = { a: 1, b: 2 };
const nestedObject = {
  a: 1,
  b: {
    c: 2,
    d: {
      x: 1,
      y: 2,
      z: 1,
    },
  },
  f: 4,
};

export {
  simpleObjectToNestedArray,
  nestedObjectToNestedArray,
  simpleObject,
  nestedObject,
};
