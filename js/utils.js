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
 * Fetch models for a specific brand with pagination.
 * @param {number} brandId - The ID of the brand for which we want to get all models.
 * @param {number} [page=1] - The number of the current page (defaults to 1).
 * @returns {Promise<object>} An object containing models, total pages, and the current page.
 * @throws Will throw an error if the fetch operation fails.
 */
export async function fetchModelsByBrand(brandId, page=1){
  try{
    const response = await fetch(`http://localhost/Super-car/api/modeles?brand_id=${brandId}&page=${page}`)
    if(!response.ok){
      const data = response.json()
      return data
    }else{
      const data = await response.json()
      if(!data['models'] && data.error){
        console.log(data)
        return data
      }
      const models = data.models
      const totalPages = data.total_pages
      const currentPage = data.page
      return {models, totalPages, currentPage}
    }
  }catch(e){
    console.log(`erreur lors de la récupération des données ${e.message}`)
  }
}


/**
 * Create a new user account
 * @param {...string} data - The user details: first_name, last_name, address, phone, email, password, action.
 * @returns {Promise<object>} The server response.
 */
export async function createUser(...data){
  const [first_name, last_name, address, phone, email, password, action] = data;

  const user = {
    first_name,
    last_name,
    address,
    phone,
    email,
    password,
    action
  };
  try {
    const response = await fetch('http://localhost/super-car/api/user', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(user)
    });
    
    if (!response.ok) {
      throw new Error(response.statusText);
    }
  
    const message = await response.json();
    return message;
  } catch (e) {
    console.error('Internal server error: ' + e.message);
  }
  
}

export async function login(email, password, action='login'){
  const credentials = {
    email,
    password,
    action
  }
  try {
    const response = await fetch('http://localhost/super-car/api/user/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(credentials)
    })
    if (!response.ok) {
      throw new Error(response.statusText);
    }
  
    const message = await response.json();
    return message;
  }catch(e){
    console.error('Internal server error: ' + e.message);
  }
}

/**
 * Resets the value of form fields.
 * @param {...HTMLInputElement|HTMLTextAreaElement|HTMLSelectElement} fields - The form fields to reset.
 */
export function resetForm(...fields) {
  for (let field of fields) {
    // Vérifie si le champ est un élément de formulaire avec une propriété 'value'
    if (field && 'value' in field) {
      field.value = '';
      field.style.outline = 'none'
    } else {
      console.warn('Un champ non valide a été fourni pour la réinitialisation.');
    }
  }
}
