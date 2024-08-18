const initialMessage = "Передайте данні від основного об'єкта до другорядного";
const changedMessage =
  "текст сообщения изменился в основном объекте и во второстепенном";

export const store = Vue.reactive({
  sharedMessage: initialMessage,
  toggleSharedMessage() {
    this.sharedMessage =
      this.sharedMessage === initialMessage ? changedMessage : initialMessage;
  },
});
