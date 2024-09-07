import { fetchModelsByBrand } from "./utils";

/**
 * Filters models by a specified attribute (NomModele, TypeMoteur, or Prix) and supports pagination.
 * 
 * @param {number} currentPage - The current page number to display.
 * @param {string} [filterBy='NomModele'] - The attribute to filter by. Defaults to 'NomModele'.
 * @param {string} [filter=''] - The filter value to match against the specified attribute.
 * @returns {Promise<Object>} - An object containing the filtered models, current page, total pages, and optionally an error message.
 * 
 * @returns {Promise<Object>} - The returned object includes:
 * - {Array} filteredData - An array of model objects that match the filter criteria.
 * - {number} currentPage - The current page number.
 * - {number} totalPages - The total number of pages available.
 * - {string} [MsgError] - An optional error message if an error occurred.
 */
async function filterModels(brand, currentPage = 1, filterBy = 'NomModele', filter = '') {
  try {
    const data = await fetchModelsByBrand(brand, currentPage);

    if (data.error) {
      console.log(data.error);
      return { filteredData: [], currentPage: 1, totalPages: 1, MsgError: data.error };
    }

    const totalPages = data.totalPages;

    // Filter models
    const filteredData = data.models.filter(model =>
      model[filterBy]?.toLowerCase().startsWith(filter.toLowerCase())
    );
    // Return filtered data
    return { filteredData, currentPage, totalPages };
    
  } catch (e) {
    throw(e)
   // return { filteredData: [], currentPage: 1, totalPages: 1, MsgError: e.message };
  }
}




document.addEventListener('DOMContentLoaded', async () => {
  const optionBrands = document.querySelector('#marque');
  const modelsModal = document.querySelector('.modal-body');
  const modelInput = document.getElementById('modele');
  const modalTitle = document.querySelector('.modal-title')
  const dataInput = document.getElementById('date')

  /**
   * Displays the models by brand in the models container.
   * 
   * @param {Object} data - The data object containing model information
   * @returns {void}
   */
  async function displayModelsByBrand(data) {
      modelsModal.innerHTML = ''; // Clear previous models

      if (data.MsgError) {
          console.log(data.MsgError);
          modelsModal.innerHTML = `<p class="error-message">${data.MsgError}</p>`;
          return;
      }

      data.filteredData.forEach((model) => {
          const modelContainer = document.createElement('div');
          modelContainer.classList.add('border-bottom', 'd-flex', 'align-items-center', 'mt-2');
          
          if (model.images.length > 0) {
              modelContainer.innerHTML =
              `
              <img src="../medias/images/${model.NomMarque}/${model.images[0].Nom}" alt="" style="width: 80px; height: 60px;">
              <h6 class="mx-3 model-name" data-id="${model.IdModele}">${model.NomModele}</h6>
              `;
          } else {
              modelContainer.innerHTML =
              `
              <h6 class="mx-3 model-name" data-id="${model.IdModele}">${model.NomModele}</h6>
              `;
          }
          modelsModal.appendChild(modelContainer);
      });

      // Add click event listeners to the dynamically created .model-name elements
      addModelClickEvents();
  }

  /**
   * Adds click event listeners to each model-name element.
   */
  function addModelClickEvents() {
      const modelsNames = document.querySelectorAll('.model-name');
      modelsNames.forEach((model) => {
          model.addEventListener('click', (e) => {
              const modelId = e.currentTarget.dataset.id;
              const modelName = e.currentTarget.textContent;
              modelInput.value = modelName;
              modelInput.dataset.id = modelId;
              const scrollModal = bootstrap.Modal.getInstance(
                document.getElementById("scrollModal")
              );
              scrollModal.hide();
              console.log(modelInput.dataset.id);
          });
      });
  }

  dataInput.addEventListener('change', (e)=>{
    console.log(e.currentTarget.value)
  })

  // display initial data
  const brandId = optionBrands.value;
  const models = await filterModels(brandId);
  displayModelsByBrand(models);
  //change the modal title to the textContent of the option selected
  modalTitle.textContent = optionBrands.selectedOptions[0].textContent

  // display models in the modal according to the value of the selected brand ('marque')
  optionBrands.addEventListener('change', async (e) => {
    //change the modal title to the textContent of the option selected
    modalTitle.textContent = optionBrands.selectedOptions[0].textContent
    const brandId = optionBrands.value;
    const models = await filterModels(brandId);
    if (models.filteredData.length === 0) {
        modelsModal.innerHTML = '<p>No models found.</p>';
        return;
    }
    displayModelsByBrand(models);
  });

  async function fetchAvailableHoures(date){
    try{
      const response = await fetch(`http://localhost/super-car/api/horaires.php`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          },
          body: JSON.stringify({date: date})
      })
      if(!response.ok){
        throw new Error(response.statusText)
      }
      const data = await response.json()
      console.log(data)
    }catch(e){
      console.log(e)
    }
  }
  fetchAvailableHoures('2024-09-14')
});
