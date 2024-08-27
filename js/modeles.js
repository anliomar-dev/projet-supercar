import { fetchModelsByBrand } from "./utils";

document.addEventListener('DOMContentLoaded', async()=>{
  const sideBarSections = document.querySelectorAll('.brows-by-type, .filter, .sort, .search')
  const filterOptions = document.getElementById('filterOptions')
  const sideBar = document.querySelector('.sidbar');
  const toggleSideBar = document.querySelector('.toggle-side-bar');
  const closeSidebarButton = document.querySelector('.close-sidebar');

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

  // Get the query string (everything after the '?')
  const queryString = window.location.search;

  // Create a URLSearchParams object from the query string
  const urlParams = new URLSearchParams(queryString);

  // Retrieve the value of the 'brand_id' parameter
  const brandId = urlParams.get('brand');
  const data = await fetchModelsByBrand(brandId)
  console.log(data.currentPage)
  console.log(data.totalPages)
  console.log(data.models)
  
})