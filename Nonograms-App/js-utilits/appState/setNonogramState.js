import appState from "../../AppState";
const nonogramState = appState.nonogram;

export function setNonogramState(settings) {
  for (const key in settings) {
    if (settings.hasOwnProperty(key) && nonogramState.hasOwnProperty(key)) {
      nonogramState[key] = settings[key];
    }
  }
}
