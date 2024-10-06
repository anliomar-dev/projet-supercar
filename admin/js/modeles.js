import { sortData, toggleAndSortDataBtns, fetchData, resetFormInputs } from "./utils";

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
  const deleteMultipleRowsBtn = document.querySelector(".delete-rows-btn");
  const title = document.querySelector('.title')
  let checkModele = [];

  btnRetour.addEventListener('click', ()=>{
    updateAndAddForm.querySelectorAll('input:not([type="hidden"])')
    .forEach((input) => (input.value = ""));
  })
  
  toggleAndSortDataBtns(theadColumns, sortButtons)
  
  
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
        // Enable or disable the delete button based on user selection
        deleteMultipleRowsBtn.disabled = !Array.from(checkModele).some(
        (checkbox) => checkbox.checked)
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
          updateAndAddForm.querySelector('#action').value = "update"
          console.log(updateAndAddForm.querySelector('#action').value)
          allSections.forEach((section)=>{
            if(!section.classList.contains('d-none')){
              section.classList.add('d-none');
            }
            sectionToShow.classList.remove('d-none');
          })
          const modeleId = parseInt(e.currentTarget.dataset.id);
          const modele = await fetchData(`http://localhost/Super-car/admin/api/modeles?modele=${modeleId}`);
          document.querySelector('#oldPrice').value = modele.Prix;
          /*const currentPrice = parseFloat(modele.Prix);
          const priceInput = document.querySelector(`[name="Prix"]`)
          priceInput.setAttribute('min', `${currentPrice}`)
          const maxPrice = currentPrice * 1.25
          priceInput.setAttribute('max', `${maxPrice}`)*/
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
    // Enable or disable the delete button based on user selection
    deleteMultipleRowsBtn.disabled = !Array.from(checkModele).some(
    (checkbox) => checkbox.checked)
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
    checkModele.forEach(checkbox => checkbox.checked = isChecked);
    // Enable or disable the delete button based on user selection
    deleteMultipleRowsBtn.disabled = !Array.from(checkModele).some(
    (checkbox) => checkbox.checked)
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

  // event listerner to btn add new modele
  const addNewModel = document.querySelector('.add-new-modele-btn');
  addNewModel.addEventListener('click', async (e)=>{
    e.preventDefault();
    updateAndAddForm.querySelector('#action').value = 'add'
    console.log(updateAndAddForm.querySelector('#action').value)
  })

  // submission update and delete form
  updateAndAddForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(updateAndAddForm);


    // Création de l'objet userData
    const modeleData = {
      NomModele: formData.get("NomModele"),
      Prix: formData.get("Prix"),
      Annee: formData.get("Annee"),
      TypeMoteur: formData.get("TypeMoteur"),
      BoiteVitesse: formData.get("BoiteVitesse"),
      Carburant: formData.get("Carburant"),
      IdMarque: formData.get("IdMarque"),
      Description: formData.get("Description"),
    };
    const action = formData.get("action")
    const idModele = action === 'update' ? formData.get('IdModele'): null;
    const oldPrice = action === 'update' ? formData.get('oldPrice'): null
    // CSRF token of the session
    const csrf_token = formData.get("csrf_token");

    // Logged-in user ID
    const loggedInUserID = formData.get("authenticated_userId");

    const data = {
    csrf_token: csrf_token,
    loggedInUserID: loggedInUserID,
    modele_data: modeleData,
    action: action,
    };
    if(action === "update"){
      data["idModele"] = idModele;
      data["oldPrice"] = oldPrice;
    }
      
    console.log(data)
    /*try {
      // Await the response from sendData
      const response = await sendData(
          data,
          "POST",
          "http://localhost/super-car/admin/api/utilisateurs"
      );
      const responseStatus = response.status;
      const responseMessage = response.message;

      // Switch based on response status
      switch (responseStatus) {
          case "error":
              showAlert(alertDanger, responseMessage);
              removeAlert(alertDanger);
              break;
          case "success":
              showAlert(alertSuccess, responseMessage);
              removeAlert(alertSuccess);
              const users = await fetchUsers();
              displayUsers(users, "Prenom", "asc");
          break;
          case "403":
              window.location.href =
              "http://localhost/super-car/admin/permission_denied";
              break;
          default:
          console.log(responseStatus);
      }
    } catch (error) {
        console.error("Error during data submission:", error);
    }*/
  });
})