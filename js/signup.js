import { showPassword, hidePassword } from "./utils";

document.addEventListener("DOMContentLoaded", () => {
  //script for intelinput
  const input = document.querySelector("#phone");
  window.intlTelInput(input, {
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.14/build/js/utils.js",
  });


  const eyeIcons = document.querySelectorAll(".eye-icon"); //show password icons
  const hidePasswordIcons = document.querySelectorAll(".hide-password"); //hide password icons
  eyeIcons.forEach((eyeIcon) => showPassword(eyeIcon)); //show password
  hidePasswordIcons.forEach((hidePasswordIcon) =>
    hidePassword(hidePasswordIcon)
  ); //hide password

  const passwordInput = document.getElementById("password");
  const passwordConfirmInput = document.getElementById("confirmPassword");
  // Example data (replace with actual form data)
  const formData = {
    name: 'Jean Dupont',
    email: 'jean.dupont@example.com',
    phone: '+33 6 12 34 56 78'
};

// Populate the review modal with user data
document.getElementById('userName').textContent = formData.name;
document.getElementById('userEmail').textContent = formData.email;
document.getElementById('userPhone').textContent = formData.phone;

// Handle review confirmation
document.getElementById('confirmReviewButton').addEventListener('click', function() {
    // Close the first modal
    const reviewModal = bootstrap.Modal.getInstance(document.getElementById('reviewModal'));
    reviewModal.hide();

    // Wait for the first modal to finish closing before opening the second one
    document.getElementById('reviewModal').addEventListener('hidden.bs.modal', function () {
        const consentModal = new bootstrap.Modal(document.getElementById('consentModal'));
        consentModal.show();
    }, { once: true });
});

// Enable the final confirm button only if the consent checkbox is checked
document.getElementById('consentCheckbox').addEventListener('change', function() {
    document.getElementById('finalConfirmButton').disabled = !this.checked;
});

// Handle final confirmation
document.getElementById('finalConfirmButton').addEventListener('click', function() {
    // Close the second modal
    const consentModal = bootstrap.Modal.getInstance(document.getElementById('consentModal'));
    consentModal.hide();

    // Optionally, submit the form or take any final action here
    alert('Formulaire soumis avec consentement.');
});
  
});
