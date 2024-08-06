import { nonograms } from "../../nonograms/nonogramsMatrix";

export function updateNonogramOptions(selectElement, difficulty) {
  selectElement.innerHTML = "";
  const nonogramCategory = nonograms[difficulty];
  const nonogramNames = nonogramCategory.map((nonogram) => nonogram.name);

  nonogramNames.forEach((name) => {
    const optionElement = document.createElement("option");
    optionElement.value = name;
    optionElement.textContent = name;
    optionElement.className = "nonogram-names-option";

    selectElement.appendChild(optionElement);
  });
}
