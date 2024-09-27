import { fetchUsers, sortData, getUser, toggleAndSortDataBtns } from "./utils";
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
  const checkAllRows = document.querySelector('.check-all');
  const deleteMultipleRowsBtn = document.querySelector('.delete-all-btn');
  let checkRow = [];
  
  toggleAndSortDataBtns(theadColumns, sortButtons)
  
  
  //show and hide password
  const eyeIcons = document.querySelectorAll(".eye-icon"); //show password icons
  const hidePasswordIcons = document.querySelectorAll(".hide-password"); //hide password icons
  eyeIcons.forEach((eyeIcon) => showPassword(eyeIcon)); //show password
  hidePasswordIcons.forEach((hidePasswordIcon) =>
    hidePassword(hidePasswordIcon)
  ); //hide password
  
  
  async function displayData(data, sortBy, order, colClasse1, colValue1, colClasse2, colValue1, coClassel2, colValue3, id) {
    usersContainer.innerHTML = '';
    const data = data.data;
    const sortedData = sortData(data, sortBy, order);
    
    sortedData.forEach(row => {
      const clone = template.content.cloneNode(true);
      
      const checkBoxRow = clone.querySelector('.checkbox-row');
      checkBoxRow.value = id;

      // Listener for each user checkbox
      checkBoxRow.addEventListener('change', (e) => {
        if (!e.currentTarget.checked) {
          checkAllRows.checked = false; // uncheck checkAllUser if one checkbox is unchecked
        }
      });
      
      const first_column = clone.querySelector(`.${colClasse1}`); // Correctly target from the clone
      first_column.textContent = colValue1;
      first_column.dataset.id = id;
      
      const last_name = clone.querySelector('.last-name'); // Correctly target from the clone
      last_name.textContent = user.last_name;
      last_name.dataset.id = user.id;
      
      const email = clone.querySelector('.email'); // Correctly target from the clone
      email.textContent = user.email;
      email.dataset.id = user.id;
      
      const editButton = clone.querySelector('.edit-button'); // Correctly target from the clone
      const deleteButton = clone.querySelector('.delete-button'); // Correctly target from the clone
      [editButton, deleteButton].forEach(btn => btn.dataset.id = user.id);
  
      usersContainer.appendChild(clone);

      [first_name, last_name, email, editButton].forEach((btn)=>{
        btn.addEventListener('click', async(e) => {
          const sectionToShowClass = e.currentTarget.dataset.section;
          const sectionToShow = document.querySelector(`.${sectionToShowClass}`)
          allSections.forEach((section)=>{
            if(!section.classList.contains('d-none')){
              section.classList.add('d-none');
            }
            sectionToShow.classList.remove('d-none');
          })
          const userId = e.currentTarget.dataset.id;
          const user = await getUser(userId);
          displayUserInfos(user)
        })
      })
    });
    checkUser = document.querySelectorAll('.checkbox-user');
    const checkUserArray = [...checkUser]
    checkUserArray.forEach((checkbox)=>{
      checkbox.addEventListener('change', (e)=>{
        if(checkUserArray.every(checkbox=>checkbox.checked)){
          checkAllUsers.checked = true;
          }
          else{
            checkAllUsers.checked = false;
          }
          if (checkUserArray.some(checkbox => checkbox.checked)) {
            deleteMultipleRowsBtn.disabled = false; // Activez le bouton si au moins une case est cochée
          } else {
            deleteMultipleRowsBtn.disabled = true; // Désactivez le bouton si aucune case n'est cochée
          }
        })
    })
  }
  const users = await fetchUsers(1)
  displayUsers(users, 'Prenom', 'asc')

  checkAllUsers.addEventListener('change', (e) => {
    const isChecked = e.currentTarget.checked;
    checkUser.forEach(checkbox => {
      checkbox.checked = isChecked;
      deleteMultipleRowsBtn.disabled = !isChecked;
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