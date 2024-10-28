document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".favorite-toggle").forEach((button) => {
    button.addEventListener("click", function () {
      const eventId = this.getAttribute("data-event-id");
      const card = this.closest(".relative"); // Получаем карточку для удаления

      fetch("/controller/toggle_favorite.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          eventId: eventId,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            const isFavoritesPage =
              window.location.pathname.includes("favorites.php");
            if (isFavoritesPage) {
              card.remove(); // Удаляем карточку, если на странице избранного
            } else {
              this.classList.toggle("text-orange-500");
              this.classList.toggle("text-white");
            }
          } else {
            alert(
              "Не удалось обновить избранное. Пожалуйста, попробуйте снова."
            );
          }
        })
        .catch((error) => console.error("Ошибка:", error));
    });
  });
});
