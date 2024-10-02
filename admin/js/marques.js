import { sortData,
    toggleAndSortDataBtns, 
    fetchData,
    fetchDeleteRows,
    removeAlert,
    showAlert,
    handleClickDeleteMultiRowsBtn,
    showAndHideConfirmationBox,
  } from "./utils";
import { resetForm } from "/super-car/js/utils";

function isNumeric(value) {
  return !isNaN(value) && !isNaN(parseFloat(value));
}
function endPoint(marque) {
  if (isNumeric(marque)) {
    return `http://localhost/Super-car/admin/api/marques?marque=${marque}`;
  } else if (marque === "all") {
    return `http://localhost/Super-car/admin/api/marques?marque=all`;
  } else {
    throw new Error('Invalid value provided');
  }
}
document.addEventListener('DOMContentLoaded', async () => {
  const marquesContainer = document.querySelector('.marques-container');
  const template = document.getElementById("template-marque");
  const allSections = document.querySelectorAll('section');
  const showSectionClickables = document.querySelectorAll('.show-section');
  const deleteMultipleRowsBtn = document.querySelector(".delete-rows-btn");
  const sortButtons = document.querySelectorAll('.sortBtn');
  const theadColumns = document.querySelectorAll('.th-col');
  const checkAllMarques = document.querySelector('.check-all'); 
  const displayBradList = document.querySelector('.btn-list');
  const displayBradColonne = document.querySelector('.btn-colonne');
  let checkMarque = [];

  // Toggle sort buttons
  toggleAndSortDataBtns(theadColumns, sortButtons);

  // Function to toggle section display
  function toggleSection(sectionClass) {
    allSections.forEach(section => section.classList.add('d-none')); // Hide all sections
    document.querySelector(`.${sectionClass}`).classList.remove('d-none'); // Show the desired section
  }

  // Display data with sorting
  async function displayData(data, sortBy, order) {
    marquesContainer.innerHTML = '';
    const brands = data.data;
    const sortedBrands = sortData(brands, sortBy, order);
    
    sortedBrands.forEach(brand => {
      const clone = template.content.cloneNode(true);

      const checkBoxMarque = clone.querySelector('.checkbox-marque');
      checkBoxMarque.value = brand.IdMarques;

      checkBoxMarque.addEventListener('change', () => {
        if (!checkBoxMarque.checked) {
          checkAllMarques.checked = false;
        }
        // Enable or disable the delete button based on user selection
        deleteMultipleRowsBtn.disabled = !Array.from(checkMarque).some(
        (checkbox) => checkbox.checked)
      });

      const idMarque = clone.querySelector('.id-brand');
      idMarque.textContent = brand.IdMarque;
      
      const brandName = clone.querySelector('.brand-name');
      brandName.textContent = brand.NomMarque;
      
      [idMarque, brandName].forEach(el => el.dataset.id = brand.IdMarque);
      const editButton = clone.querySelector('.edit-button');
      const deleteButton = clone.querySelector('.delete-button');
      [editButton, deleteButton].forEach(btn => btn.dataset.id = brand.IdMarque);

      marquesContainer.appendChild(clone);

      // Events to display details/edit sections
      [idMarque, brandName, editButton].forEach((btn) => {
        btn.addEventListener('click', async (e) => {
          const sectionToShowClass = e.currentTarget.dataset.section;
          toggleSection(sectionToShowClass);

          const brandId = parseInt(e.currentTarget.dataset.id);
          const brand = await fetchData(endPoint(brandId));
          Object.keys(brand).forEach(key => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input) input.value = brand[key];
          });
        });
      });

      // Event to display brands in list/column mode
      document.querySelectorAll('.view-MarqueBtn').forEach(button => {
        button.addEventListener('click', async (e) => {
          const sectionToShowClass = e.currentTarget.dataset.section;
          toggleSection(sectionToShowClass);

          const brandId = parseInt(e.currentTarget.dataset.id);
          const brand = await fetchData(endPoint(brandId));
          Object.keys(brand).forEach(key => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input) input.value = brand[key];
          });

          document.querySelector('.display-all-marques-column').classList.add('d-none');
          document.querySelector('.display-all-marques-list').classList.remove('d-none');
          [displayBradColonne, displayBradList].forEach(btn => btn.classList.toggle('d-none'));
        });
      });
    });
    checkMarque = document.querySelectorAll('.checkbox-marque');
    // Enable or disable the delete button based on user selection
    deleteMultipleRowsBtn.disabled = !Array.from(checkMarque).some(
      (checkbox) => checkbox.checked)
  }

  const brands = await fetchData(endPoint("all"));
  displayData(brands, 'NomMarque', 'asc');

  // Toggle between column and list view
  [displayBradColonne, displayBradList].forEach(btn => {
    btn.addEventListener('click', (e) => {
      const clickedBtn = e.currentTarget;
      const siblingBtn = clickedBtn.previousElementSibling || clickedBtn.nextElementSibling;
      const classDisplay = clickedBtn.dataset.styleDisplay;
      const classToHide = siblingBtn.dataset.styleDisplay;

      clickedBtn.classList.add('d-none');
      siblingBtn.classList.remove('d-none');

      document.querySelector(`.${classDisplay}`).classList.remove('d-none');
      document.querySelector(`.${classToHide}`).classList.add('d-none');
    });
  });

  // Handle "select all" checkbox
  checkAllMarques.addEventListener('change', (e) => {
    const isChecked = e.currentTarget.checked;
    checkMarque.forEach(checkbox => checkbox.checked = isChecked);
    // Enable or disable the delete button based on user selection
    deleteMultipleRowsBtn.disabled = !Array.from(checkMarque).some(
    (checkbox) => checkbox.checked)
  });

  // Events to show sections on button click
  showSectionClickables.forEach(clickable => {
    clickable.addEventListener('click', (e) => {
      const sectionToShowClass = e.currentTarget.dataset.section;
      toggleSection(sectionToShowClass);
    });
  });
});
