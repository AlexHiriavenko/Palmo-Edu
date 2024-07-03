function generatePassword(length) {
  const UPPER_CASE_LETTERS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  const LOWER_CASE_LETTERS = UPPER_CASE_LETTERS.toLowerCase();
  const NUMBERS = "0123456789";
  const SPECIAL_CHARACTERS = "!@#$%^&*()_+[]{}|;:,.<>?";

  const allCharacters =
    UPPER_CASE_LETTERS + LOWER_CASE_LETTERS + NUMBERS + SPECIAL_CHARACTERS;

  let password = "";

  for (let i = 0; i < length; i += 1) {
    const randomIndex = Math.floor(Math.random() * allCharacters.length);
    password += allCharacters[randomIndex];
  }

  console.log(password);
  return password;
}

export default generatePassword;
