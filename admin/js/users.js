import { fetchUsers, sortData } from "./utils";
import { showPassword, hidePassword } from "/super-car/js/utils";

// Set the current page
localStorage.setItem("usersCurrentPage", 1);

document.addEventListener('DOMContentLoaded', async () => {
  const passwordInput = document.getElementById("password");
  const passwordConfirmInput = document.getElementById("confirmPassword");
  const usersContainer = document.querySelector('.users-container');
  const template = document.getElementById("template-user");
  const allSections = document.querySelectorAll('section');
  const showSectionClickables = document.querySelectorAll('.show-section');
  const sortButtons = document.querySelectorAll('.sortBtn');
  const theadColumns = document.querySelectorAll('.th-col');
  const checkAllUsers = document.querySelector('.check-all');
  let checkUser = [];

  const phoneInput = document.querySelectorAll(".phone");
  phoneInput.forEach((input)=>{
    //script for intelinput
    window.intlTelInput(input, {
      utilsScript:
        "https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.14/build/js/utils.js",
    });
  })
  

  // Handle sorting
  theadColumns.forEach((col) => {
    const buttons = col.parentElement.querySelectorAll('.sortBtn');
    col.addEventListener('click', () => {
      buttons.forEach(btn => btn.classList.toggle('d-none', !btn.classList.contains('d-none')));
    });

    buttons.forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        btn.classList.add('d-none');
        const otherBtn = btn.nextElementSibling || btn.previousElementSibling;
        if (otherBtn) otherBtn.classList.remove('d-none');
      });
    });
  });

  // Show/hide password
  const eyeIcons = document.querySelectorAll(".eye-icon");
  const hidePasswordIcons = document.querySelectorAll(".hide-password");
  eyeIcons.forEach(icon => showPassword(icon));
  hidePasswordIcons.forEach(icon => hidePassword(icon));

  // Display users
  async function displayUsers(data, sortBy, order) {
    usersContainer.innerHTML = '';
    const sortedUsers = sortData(data.users, sortBy, order);

    sortedUsers.forEach(user => {
      const clone = template.content.cloneNode(true);
      const checkBoxUser = clone.querySelector('.checkbox-user');
      checkBoxUser.value = user.id;
      checkBoxUser.addEventListener('change', (e) => {
        if (!e.currentTarget.checked) checkAllUsers.checked = false;
      });

      ['first-name', 'last-name', 'email'].forEach((className) => {
        const el = clone.querySelector(`.${className}`);
        el.textContent = user[className.replace('-', '_')];
        el.dataset.id = user.id;
        el.addEventListener('click', handleUserClick);
      });

      const editButton = clone.querySelector('.edit-button');
      const deleteButton = clone.querySelector('.delete-button');
      [editButton, deleteButton].forEach(btn => btn.dataset.id = user.id);
      editButton.addEventListener('click', handleUserClick);

      usersContainer.appendChild(clone);
    });

    checkUser = document.querySelectorAll('.checkbox-user');
  }

  function handleUserClick(e) {
    e.stopPropagation();
    const userId = e.currentTarget.dataset.id;
    const sectionToShow = document.querySelector(`.${e.currentTarget.dataset.section}`);
    if (sectionToShow.classList.contains('d-none')) {
      allSections.forEach(section => section.classList.add('d-none'));
      sectionToShow.classList.remove('d-none');
    }
  }

  // Fetch and display users
  const users = await fetchUsers(1);
  displayUsers(users, 'Prenom', 'asc');

  // Check/uncheck all users
  checkAllUsers.addEventListener('change', (e) => {
    checkUser.forEach(checkbox => checkbox.checked = e.currentTarget.checked);
  });

  // Handle pagination
  async function paginationUsers(pagination) {
    const data = await fetchUsers();
    const totalPages = data.total_pages;

    if (totalPages > 1) {
      pagination.innerHTML = ''; // Clear existing pagination
      createPaginationButton(pagination, 'Previous', -1);
      
      for (let i = 1; i <= totalPages; i++) {
        const pageItem = document.createElement("li");
        pageItem.classList.add("page-item");
        pageItem.innerHTML = `<a class="page-link num-page" href="#" id="${i}">${i}</a>`;
        pagination.appendChild(pageItem);
      }

      createPaginationButton(pagination, 'Next', 1);
      const numPages = document.querySelectorAll(".num-page");
      numPages.forEach((numPage) => {
        numPage.addEventListener("click", async (e) => {
          e.preventDefault();
          const page = parseInt(e.currentTarget.textContent);
          localStorage.setItem("usersCurrentPage", page);
          numPages.forEach(num => num.style.backgroundColor = "transparent");
          e.currentTarget.style.backgroundColor = "#28a745";
          const users = await fetchUsers(page);
          displayUsers(users, 'Prenom', 'asc');
          checkAllUsers.checked = false;
        });
      });
    }
  }

  function createPaginationButton(pagination, label, offset) {
    const button = document.createElement("li");
    button.classList.add("page-item");
    button.innerHTML = `<a class="page-link" href="#" aria-label="${label}"><span aria-hidden="true">${label === 'Previous' ? '&laquo;' : '&raquo;'}</span></a>`;
    pagination.appendChild(button);
    button.addEventListener('click', async (e) => {
      e.preventDefault();
      const currentPage = parseInt(localStorage.getItem('usersCurrentPage'));
      const newPage = currentPage + offset;
      if (newPage > 0 && newPage <= totalPages) {
        localStorage.setItem('usersCurrentPage', newPage);
        const users = await fetchUsers(newPage);
        pagination.querySelectorAll(".num-page").forEach(num => num.style.backgroundColor = "transparent");
        const numPage = document.getElementById(`${newPage}`);
        if (numPage) numPage.style.backgroundColor = "#28a745";
        displayUsers(users, 'Prenom', 'asc');
        checkAllUsers.checked = false;
      }
    });
  }

  // Initialize pagination
  const pagination = document.querySelector(".pagination");
  paginationUsers(pagination);

  // Section toggle
  showSectionClickables.forEach((clickable) => {
    clickable.addEventListener('click', (e) => {
      const sectionToShow = document.querySelector(`.${e.currentTarget.dataset.section}`);
      allSections.forEach(section => section.classList.add('d-none'));
      sectionToShow.classList.remove('d-none');
      if (e.currentTarget.dataset.section === 'all-users-section') history.back();
    });
  });
});
