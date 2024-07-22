import { createShowSloutionDialog } from "../showSolutionDialog";
import { appendModalContent } from "../../modal/functions/appendModalContent";
import { openModal } from "../../modal/functions/openModal";
import { createResetGameDialog } from "../../resetGameDialog/resetGameDialog";
import appState from "../../../AppState";

export function showSolutionRequest() {
  const isGameExist =
    !!appState?.nonogram?.name && !!appState?.nonogram?.difficulty;

  if (isGameExist) {
    const showSolutionDialog = createShowSloutionDialog();
    appendModalContent(showSolutionDialog);
  } else {
    const showSolutionDialog = createResetGameDialog();
    appendModalContent(showSolutionDialog);
  }
  openModal("alert");
}
