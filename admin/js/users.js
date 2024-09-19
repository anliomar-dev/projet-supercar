import { fetchUsers, sortData } from "./utils";
import { showPassword, hidePassword, createUser, resetForm } from "/super-car/js/utils";

// current page
localStorage.setItem("usersCurrentPage", 1);

document.addEventListener('DOMContentLoaded', async ()=>{
  const passwordInput = document.getElementById("password");
  const passwordConfirmInput = document.getElementById("confirmPassword");
  const usersContainer = document.querySelector('.users-container');
  const template = document.getElementById("template-user");
  const allSections = document.querySelectorAll('section');
  const showSectionClickables = document.querySelectorAll('.show-section')
  const sortButtons = document.querySelectorAll('.sortBtn');
  const theadColumns = document.querySelectorAll('.th-col')
  const checkAllUsers = document.querySelector('.check-all');
  let checkUser = [];
  
  theadColumns.forEach((col) => {
    col.addEventListener('click', (e) => {
      // Récupérer les boutons de tri de la colonne cliquée
      const buttons = col.parentElement.querySelectorAll('.sortBtn');
      
      // Vérifier si un bouton est déjà visible
      const visibleButton = Array.from(buttons).find(btn => !btn.classList.contains('d-none'));

      if (visibleButton) {
        // if there is any visible button: then hide it
        visibleButton.classList.add('d-none');
      } else {
        // hide all sort button to ensure only one button is display
        sortButtons.forEach((btn) => {
          btn.classList.add('d-none');
        });

        // display first sort button for the first click of the column
        buttons[0].classList.remove('d-none');
      }
    });

    // handdle display and hide sort buttons
    col.parentElement.querySelectorAll('.sortBtn').forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();

        // hide clicked button
        btn.classList.add('d-none');

        // display other sort button
        const otherBtn = btn.nextElementSibling || btn.previousElementSibling;
        otherBtn.classList.remove('d-none');
      });
    });
  });
  
  
  
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

      // Listener for each user checkbox
      checkBoxUser.addEventListener('change', (e) => {
        if (!e.currentTarget.checked) {
          checkAllUsers.checked = false; // uncheck checkAllUser if one checkbox is unchecked
        }
      });
      
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

      [first_name, last_name, email, editButton].forEach((btn)=>{
        btn.addEventListener('click', (e) => {
          const sectionToShowClass = e.currentTarget.dataset.section;
          const sectionToShow = document.querySelector(`.${sectionToShowClass}`)
          allSections.forEach((section)=>{
            if(!section.classList.contains('d-none')){
              section.classList.add('d-none');
            }
            sectionToShow.classList.remove('d-none');
          })
        })
      })
    });
    checkUser = document.querySelectorAll('.checkbox-user');
  }
  const users = await fetchUsers(1)
  displayUsers(users, 'Prenom', 'asc')

  checkAllUsers.addEventListener('change', (e) => {
    const isChecked = e.currentTarget.checked;
    checkUser.forEach(checkbox => {
      checkbox.checked = isChecked;
    });
  });

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
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          const numPage = document.getElementById(`${prevPage}`)
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          displayUsers(users, 'Prenom', 'asc')
          checkAllUsers.checked = false;
        }
      })

      // create pagination buttons
      for (let i = 1; i <= totalPages; i++) {
        const pageItem = document.createElement("li");
        pageItem.classList.add("page-item");
        pageItem.innerHTML = `<a class="page-link num-page" href="#" id="${i}">${i}</a>`;
        pagination.appendChild(pageItem);
      }

      // add event listener to pagination buttons
      const numPages = document.querySelectorAll(".num-page");
      numPages.forEach((numPage) => {
        numPage.addEventListener("click", async (e) => {
          e.preventDefault();
          e.currentTarget.style.outline = 'none'
          localStorage.setItem("usersCurrentPage", e.currentTarget.textContent);
          const currentPage = parseInt(localStorage.getItem("usersCurrentPage"));
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          const users = await fetchUsers(currentPage)
          displayUsers(users, 'Prenom', 'asc');
          checkAllUsers.checked = false;
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
          const users = await fetchUsers(NextPage);
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          const numPage = document.getElementById(`${NextPage}`)
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          displayUsers(users, 'Prenom', 'asc')
          checkAllUsers.checked = false;
        }
      })
      
    }
  }
  checkAllUsers.addEventListener('change', (e)=>{
    if(e.currentTarget.checked){
      checkUser.forEach(checkbox => {
        checkbox.checked = true;
      })
    }else{
      checkUser.forEach(checkbox => {
        checkbox.checked = false;
      })
    }
  })
  // dispal paginations buttons
  paginationUsers(pagination);
  showSectionClickables.forEach((clickable)=>{
    clickable.addEventListener('click', (e)=>{
      const sectionToShowClass = e.currentTarget.dataset.section;
      const sectionToShow = document.querySelector(`.${sectionToShowClass}`)
      allSections.forEach((section)=>{
        if(!section.classList.contains('d-none')){
          section.classList.add('d-none');
        }
        sectionToShow.classList.remove('d-none');
      })
    })
  })
})