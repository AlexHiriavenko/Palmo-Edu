import createElement from "./helpers/createElement.js";

// Task 1
const titleTask1 = document.querySelector(".title__task1");
const alertBtn = createElement({
  tag: "button",
  text: "Call Alert",
});

alertBtn.addEventListener("click", () => alert("Hello, Palmo."));

titleTask1.insertAdjacentElement("afterend", alertBtn);

// Task 2
const titleTask2 = document.querySelector(".title__task2");
const inputChangeText = createElement({
  tag: "input",
  value: "Hello, Palmo",
});
const btnChangeText = createElement({
  tag: "button",
  text: "Change Text",
});

btnChangeText.addEventListener(
  "click",
  () => (inputChangeText.value = "Hello, World!")
);

titleTask2.insertAdjacentElement("afterend", btnChangeText);
btnChangeText.insertAdjacentElement("afterend", inputChangeText);

// Task 3
const titleTask3 = document.querySelector(".title__task3");

const btnConsoleOutput = createElement({
  tag: "button",
  text: "Output to console",
});

btnConsoleOutput.addEventListener("click", () =>
  console.log(inputChangeText.value)
);

titleTask3.insertAdjacentElement("afterend", btnConsoleOutput);

// Task 4
const titleTask4 = document.querySelector(".title__task4");

const h1Title1 = createElement({
  tag: "h1",
  text: "Title 1",
  className: "subtitle",
});
const h1Title2 = createElement({
  tag: "h1",
  text: "Title 2",
  className: "subtitle",
});
const btnSwapText = createElement({
  tag: "button",
  text: "Swap Text",
});

titleTask4.insertAdjacentElement("afterend", h1Title1);
h1Title1.insertAdjacentElement("afterend", h1Title2);
h1Title2.insertAdjacentElement("afterend", btnSwapText);

btnSwapText.addEventListener("click", () => {
  let tempText = h1Title1.textContent;
  h1Title1.textContent = h1Title2.textContent;
  h1Title2.textContent = tempText;
});

// Task 5
const titleTask5 = document.querySelector(".title__task5");

const paragraph = createElement({
  tag: "p",
  text: "Этот параграф меняет цвет, если нажать на кнопку Toggle Color.",
  className: "sample-paragraph",
});
const btnToggleColor = createElement({
  tag: "button",
  text: "Toggle Color",
});

titleTask5.insertAdjacentElement("afterend", paragraph);
paragraph.insertAdjacentElement("afterend", btnToggleColor);

btnToggleColor.addEventListener("click", () => {
  paragraph.classList.toggle("orange-text");
});

// Task 6
const titleTask6 = document.querySelector(".title__task6");

const inputField = createElement({
  tag: "input",
  value: "Enabled",
});

const toggleButton = createElement({
  tag: "button",
  text: "Disable",
});

titleTask6.insertAdjacentElement("afterend", inputField);
inputField.insertAdjacentElement("afterend", toggleButton);

toggleButton.addEventListener("click", () => {
  if (inputField.disabled) {
    inputField.disabled = false;
    inputField.value = "Enabled";
    toggleButton.textContent = "Disable";
  } else {
    inputField.disabled = true;
    toggleButton.textContent = "Enable";
    inputField.value = "Disabled";
  }
});

// Task 7
const greenSquare = document.getElementById("square1");
const redSquare = document.getElementById("square2");

function toggleColors(square1, square2) {
  if (square1.classList.contains("green")) {
    square1.classList.replace("green", "red");
    square2.classList.replace("red", "green");
  } else {
    square1.classList.replace("red", "green");
    square2.classList.replace("green", "red");
  }
}

greenSquare.addEventListener("click", () =>
  toggleColors(greenSquare, redSquare)
);
redSquare.addEventListener("click", () => toggleColors(greenSquare, redSquare));

// Task 8
let itemCount = 0;

function addItemToList(list) {
  itemCount += 1;
  const listItem = createElement({
    tag: "li",
    text: `Item ${itemCount}`,
  });
  list.appendChild(listItem);
}

const addItemBtn = document.getElementById("addItemBtn");
const itemList = document.getElementById("itemList");

addItemBtn.addEventListener("click", () => addItemToList(itemList));

// Task 9
function generateListFromTextarea(textarea, list) {
  if (!textarea.value.replaceAll(",", "").trim()) {
    alert("заполните поле значениями через запятую");
    return;
  }
  list.innerHTML = "";
  const items = textarea.value.split(",").map((item) => item.trim());
  items.forEach((item) => {
    if (item) {
      const listItem = createElement({
        tag: "li",
        text: item,
      });
      list.appendChild(listItem);
    }
  });
}

const inputTextarea = document.getElementById("inputTextarea");
const generateListBtn = document.getElementById("generateListBtn");
const generatedList = document.getElementById("generatedList");

generateListBtn.addEventListener("click", () =>
  generateListFromTextarea(inputTextarea, generatedList)
);
