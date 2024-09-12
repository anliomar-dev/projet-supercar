import { showPassword, hidePassword, login } from "../../js/utils";

document.addEventListener('DOMContentLoaded', ()=>{
  const eyeIcon = document.querySelector(".eye-icon"); //show password icons
  const hidePasswordIcon = document.querySelector(".hide-password"); //hide password icons
  showPassword(eyeIcon); //show password
  hidePassword(hidePasswordIcon) //hide password
})