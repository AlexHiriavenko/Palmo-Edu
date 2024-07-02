function compressStr(str) {
  const lettersQuantity = str.split("").reduce((obj, key) => {
    obj[key] = (obj[key] || 0) + 1;
    return obj;
  }, {});

  let compressedStr = Object.entries(lettersQuantity).reduce(
    (accStr, [key, value]) => {
      accStr += key + (value > 1 ? value : "");
      return accStr;
    },
    ""
  );

  console.log(compressedStr);
}

export default compressStr;
