import { showPassword, hidePassword } from "./utils";

document.addEventListener("DOMContentLoaded", () => {
  const firstNameInput = document.getElementById('firstName');
  const lastNameInput = document.getElementById('lastName');
  const addressInput = document.getElementById('address');
  const emailInput = document.getElementById('email');
  const phoneInput = document.getElementById('phone');
  const passwordInput = document.getElementById("password");
  const readOnlyFirstName = document.getElementById('readonly-firstName')
  const readOnlyLastName = document.getElementById('readonly-lastName')
  const readOnlyAddress = document.getElementById('readonly-address')
  const readOnlyPhone = document.getElementById('readonly-phone')
  const readOnlyEmail = document.getElementById('readonly-email')
  const passwordConfirmInput = document.getElementById("confirmPassword");
  const submitSignupButton = document.getElementById("submitSignup");


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

  
  submitSignupButton.addEventListener("click", function () {
    readOnlyFirstName.setAttribute('value', firstNameInput.value)
    readOnlyLastName.setAttribute('value', lastNameInput.value)
    readOnlyAddress.setAttribute('value', addressInput.value)
    readOnlyEmail.setAttribute('value', emailInput.value)
    readOnlyPhone.setAttribute('value', phoneInput.value)
  });

  

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
