/**
 * ensure password length is greather or equale to 5 ans password and confirm passwod match
 * @param {Array} passwordInputsFields - passwords inputs
 * @returns {boolean} return true if both of two conditions are true
 */
function passwordsFieldValid(passwordInputsFields) {
  // check if password length is greather or equal to 5
  const areAllFieldsValid = passwordInputsFields.every(field => isStringLengthGreaterThan(field.value, 5));

  // check if passwords match
  const arePasswordsIdentical = passwordInputsFields[0].value === passwordInputsFields[1].value;

  return areAllFieldsValid && arePasswordsIdentical;
}

/**
 * 
 * @param {Array} fullNameAndAdress - firstname, lastname and address
 * @returns {boolean} return true if firstname, lastname and address are all field and the length is greather or eqaul to the minimum length
 */
function fullNameAndAdressValid(fullNameAndAdress) {
  return fullNameAndAdress.every(field => {
    const minLength = parseInt(field.getAttribute("data-minLength"), 10);
    return isStringLengthGreaterThan(field.value, minLength);
  });
}