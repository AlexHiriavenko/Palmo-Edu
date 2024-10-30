document.addEventListener("DOMContentLoaded", function () {
  const checkboxes = document.querySelectorAll(
    'input[type="checkbox"]:not(:disabled)'
  );
  const submitButton = document.getElementById("submitBooking");

  // Функция для проверки состояния и блокировки/разблокировки чекбоксов и кнопки
  function updateCheckboxState() {
    const checkedCheckboxes = document.querySelectorAll(
      'input[type="checkbox"]:checked'
    ).length;

    // Блокируем/разблокируем свободные чекбоксы, если выбрано 4 места
    checkboxes.forEach((checkbox) => {
      if (checkedCheckboxes >= 4) {
        if (!checkbox.checked) checkbox.disabled = true;
      } else {
        if (!checkbox.classList.contains("occupied")) checkbox.disabled = false;
      }
    });

    // Активируем/деактивируем кнопку отправки формы в зависимости от числа выбранных мест
    submitButton.disabled = checkedCheckboxes === 0;
  }

  // Навешиваем обработчик клика на все свободные чекбоксы
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", updateCheckboxState);
  });

  // Вызываем проверку состояния при загрузке страницы
  updateCheckboxState();
});
