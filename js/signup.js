import { 
  showPassword, 
  hidePassword, 
  isStringLengthGreaterThan,
  isStringMatchRegEx
} from "./utils";

const regexPasswordMedium = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w\s])(?=.{8,12}$)/;
const regexStrongPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w\s]).{13,}$/;
const regexBlacklist = /[\*\=\'\"\-\/\\\,]/;
const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const regexPhoneNumber = /^(?:\+|00|0)[1-9]\d{0,2}\s?(\d{1,4}\s?[\d\s\-]{5,14}|\(\d{1,4}\)\s?[\d\s\-]{5,14})$/;


document.addEventListener("DOMContentLoaded", () => {
  const firstNameInput = document.getElementById('firstName');
  const lastNameInput = document.getElementById('lastName');
  const addressInput = document.getElementById('address');
  const phoneInput = document.getElementById('phone');
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById("password");
  const passwordConfirmInput = document.getElementById("confirmPassword");
  const passwordInputsFields = [passwordInput, passwordConfirmInput]
  const readOnlyFirstName = document.getElementById('readonly-firstName')
  const readOnlyLastName = document.getElementById('readonly-lastName')
  const readOnlyAddress = document.getElementById('readonly-address')
  const readOnlyPhone = document.getElementById('readonly-phone')
  const readOnlyEmail = document.getElementById('readonly-email')
  const submitSignupFormButton = document.getElementById("submitSignup");
  const passwordsMessageText = document.querySelector('.passwordMessage');


  //script for intelinput
  const input = document.querySelector("#phone");
  window.intlTelInput(input, {
    utilsScript:
      "https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.14/build/js/utils.js",
  });

  //show and hide password
  const eyeIcons = document.querySelectorAll(".eye-icon"); //show password icons
  const hidePasswordIcons = document.querySelectorAll(".hide-password"); //hide password icons
  eyeIcons.forEach((eyeIcon) => showPassword(eyeIcon)); //show password
  hidePasswordIcons.forEach((hidePasswordIcon) =>
    hidePassword(hidePasswordIcon)
  ); //hide password


  //populate the readOnly inputs of the firstModal with form data
  submitSignupFormButton.addEventListener("click", function () {
    readOnlyFirstName.setAttribute('value', firstNameInput.value)
    readOnlyLastName.setAttribute('value', lastNameInput.value)
    readOnlyAddress.setAttribute('value', addressInput.value)
    readOnlyEmail.setAttribute('value', emailInput.value)
    readOnlyPhone.setAttribute('value', phoneInput.value)
  });

  //check the length of firstName field, lastName field and address
  const fullNameAndAdress = document.querySelectorAll('#firstName, #lastName, #address')
  fullNameAndAdress.forEach((input )=> {
    input.addEventListener('input', function() {
      const minLength = parseInt(input.getAttribute('data-minLength'), 10)
      if(!isStringLengthGreaterThan(input.value, minLength)){
        input.style.outline = 'solid 2px red'
        input.nextElementSibling.style.display = 'block'
      }else{
        input.style.outline = 'solid 2px #09CD1C'
        input.nextElementSibling.style.display = 'none'
      }
    })
  })
  
  //check if phone field is valid
  phoneInput.addEventListener('input', ()=>{
    if(isStringMatchRegEx(regexPhoneNumber, phoneInput.value)){
      phoneInput.style.outline = 'solid 2px #09CD1C'
      document.querySelector('.error').style.display = 'none'
    }else{
      phoneInput.style.outline = 'solid 2px red'
      document.querySelector('.error').style.display = 'block'
    }
  })

  //check if email field is valid
  emailInput.addEventListener('input', ()=>{
    if(isStringMatchRegEx(regexEmail, emailInput.value)){
        emailInput.style.outline = 'solid 2px #09CD1C'
        emailInput.nextElementSibling.style.display = 'none'
    }else{
        emailInput.style.outline = 'solid 2px red'
        emailInput.nextElementSibling.style.display = 'block'
      }
  })

  //check if password field is valid
  passwordInput.addEventListener('input', function(){
    if(isStringMatchRegEx(regexBlacklist, passwordInput.value)){
      passwordsMessageText.style.color = 'red';
      passwordsMessageText.textContent = 'caractères interdits: *, /, \\, =, ", -,  ,'
      passwordInput.style.outline = 'solid 2px red'
    }else{
      passwordsMessageText.textContent = ''
      if(passwordInput.value.trim().length > 0 && !isStringLengthGreaterThan(passwordInput.value, 8)){
        passwordsMessageText.textContent = 'Votre mot de passe est très vulnerable. ignorez ce message si vous voulez utiliser ce mot de passe'
        passwordsMessageText.style.color = '#ffc107'
        passwordInput.style.outline = 'solid 3px #ffc107'
      }else{
        passwordsMessageText.textContent = 'pour un mot de passe sécurisé, minimum: 8 caractères, 1 lettre majuscule, 1 lettre miniscule, un chiffre, 1 caractère spéciale'
        passwordsMessageText.style.color = 'black';
        passwordInput.style.outline = 'none'
        if(
          passwordInput.value.trim().length > 0 && 
          isStringMatchRegEx(regexPasswordMedium, passwordInput.value)
        ){
          passwordsMessageText.textContent = 'votre mot de passe est fort';
          passwordsMessageText.style.color = '#0d6efd';
          passwordInput.style.outline = 'solid 3px #0d6efd';
        }else if(
          passwordInput.value.trim().length > 0 &&
          isStringMatchRegEx(regexStrongPassword, passwordInput.value)
          ){
            passwordsMessageText.textContent = 'votre mot de passe est très fort';
            passwordsMessageText.style.color = '#28a745';
            passwordInput.style.outline = 'solid 3px #28a745';
          }else{
            passwordsMessageText.textContent = 'votre mot de passe est assez long mais pas très complexe';
            passwordsMessageText.style.color = '#D7CE00';
            passwordInput.style.outline = 'solid 3px #D7CE00';
          }
      }
    }  
  })

  //handle password confirm
  passwordConfirmInput.addEventListener('input', function(){
    passwordsMessageText.textContent = 'les deux mot de passe doivent être identiques'
    if(isStringMatchRegEx(regexBlacklist, passwordConfirmInput.value)){
      passwordsMessageText.style.color = 'red';
      passwordsMessageText.textContent = 'caractères interdits: *, /, \\, =, ", -,  ,'
      passwordConfirmInput.style.outline = 'solid 2px red'
      }else{
        passwordsMessageText.style.color = 'black';
        passwordConfirmInput.style.outline = 'none'
        if(passwordInput.value === passwordConfirmInput.value){
          passwordsMessageText.textContent = 'Les deux mot de passe sont identiques'
          passwordsMessageText.style.color = '#28a745';
        }
      }
    })
  // Handle review confirmation
  document
    .getElementById("confirmReviewButton")
    .addEventListener("click", function () {
      // Close the first modal
      const reviewModal = bootstrap.Modal.getInstance(
        document.getElementById("reviewModal")
      );
      reviewModal.hide();
      // Wait for the first modal to finish closing before opening the second one
      document.getElementById("reviewModal").addEventListener(
        "hidden.bs.modal",
        function () {
          const consentModal = new bootstrap.Modal(
            document.getElementById("consentModal")
          );
          consentModal.show();
        },
        { once: true }
      );
    });

  // Enable the final confirm button only if the consent checkbox is checked
  document
    .getElementById("consentCheckbox")
    .addEventListener("change", function () {
      document.getElementById("finalConfirmButton").disabled = !this.checked;
    });

  // Handle final confirmation
  document
    .getElementById("finalConfirmButton")
    .addEventListener("click", function () {
      // Close the second modal
      const consentModal = bootstrap.Modal.getInstance(
        document.getElementById("consentModal")
      );
      consentModal.hide();
      // Optionally, submit the form or take any final action here
      alert("Formulaire soumis avec consentement.");
    });
});
