import { showPassword, hidePassword } from "./utils";

document.addEventListener("DOMContentLoaded", () => {
  const eyeIcons = document.querySelectorAll(".eye-icon"); //show password icons

  const hidePasswordIcons = document.querySelectorAll(".hide-password"); //hide password icons

  eyeIcons.forEach((eyeIcon) => showPassword(eyeIcon)); //show password
  hidePasswordIcons.forEach((hidePasswordIcon) =>
    hidePassword(hidePasswordIcon)
  ); //hide password

  const passwordInput = document.getElementById("password");
  const passwordConfirmInput = document.getElementById("confirmPassword");
});
