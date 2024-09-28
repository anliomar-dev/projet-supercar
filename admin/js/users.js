import { 
  fetchUsers, sortData, 
  getUser, toggleAndSortDataBtns, 
  updateCheckedCasesDatasetIds 
} from "./utils";
import { showPassword, hidePassword, createUser, resetForm } from "/super-car/js/utils";

// current page
localStorage.setItem("usersCurrentPage", 1);

document.addEventListener('DOMContentLoaded', async ()=>{
  const passwordInput = document.getElementById("password");
  const passwordConfirmInput = document.getElementById("confirmPassword");
  const usersContainer = document.querySelector('.users-container');
  const template = document.getElementById("template-user");
  const allSections = document.querySelectorAll('section');
  const showSectionClickables = document.querySelectorAll('.show-section');
  const sortButtons = document.querySelectorAll('.sortBtn');
  const theadColumns = document.querySelectorAll('.th-col');
  const checkAllUsers = document.querySelector('.check-all');
  const deleteMultipleRowsBtn = document.querySelector('.delete-all-btn');
  let checkUser = [];
  const checkedCasesDatasetIds = [];
  
  toggleAndSortDataBtns(theadColumns, sortButtons);
  
  // show and hide password
  const eyeIcons = document.querySelectorAll(".eye-icon"); // show password icons
  const hidePasswordIcons = document.querySelectorAll(".hide-password"); // hide password icons
  eyeIcons.forEach((eyeIcon) => showPassword(eyeIcon)); // show password
  hidePasswordIcons.forEach((hidePasswordIcon) =>
    hidePassword(hidePasswordIcon)
  ); // hide password
  
  async function displayUsers(data, sortBy, order) {
    usersContainer.innerHTML = '';
    const users = data.users || []; 
    const sortedUsers = sortData(users, sortBy, order);

    if (sortedUsers.length === 0) {
        usersContainer.innerHTML = '<p>No users available.</p>';
        return;
    }

    sortedUsers.forEach(user => {
        const clone = template.content.cloneNode(true);
        
        const checkBoxUser = clone.querySelector('.checkbox-user');
        checkBoxUser.value = user.id;

        // Listener for each user checkbox
        checkBoxUser.addEventListener('change', (e) => {
            if (!e.currentTarget.checked) {
                checkAllUsers.checked = false; // Uncheck checkAllUsers if a checkbox is unchecked
            }
            // Update the selected checkboxes array
            updateCheckedCasesDatasetIds(checkedCasesDatasetIds, checkUser);

            // Enable or disable the delete button based on user selection
            deleteMultipleRowsBtn.disabled = !Array.from(checkUser).some(checkbox => checkbox.checked);
        });

        // Fill in user information
        const first_name = clone.querySelector('.first-name');
        first_name.textContent = user.first_name;
        first_name.dataset.id = user.id;
        
        const last_name = clone.querySelector('.last-name');
        last_name.textContent = user.last_name;
        last_name.dataset.id = user.id;
        
        const email = clone.querySelector('.email');
        email.textContent = user.email;
        email.dataset.id = user.id;

        const editButton = clone.querySelector('.edit-button');
        const deleteButton = clone.querySelector('.delete-button');
        [editButton, deleteButton].forEach(btn => btn.dataset.id = user.id);

        usersContainer.appendChild(clone); // Add the clone to the container

        // Listener for buttons (editing users)
        [first_name, last_name, email, editButton].forEach((btn) => {
            btn.addEventListener('click', async (e) => {
                const sectionToShowClass = e.currentTarget.dataset.section;
                const sectionToShow = document.querySelector(`.${sectionToShowClass}`);
                allSections.forEach((section) => {
                    section.classList.add('d-none'); // Hide all sections
                });
                sectionToShow.classList.remove('d-none'); // Show the targeted section
                
                const userId = e.currentTarget.dataset.id; // Get user ID
                const user = await getUser(userId); // Fetch user information
                displayUserInfos(user); // Display user information
            });
        });
    });

    checkUser = document.querySelectorAll('.checkbox-user'); // Update references for checkboxes
    updateCheckedCasesDatasetIds(checkedCasesDatasetIds, checkUser); // Update after display

    // Enable or disable the delete button based on user selection
    deleteMultipleRowsBtn.disabled = !Array.from(checkUser).some(checkbox => checkbox.checked);
}

const checkUserArray = [...checkUser];
checkUserArray.forEach((checkbox) => {
    checkbox.addEventListener('change', (e) => {
        // Update checkAllUsers checkbox based on the state of user checkboxes
        checkAllUsers.checked = checkUserArray.every(checkbox => checkbox.checked);
    
        // Enable or disable the delete button based on user selection
        deleteMultipleRowsBtn.disabled = !checkUserArray.some(checkbox => checkbox.checked);
    
        // Update the checkedCasesDatasetIds array
        updateCheckedCasesDatasetIds(checkedCasesDatasetIds, checkUser);
    });
});

const users = await fetchUsers();
displayUsers(users, 'Prenom', 'asc');

checkAllUsers.addEventListener('change', (e) => {
    const isChecked = e.currentTarget.checked;
    checkUser.forEach(checkbox => {
        checkbox.checked = isChecked;
        deleteMultipleRowsBtn.disabled = !isChecked;
    });
    updateCheckedCasesDatasetIds(checkedCasesDatasetIds, checkUser);
});

async function displayUserInfos(user) {
    const firstName = document.getElementById('first_name');
    const lastName = document.getElementById('last_name');
    const email = document.getElementById('email');
    const address = document.getElementById('adresse');
    const phone = document.getElementById('phone');
    firstName.value = user.first_name;
    lastName.value = user.last_name;
    email.value = user.email;
    address.value = user.address;
    phone.value = user.phone;
}

// Show and hide sections
showSectionClickables.forEach((clickable) => {
    clickable.addEventListener('click', (e) => {
      const sectionToShowClass = e.currentTarget.dataset.section;
      const sectionToShow = document.querySelector(`.${sectionToShowClass}`);
      allSections.forEach((section) => {
        if (!section.classList.contains('d-none')) {
          section.classList.add('d-none');
        }
        sectionToShow.classList.remove('d-none');
      });
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

        prevBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            const currentPage = parseInt(localStorage.getItem('usersCurrentPage'));
            if (currentPage > 1) {
                const prevPage = currentPage - 1;
                localStorage.setItem('usersCurrentPage', prevPage);
                const users = await fetchUsers(prevPage);
                numPages.forEach((num) => {
                    num.style.backgroundColor = "transparent";
                    num.style.color = "black";
                });
                const numPage = document.getElementById(`${prevPage}`);
                numPage.style.backgroundColor = "#28a745";
                numPage.style.color = "#fff";
                displayUsers(users, 'Prenom', 'asc');
                checkAllUsers.checked = false;
            }
        });

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
                e.currentTarget.style.outline = 'none';
                localStorage.setItem("usersCurrentPage", e.currentTarget.textContent);
                const currentPage = parseInt(localStorage.getItem("usersCurrentPage"));
                numPages.forEach((num) => {
                    num.style.backgroundColor = "transparent";
                    num.style.color = "black";
                });
                numPage.style.backgroundColor = "#28a745";
                numPage.style.color = "#fff";
                const users = await fetchUsers(currentPage);
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
        pagination.appendChild(nextBtn);

        nextBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            const currentPage = parseInt(localStorage.getItem('usersCurrentPage'));
            if (currentPage < totalPages) {
                const nextPage = currentPage + 1;
                localStorage.setItem('usersCurrentPage', nextPage);
                const users = await fetchUsers(nextPage);
                numPages.forEach((num) => {
                    num.style.backgroundColor = "transparent";
                    num.style.color = "black";
                });
                const numPage = document.getElementById(`${nextPage}`);
                numPage.style.backgroundColor = "#28a745";
                numPage.style.color = "#fff";
                displayUsers(users, 'Prenom', 'asc');
                checkAllUsers.checked = false;
            }
        });
    }
}
paginationUsers(pagination);
})