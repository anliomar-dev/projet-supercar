import { fetchUsers, sortData } from "./utils";
import { showPassword, hidePassword, createUser, resetForm } from "/super-car/js/utils";

document.addEventListener('DOMContentLoaded', async ()=>{
  const passwordInput = document.getElementById("password");
  const passwordConfirmInput = document.getElementById("confirmPassword");
  const usersContainer = document.querySelector('.users-container');
  const template = document.getElementById("template-user");
  
  //show and hide password
  const eyeIcons = document.querySelectorAll(".eye-icon"); //show password icons
  const hidePasswordIcons = document.querySelectorAll(".hide-password"); //hide password icons
  eyeIcons.forEach((eyeIcon) => showPassword(eyeIcon)); //show password
  hidePasswordIcons.forEach((hidePasswordIcon) =>
    hidePassword(hidePasswordIcon)
  ); //hide password
  
  
  async function displayUsers(currentPage = 1, data, sortBy, order) {
    usersContainer.innerHTML = '';
    const users = data.users;
    const sortedUsers = sortData(users, sortBy, order);
    
    sortedUsers.forEach(user => {
      const clone = template.content.cloneNode(true);
      
      const checkBoxUser = clone.querySelector('.checkbox-user');
      checkBoxUser.value = user.id;
      
      const first_name = clone.querySelector('.first-name'); // Correctly target from the clone
      first_name.textContent = user.first_name;
      
      const last_name = clone.querySelector('.last-name'); // Correctly target from the clone
      last_name.textContent = user.last_name;
      
      const email = clone.querySelector('.email'); // Correctly target from the clone
      email.textContent = user.email;
      
      const editButton = clone.querySelector('.edit-button'); // Correctly target from the clone
      const deleteButton = clone.querySelector('.delete-button'); // Correctly target from the clone
      [editButton, deleteButton].forEach(btn => btn.dataset.id = user.id);
      
      usersContainer.appendChild(clone);
    });
  }
  const users = await fetchUsers(1)
  displayUsers(1, users, 'Prenom', 'asc')
})