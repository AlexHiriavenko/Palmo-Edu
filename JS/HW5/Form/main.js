import {
  checkLogin,
  checkEmail,
  checkAge,
  checkPassword,
  checkConfirmPassword,
} from "./validateInputs.js";

const regForm = document.getElementById("registrationForm");
const loginField = regForm.querySelector("#username");
const loginErrorField = regForm.querySelector("#username-error");
const emailField = regForm.querySelector("#email");
const emailErrorField = regForm.querySelector("#email-error");
const ageField = regForm.querySelector("#age");
const ageErrorField = regForm.querySelector("#age-error");
const passwordField = regForm.querySelector("#password");
const passwordErrorField = regForm.querySelector("#password-error");
const confirmPasswordField = regForm.querySelector("#confirm-password");
const confirmPasswordErrorField = regForm.querySelector(
  "#confirm-password-error"
);
const registeredSuccess = document.getElementById("success-message");
const formInputs = regForm.querySelectorAll("input");

regForm.addEventListener("submit", submitForm);

function submitForm(event) {
  event.preventDefault();
  const isValidLogin = checkLogin(loginField, loginErrorField);
  const isValidEmail = checkEmail(emailField, emailErrorField);
  const isValidAge = checkAge(ageField, ageErrorField);
  const isValidPassword = checkPassword(passwordField, passwordErrorField);
  const isValidConfirmPassword = checkConfirmPassword(
    passwordField,
    confirmPasswordField,
    confirmPasswordErrorField
  );

  const isValidForm = validateForm(
    isValidLogin,
    isValidEmail,
    isValidAge,
    isValidPassword,
    isValidConfirmPassword
  );

  if (isValidForm) {
    const newUser = {
      name: loginField.value.trim(),
      email: emailField.value.trim(),
      age: +ageField.value.trim(),
      password: confirmPasswordField.value.trim(),
    };

    registeredSuccess.style.display = "block";
    makeServerRecord(newUser);
    clearForm(formInputs);
  }
}

function clearForm(inputs) {
  inputs.forEach((input) => (input.value = ""));
}

function validateForm(...inputsPredicates) {
  return [...inputsPredicates].every((predicate) => !!predicate);
}

function makeServerRecord(newUser) {
  console.log(
    `отправить HTTP запрос с методом POST на сервер. Объект:`,
    newUser
  );
}
