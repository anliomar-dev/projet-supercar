import { fetchUsers, sortData, getUser, toggleAndSortDataBtns, fetchData, resetFormInputs } from "./utils";
import { showPassword, hidePassword, createUser } from "/super-car/js/utils";

// current page
localStorage.setItem("modelsCurrentPage", 1);
function isNumeric(value) {
  return !isNaN(value) && !isNaN(parseFloat(value));
}
let byBrand = false;
function endPoint(value, page = 1, ifByBrand = byBrand) {
  if (ifByBrand) {
    return `http://localhost/Super-car/admin/api/modeles?brand_id=${value}&page=${page}`;
  } else {
    if (isNumeric(value)) {
      return `http://localhost/Super-car/admin/api/modeles?modele=${value}`;
    } else if (value === "all") {
      return `http://localhost/Super-car/admin/api/modeles?modele=all&page=${page}`;
    } else {
      throw new Error('Invalid value provided');
    }
  }
}

let urlEndPoint = endPoint("all")

document.addEventListener('DOMContentLoaded', async ()=>{
  const modeleContainer = document.querySelector('.models-container');
  const template = document.getElementById("template-modele");
  const allSections = document.querySelectorAll('section');
  const showSectionClickables = document.querySelectorAll('.show-section')
  const sortButtons = document.querySelectorAll('.sortBtn');
  const btnRetour = document.querySelector('.btn-retour')
  const theadColumns = document.querySelectorAll('.th-col')
  const checkAllModels = document.querySelector('.check-all');
  const updateAndAddForm = document.querySelector('.update-and-add-form');
  const title = document.querySelector('.title')
  let checkModele = [];

  btnRetour.addEventListener('click', ()=>{
    resetFormInputs(updateAndAddForm)
  })
  
  toggleAndSortDataBtns(theadColumns, sortButtons)
  
  
  //show and hide password
  const eyeIcons = document.querySelectorAll(".eye-icon"); //show password icons
  const hidePasswordIcons = document.querySelectorAll(".hide-password"); //hide password icons
  eyeIcons.forEach((eyeIcon) => showPassword(eyeIcon)); //show password
  hidePasswordIcons.forEach((hidePasswordIcon) =>
    hidePassword(hidePasswordIcon)
  ); //hide password
  
  
  async function displayData(data, sortBy, order) {
    modeleContainer.innerHTML = '';
    const models = data.data;
    const sortedData = sortData(data.data, sortBy, order);
    
    sortedData.forEach(row => {
      const clone = template.content.cloneNode(true);
      
      const checkBoxModele = clone.querySelector('.checkbox-modele');
      checkBoxModele.value = data.IdModele;

      // Listener for each user checkbox
      checkBoxModele.addEventListener('change', (e) => {
        if (!e.currentTarget.checked) {
          checkAllModels.checked = false;
        }
      });
      
      const  year = clone.querySelector('.annee');
      year.textContent = row.Annee;
      
      const NomModele = clone.querySelector('.modele');
      NomModele.textContent = row.NomModele
      
      
      const Prix = clone.querySelector('.prix');
      Prix.textContent = row.Prix;
  
      const editButton = clone.querySelector('.edit-button'); // Correctly target from the clone
      const deleteButton = clone.querySelector('.delete-button'); // Correctly target from the clone
      [year, NomModele, Prix, editButton, deleteButton].forEach(btn => btn.dataset.id = row.IdModele);
  
      modeleContainer.appendChild(clone);

      [NomModele, Prix, year, editButton].forEach((btn)=>{
        btn.addEventListener('click', async(e) => {
          const sectionToShowClass = e.currentTarget.dataset.section;
          const sectionToShow = document.querySelector(`.${sectionToShowClass}`)
          allSections.forEach((section)=>{
            if(!section.classList.contains('d-none')){
              section.classList.add('d-none');
            }
            sectionToShow.classList.remove('d-none');
          })
          const modeleId = parseInt(e.currentTarget.dataset.id);
          const modele = await fetchData(`http://localhost/Super-car/admin/api/modeles?modele=${modeleId}`);
          const currentPrice = parseFloat(modele.Prix);
          const priceInput = document.querySelector(`[name="Prix"]`)
          priceInput.setAttribute('min', `${currentPrice}`)
          const maxPrice = currentPrice * 1.25
          priceInput.setAttribute('max', `${maxPrice}`)
          Object.keys(modele).forEach(key => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input) {
                input.value = modele[key];  // Assigner la valeur correspondante au champ
            }
          });
        })
      })
    });
    checkModele = document.querySelectorAll('.checkbox-modele');
  }
  let models = await fetchData(urlEndPoint)
  displayData(models, 'NomModele', 'asc')

  const marqueOption = document.getElementById('marqueOption');
  marqueOption.addEventListener('change', async(e)=>{
    const value = e.target.value;
    const selectedOption = marqueOption.options[marqueOption.selectedIndex]; // Obtenir l'option sélectionnée
    const selectedText = selectedOption.textContent;
    if(value === "all"){
      byBrand = false;
      models = await fetchData(endPoint(value, 1, byBrand))
      displayData(models, 'NomModele', 'asc')
      title.textContent = "Modèles";
    }else if(parseInt(value)){
      byBrand = true;
      models = await fetchData(endPoint(value, 1, byBrand));
      displayData(models, 'NomModele', 'asc');
      title.textContent = selectedText;
    }
    paginationData(pagination, models.total_pages);
  })
  checkAllModels.addEventListener('change', (e) => {
    const isChecked = e.currentTarget.checked;
    checkModele.forEach(checkbox => {
      checkbox.checked = isChecked;
    });
  });


  // dynamic pagination
  const pagination = document.querySelector(".pagination");
  async function paginationData(pagination, totalPages) {
    
    pagination.innerHTML = "";
    
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
        const currentPage = parseInt(localStorage.getItem('modelsCurrentPage'));
        if(currentPage > 1){
          const prevPage = currentPage - 1;
          localStorage.setItem('modelsCurrentPage', prevPage);
          
          models = byBrand ? await fetchData(endPoint(parseInt(marqueOption.value), prevPage)) : 
          await fetchData(endPoint("all", prevPage))
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          const numPage = document.getElementById(`${prevPage}`)
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          displayData(models, 'NomModele', 'asc')
          checkAllModels.checked = false;
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
          localStorage.setItem("modelsCurrentPage", e.currentTarget.textContent);
          const currentPage = parseInt(localStorage.getItem("modelsCurrentPage"));
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          const newEndpoint = endPoint("all", )
          //models = await fetchData(endPoint("all", currentPage))
          models = byBrand ? await fetchData(endPoint(parseInt(marqueOption.value), currentPage)) : 
          await fetchData(endPoint("all", currentPage))
          displayData(models, 'NomModele', 'asc');
          checkAllModels.checked = false;
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
        const currentPage = parseInt(localStorage.getItem('modelsCurrentPage'));
        if(currentPage < totalPages){
          const NextPage = currentPage + 1;
          localStorage.setItem('modelsCurrentPage', NextPage);
          //models = await fetchData(endPoint("all", NextPage))
          models = byBrand ? await fetchData(endPoint(parseInt(marqueOption.value), NextPage)) : 
          await fetchData(endPoint("all", NextPage))
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          const numPage = document.getElementById(`${NextPage}`)
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          displayData(models, 'NomModele', 'asc')
          checkAllModels.checked = false;
        }
      })
      
    }
  }
  checkAllModels.addEventListener('change', (e)=>{
    if(e.currentTarget.checked){
      checkModele.forEach(checkbox => {
        checkbox.checked = true;
      })
    }else{
      checkModele.forEach(checkbox => {
        checkbox.checked = false;
      })
    }
  })
  // dispal paginations buttons
  const initialData = await fetchData(endPoint("all"))
  paginationData(pagination, initialData.total_pages);
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