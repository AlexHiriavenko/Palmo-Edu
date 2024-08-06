// Примечание я понимаю что у функций - особенно предикатов, которые возвращают либо тру либо фолс, не должно быть сайд эффектов и помню про сингл респонсибилити из Солид
// так как главной задачей было реализовать функционал я не стал сильно заморачиваться.
// поэтому функции сразу выполняют побочные действия например такие как element.classList.add("class-name"); или element.textContent = "text"

function checkLogin(loginField, loginErrorField) {
  const userName = loginField.value;
  const invalidChars = /[_\/\\|,]/;

  if (
    userName.length < 4 ||
    userName.length > 20 ||
    invalidChars.test(userName)
  ) {
    loginErrorField.textContent =
      "Логин должен быть от 4 до 20 символов и не содержать символы _ / \\ | ,";
    loginField.classList.add("error");
    return false;
  } else {
    loginErrorField.textContent = "";
    loginField.classList.remove("error");
    return true;
  }
}

function checkEmail(emailField, emailErrorField) {
  const email = emailField.value;
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!email || !emailPattern.test(email)) {
    emailErrorField.textContent =
      "Введите корректный емейл в формате example@domain.com";
    emailField.classList.add("error");
    return false;
  } else {
    emailErrorField.textContent = "";
    emailField.classList.remove("error");
    return true;
  }
}

function checkAge(ageField, ageErrorField) {
  const age = ageField.value;

  if (!age || isNaN(age) || age <= 0) {
    ageErrorField.textContent =
      "Введите корректный возраст. Возраст не может быть отрицательным или пустым";
    ageField.classList.add("error");
    return false;
  } else {
    ageErrorField.textContent = "";
    ageField.classList.remove("error");
    return true;
  }
}

function checkPassword(passwordField, passwordErrorField) {
  const password = passwordField.value;
  const hasUpperCase = /[A-Z]/.test(password);
  const hasNumber = /\d/.test(password);

  if (!password || password.length < 6 || !hasUpperCase || !hasNumber) {
    passwordErrorField.textContent =
      "Пароль должен быть не менее 6 символов, иметь хотя бы одну заглавную букву и хотя бы одну цифру";
    passwordField.classList.add("error");
    return false;
  } else {
    passwordErrorField.textContent = "";
    passwordField.classList.remove("error");
    return true;
  }
}

function checkConfirmPassword(
  passwordField,
  confirmPasswordField,
  confirmPasswordErrorField
) {
  const password = passwordField.value;
  const confirmPassword = confirmPasswordField.value;

  if (password !== confirmPassword) {
    confirmPasswordErrorField.textContent = "Пароли не совпадают";
    confirmPasswordField.classList.add("error");
    return false;
  } else {
    confirmPasswordErrorField.textContent = "";
    confirmPasswordField.classList.remove("error");
    return true;
  }
}

export {
  checkLogin,
  checkEmail,
  checkAge,
  checkPassword,
  checkConfirmPassword,
};
