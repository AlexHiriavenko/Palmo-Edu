function printObject(obj) {
  const properties = Object.keys(obj);
  const values = Object.values(obj);

  console.log(`свойства: ${properties}`);
  console.log(`значения: ${values}`);
}

function printObject2(obj) {
  for (let key in obj) {
    if (obj.hasOwnProperty(key)) {
      console.log(`${key}: ${obj[key]}`);
    }
  }
}

function printObject3(obj) {
  Object.entries(obj).forEach(([key, value]) =>
    console.log(`${key}: ${value}`)
  );
}

const exampleObject = {
  name: "Gomer",
  lastName: "Simpson",
  age: 39,
  profession: "safety inspector at a nuclear power plant",
};

export { printObject, printObject2, printObject3, exampleObject };
