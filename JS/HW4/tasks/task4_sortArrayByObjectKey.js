function ascentSortByKey(arr, key) {
  const res = arr.toSorted((current, next) => {
    const currentValue = current?.[key];
    const nextValue = next?.[key];

    if (currentValue < nextValue) {
      return -1;
    }
    if (currentValue > nextValue) {
      return 1;
    }

    //  порядок не меняется
    return 0;
  });

  console.log(res);
  return res;
}

function descentSortByKey(arr, key) {
  const res = arr.toSorted((current, next) => {
    const currentValue = current?.[key];
    const nextValue = next?.[key];

    if (currentValue < nextValue) {
      return 1;
    }
    if (currentValue > nextValue) {
      return -1;
    }

    //  порядок не меняется
    return 0;
  });

  console.log(res);
  return res;
}

const simpsonsCharacters = [
  {
    name: "Homer",
    lastName: "Simpson",
    age: 39,
    profession: "Safety Inspector at a Nuclear Power Plant",
  },
  {
    name: "Marge",
    lastName: "Simpson",
    age: 36,
    profession: "Housewife",
  },
  {
    name: "Bart",
    lastName: "Simpson",
    age: 10,
    profession: "Student",
  },
  {
    name: "Lisa",
    lastName: "Simpson",
    age: 8,
    profession: "Student",
  },
  {
    name: "Apu",
    lastName: "Nahasapeemapetilon",
    age: 45,
    profession: "Owner of the Kwik-E-Mart",
  },
  {
    name: "Montgomery",
    lastName: "Burns",
    age: 104,
    profession: "Owner of the Springfield Nuclear Power Plant",
  },
  {
    name: "Ned",
    lastName: "Flanders",
    age: 60,
    profession: "Owner of the Leftorium",
  },
  {
    name: "MissingAge",
    lastName: "Example",
    // У этого объекта нет свойства age
  },
  {
    lastName: "MissingName",
    age: 44,
    // У этого объекта нет свойства name
  },
];

export { ascentSortByKey, descentSortByKey, simpsonsCharacters };
