document.addEventListener('DOMContentLoaded', ()=>{
  const sideBarSections = document.querySelectorAll('.brows-by-type, .filter, .sort')
  const filterOptions = document.getElementById('filterOptions')

  filterOptions.addEventListener('change', ()=>{
    const selectedOption = filterOptions.value
    sideBarSections.forEach(section => section.style.display = 'none')
    const optionsToShow = document.querySelector(`.${selectedOption}`)
    optionsToShow.style.display = 'block'
  })
})