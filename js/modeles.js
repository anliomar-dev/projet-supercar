import { fetchModelsByBrand } from "./utils";
// Get the query string (everything after the '?')
const queryString = window.location.search;

// Create a URLSearchParams object from the query string
const urlParams = new URLSearchParams(queryString);

// Retrieve the value of the 'brand_id' parameter
const brandId = urlParams.get('brand');


document.addEventListener('DOMContentLoaded', async()=>{
  const sideBarSections = document.querySelectorAll('.brows-by-type, .filter, .sort, .search')
  const filterOptions = document.getElementById('filterOptions')
  const sideBar = document.querySelector('.sidbar');
  const toggleSideBar = document.querySelector('.toggle-side-bar');
  const closeSidebarButton = document.querySelector('.close-sidebar');
  const template = document.getElementById('template-model')

  filterOptions.addEventListener('change', ()=>{
    const selectedOption = filterOptions.value
    sideBarSections.forEach(section => section.style.display = 'none')
    const optionsToShow = document.querySelector(`.${selectedOption}`)
    optionsToShow.style.display = 'block'
  })

  toggleSideBar.addEventListener('click', ()=>{
    sideBar.classList.add('sidebar-opened')
  })

  closeSidebarButton.addEventListener('click', ()=>{
    sideBar.classList.remove('sidebar-opened')
  })
  async function displayModelsByBrand(page=1){
    let data = await fetchModelsByBrand(brandId, page)
    let models = data.models
    models.forEach((model)=>{
      const clone = template.content.cloneNode(true);
      clone.getElementById('model-name').textContent = model.NomModele;
      clone.getElementById('model-brand').textContent = model.NomMarque;
      clone.getElementById('model-year').textContent = model.Annee;
      clone.getElementById('model-price').textContent = model.Prix;
      clone.getElementById('model-engine').textContent = model.TypeMoteur;
      clone.querySelector('.brand-logo').src = `../medias/images/logos/${model.logo}`;
      clone.getElementById('image-model').src = `../medias/images/${model.NomMarque}/${model.images[0].Nom}`;  
      document.querySelector('.models-container').appendChild(clone);
    })
  }
  displayModelsByBrand()
})