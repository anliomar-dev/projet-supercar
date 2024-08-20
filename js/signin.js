import { showPassword, hidePassword } from "./utils";

document.addEventListener("DOMContentLoaded", () => {
  const eyeIcon = document.querySelector(".eye-icon"); //show password icons
  const hidePasswordIcon = document.querySelector(".hide-password"); //hide password icons
  showPassword(eyeIcon); //show password
  hidePassword(hidePasswordIcon) //hide password

  const passwordInput = document.getElementById("password");
});