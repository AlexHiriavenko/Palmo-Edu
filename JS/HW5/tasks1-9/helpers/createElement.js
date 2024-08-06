function createElement(options) {
  let element = document.createElement(options.tag);

  if (options.text) {
    element.textContent = options.text;
  }

  if (options.className) {
    element.className = options.className;
  }

  if (options.value) {
    element.value = options.value;
  }
  return element;
}

export default createElement;
