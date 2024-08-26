document.addEventListener('DOMContentLoaded', ()=>{
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
})