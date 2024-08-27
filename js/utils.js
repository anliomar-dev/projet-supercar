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

export async function fetchModelsByBrand(brandId, page=1){
  try{
    const response = await fetch(`http://localhost/Super-car/api/modeles?brand_id=${brandId}&page=${page}`)
    if(!response.ok){
      throw new Error(response.statusText)
    }else{
      const data = await response.json()
      const models = data.models
      const totalPages = data.total_pages
      const currentPage = data.page
      return {models, totalPages, currentPage}
    }
  }catch(e){
    console.log(`erreur lors de la récupération des données ${e.message}`)
  }
}

