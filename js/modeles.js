import { fetchModelsByBrand } from "./utils";

// Get the query string (everything after the '?')
const queryString = window.location.search;

// Create a URLSearchParams object from the query string
const urlParams = new URLSearchParams(queryString);

// Retrieve the value of the 'brand_id' parameter
const brandId = urlParams.get('brand');

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
async function filterModels(currentPage = 1, filterBy = 'NomModele', filter = '', compare='min') {
  try {
    const data = await fetchModelsByBrand(brandId, currentPage);

    if (data.error) {
      console.log(data.error);
      return { filteredData: [], currentPage: 1, totalPages: 1, MsgError: data.error };
    }

    const totalPages = data.totalPages;

    
    if(filterBy === 'Prix'){
      if(compare === 'min'){
        const filteredData = data.models.filter(model => parseFloat(model.Prix) >= filter);
        // Return filtered data
        return { filteredData, currentPage, totalPages };
      }else if(compare === 'max'){
        const filteredData = data.models.filter(model => parseFloat(model.Prix) <= filter);
        // Return filtered data
        return { filteredData, currentPage, totalPages };
      }
    }else{
      // Filter models
      const filteredData = data.models.filter(model =>
        model[filterBy]?.toLowerCase().startsWith(filter.toLowerCase())
      );
      // Return filtered data
      return { filteredData, currentPage, totalPages };
    }

    
  } catch (e) {
    throw(e)
   // return { filteredData: [], currentPage: 1, totalPages: 1, MsgError: e.message };
  }
}


document.addEventListener('DOMContentLoaded', async () => {
  const sideBarSections = document.querySelectorAll('.brows-by-type, .filter, .sort, .search');
  const filterOptions = document.getElementById('filterOptions');
  const sideBar = document.querySelector('.sidbar');
  const toggleSideBar = document.querySelector('.toggle-side-bar');
  const closeSidebarButton = document.querySelector('.close-sidebar');
  const template = document.getElementById('template-model');
  const filterByEngine = document.querySelectorAll('.filterByEngine');
  const modelsContainer = document.querySelector('.models-container');
  const filterByPriceButtons = document.querySelectorAll('.searchButton');
  const searchBarModel = document.getElementById('search');
  const searchForm = document.querySelector('.search-form');
  const showAllModelsBtn = document.querySelector('.show-all-models-btn');
  searchForm.addEventListener('submit', (e) =>{
    e.preventDefault()
  })

  filterOptions.addEventListener('change', () => {
    const selectedOption = filterOptions.value;
    sideBarSections.forEach(section => section.style.display = 'none');
    const optionsToShow = document.querySelector(`.${selectedOption}`);
    optionsToShow.style.display = 'block';
  });

  toggleSideBar.addEventListener('click', () => {
    sideBar.classList.add('sidebar-opened');
  });

  closeSidebarButton.addEventListener('click', () => {
    sideBar.classList.remove('sidebar-opened');
  });

  /**
   * Displays the models by brand in the models container.
   * 
   * @param {Object} data - The data object containing model information
   * @returns {void}
   */
  async function displayModelsByBrand(data) {
    modelsContainer.innerHTML = ''; // Clear previous models

    if (data.MsgError) {
      console.log(data.MsgError);
      // Optionally, show error message to user
      modelsContainer.innerHTML = `<p class="error-message">${data.MsgError}</p>`;
      return;
    }

    if (data.filteredData.length === 0) {
      modelsContainer.innerHTML = '<p>No models found.</p>';
      return;
    }

    data.filteredData.forEach((model) => {
      const clone = template.content.cloneNode(true);
      clone.getElementById('model-name').textContent = model.NomModele || 'Unknown';
      clone.getElementById('model-brand').textContent = model.NomMarque || 'Unknown';
      clone.getElementById('model-year').textContent = model.Annee || 'Unknown';
      clone.getElementById('model-price').textContent = model.Prix || 'Unknown';
      clone.getElementById('model-engine').textContent = model.TypeMoteur || 'Unknown';
      clone.querySelector('.brand-logo').src = `../medias/images/logos/${model.logo || 'default-logo.png'}`;

      if (model.images.length > 0) {
        clone.getElementById('image-model').src = `../medias/images/${model.NomMarque}/${model.images[0].Nom}`;
      }

      modelsContainer.appendChild(clone);
    });
  }

  // Display models on initial load
  const initialData = await filterModels();
  displayModelsByBrand(initialData);

  // Add event listeners for filter buttons
  filterByEngine.forEach((filterBtn) => {
    filterBtn.addEventListener('click', async (e) => {
      const filterBy = 'TypeMoteur';
      const filterValue = e.currentTarget.dataset.type;
      const newData = await filterModels(1, filterBy, filterValue);
      displayModelsByBrand(newData);
    });
  });

  //add event listener to serach button
  filterByPriceButtons.forEach((filterBtn)=>{
    filterBtn.addEventListener('click', async (e)=>{
      const filterBy = 'Prix';
      const filterValue = parseFloat(e.currentTarget.previousElementSibling.value.trim());
      const compareSymbole = e.currentTarget.dataset.compare;
      const newData = await filterModels(1, filterBy, filterValue, compareSymbole);
      displayModelsByBrand(newData);
    })
  })
  // search specific model
  searchBarModel.addEventListener('input', async function(){
    const searchValue = this.value.trim().toLowerCase();
    if(searchValue.length > 0){
      const newData = await filterModels(1, 'NomModele', searchValue);
      displayModelsByBrand(newData);
    }else{
      const initialData = await filterModels();
      displayModelsByBrand(initialData);
    }
  })
  
  //show all models button
  showAllModelsBtn.addEventListener('click', ()=>{displayModelsByBrand(initialData)})
});
