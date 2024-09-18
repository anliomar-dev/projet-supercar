import { fetchUsers, sortData } from "./utils";
import { showPassword, hidePassword, createUser, resetForm } from "/super-car/js/utils";

// current page
if (!localStorage.hasOwnProperty("usersCurrentPage")) {
  localStorage.setItem("usersCurrentPage", 1);
}

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
  
  
  async function displayUsers(data, sortBy, order) {
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
  displayUsers(users, 'Prenom', 'asc')

  // dynamic pagination
  const pagination = document.querySelector(".pagination");
  async function paginationUsers(pagination) {
    const data = await fetchUsers();
    const users = data.users;
    const totalPages = data.total_pages;

    // if we have more than one page
    if (totalPages > 1) {
      // create previous button
      const prevBtn = document.createElement("li");
      prevBtn.classList.add("page-item");
      prevBtn.innerHTML = `
        <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
      `;
      // append button to the ul tag for pagination
      pagination.appendChild(prevBtn);

      prevBtn.addEventListener('click', async(e)=>{
        e.preventDefault();
        const currentPage = parseInt(localStorage.getItem('usersCurrentPage'));
        if(currentPage > 1){
          const prevPage = currentPage - 1;
          localStorage.setItem('usersCurrentPage', prevPage);
          const users = await fetchUsers(prevPage)
          displayUsers(users, 'Prenom', 'asc')
        }
      })

      // create pagination buttons
      for (let i = 1; i <= totalPages; i++) {
        const pageItem = document.createElement("li");
        pageItem.classList.add("page-item");
        pageItem.innerHTML = `<a class="page-link num-page" href="#" >${i}</a>`;
        pagination.appendChild(pageItem);
      }

      // add event listener to pagination buttons
      const numPages = document.querySelectorAll(".num-page");
      numPages.forEach((numPage) => {
        numPage.addEventListener("click", async (e) => {
          e.preventDefault();
          localStorage.setItem("usersCurrentPage", e.currentTarget.textContent);
          const currentPage = parseInt(localStorage.getItem("usersCurrentPage"));
          const users = await fetchUsers(currentPage)
          displayUsers(users, 'Prenom', 'asc')
        });
      });

      // create next button
      const nextBtn = document.createElement("li");
      nextBtn.classList.add("page-item");
      nextBtn.innerHTML = `
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      `;
      // append nextbutton to the ul for pagination
      pagination.appendChild(nextBtn);

      nextBtn.addEventListener('click', async(e)=>{
        e.preventDefault();
        const currentPage = parseInt(localStorage.getItem('usersCurrentPage'));
        if(currentPage < totalPages){
          const NextPage = currentPage + 1;
          localStorage.setItem('usersCurrentPage', NextPage);
          const users = await fetchUsers(NextPage)
          displayUsers(users, 'Prenom', 'asc')
        }
      })
      
    }
  }

  // dispal paginations buttons
  paginationUsers(pagination);
})