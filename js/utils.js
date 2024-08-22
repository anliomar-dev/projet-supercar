/**
 * hiding show password icon, set attribut type from password to text and display hide password icon
 * @param {HTMLElement} icon - the eye icon for hiding password
 */

export function showPassword(icon) {
  icon.addEventListener("click", (e) => {
    e.currentTarget.style.display = "none";
    //hide password icon
    const hidePasswordIcon = icon.parentNode.querySelector(".hide-password");
    //display hide the icon for hiding password
    hidePasswordIcon.style.display = "block";
    const passwordField = icon.parentNode.querySelector(".passwordField");
    passwordField.type = "text";
  });
}

/**
 * hiding hide password icon, set attribut type from text to password and display "show password icon"
 * @param {HTMLElement} icon - the eye icon for hiding password
 */

export function hidePassword(icon) {
  icon.addEventListener("click", (e) => {
    e.currentTarget.style.display = "none";
    //show password icon
    const showPasswordIcon = icon.parentNode.querySelector(".eye-icon");
    //display hide the icon for hiding password
    showPasswordIcon.style.display = "block";
    const passwordField = icon.parentNode.querySelector(".passwordField");
    passwordField.type = "password";
  });
}

/**
 * Checks if the length of a string is greater than a specified minimum length.
 * @param {string} string - The string to check the length of.
 * @param {number} minLength - The minimum length the string should have.
 * @returns {boolean} - Returns true if the trimmed string's length is greater than the specified number, false otherwise.
 */
export function isStringLengthGreaterThan(string, minLength) {
  return string.trim().length >= minLength;
}

/**
 * Tests a string against a regular expression.
 *
 * @param {RegExp} regEx - The regular expression to test against.
 * @param {string} str - The string to be tested.
 * @returns {boolean} - Returns `true` if the string matches the regular expression, otherwise `false`.
 * @throws {TypeError} - Throws a TypeError if the first argument is not a RegExp or the second argument is not a string.
 */
export function isStringMatchRegEx(regEx, str) {
  if (!(regEx instanceof RegExp)) {
    throw new TypeError("The first argument must be a regular expression.");
  }
  if (typeof str !== "string") {
    throw new TypeError("The second argument must be a string.");
  }
  return regEx.test(str);
}

/**
 * Updates the appearance of an input field and manages the display of a message.
 * 
 * This function modifies the outline of the specified input field, sets the display 
 * and color properties of a message container, and updates the text content of the message.
 * 
 * @param {HTMLElement} field - The input field to be styled.
 * @param {string} displayProperty - The CSS display property for the message container (e.g., 'block' or 'none').
 * @param {HTMLElement} messageTextContainer - The container element for the message text.
 * @param {string} message - The message to be displayed in the container.
 * @param {string} [color='black'] - The color of the message text. Defaults to 'black'.
 * @param {string} [outline='none'] - The CSS outline property for the input field. Defaults to 'none'.
 */
export function controlField(
  field,
  displayProperty,
  messageTextContainer,
  message,
  color = "black",
  outline = "none"
) {
  field.style.outline = outline;
  messageTextContainer.style.color = color;
  messageTextContainer.style.display = displayProperty;
  messageTextContainer.textContent = message;
}
