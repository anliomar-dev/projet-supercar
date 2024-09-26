import { sortData, toggleAndSortDataBtns, fetchData } from "./utils";
import { resetForm } from "/super-car/js/utils";

// current page
localStorage.setItem("essaisCurrentPage", 1);
function isNumeric(value) {
  return !isNaN(value) && !isNaN(parseFloat(value));
}
function endPoint(essai, page = 1) {
  if (isNumeric(essai)) {
    return `http://localhost/Super-car/admin/api/essais?essai=${essai}`;
  } else if (essai === "all") {
    return `http://localhost/Super-car/admin/api/essais?essai=all&page=${page}`;
  } else {
    throw new Error('Invalid value provided');
  }
}
document.addEventListener('DOMContentLoaded', async ()=>{
  const essaisContainer = document.querySelector('.essais-container');
  const template = document.getElementById("template-essai");
  const allSections = document.querySelectorAll('section');
  const showSectionClickables = document.querySelectorAll('.show-section')
  const sortButtons = document.querySelectorAll('.sortBtn');
  const theadColumns = document.querySelectorAll('.th-col')
  const checkAllEssais = document.querySelector('.check-all');
  let checkEssai = [];
  
  toggleAndSortDataBtns(theadColumns, sortButtons)
  
  // Function to toggle section display
  function toggleSection(sectionClass) {
    allSections.forEach(section => section.classList.add('d-none')); // Hide all sections
    document.querySelector(`.${sectionClass}`).classList.remove('d-none'); // Show the desired section
  }
  
  async function displayEssais(data, sortBy, order) {
    essaisContainer.innerHTML = '';
    const essais = data.data;
    const sortedEssais = sortData(essais, sortBy, order);
    
    sortedEssais.forEach(essai => {
      const clone = template.content.cloneNode(true);
      
      const checkBoxEssai = clone.querySelector('.checkbox-essai');

      // Listener for each user checkbox
      checkBoxEssai.addEventListener('change', (e) => {
        if (!e.currentTarget.checked) {
          checkAllEssais.checked = false; // uncheck checkAllUser if one checkbox is unchecked
        }
      });
      
      const date = clone.querySelector('.date'); // Correctly target from the clone
      date.textContent = essai.DateEssai
      
      const heure = clone.querySelector('.heure'); // Correctly target from the clone
      heure.textContent = essai.Heure;
      
      const status = clone.querySelector('.status'); // Correctly target from the clone
      status.textContent = essai.status;
      
      [date, heure, status].forEach(el=>el.dataset.id = essai.IdEssai)
      const editButton = clone.querySelector('.edit-button'); // Correctly target from the clone
      const deleteButton = clone.querySelector('.delete-button'); // Correctly target from the clone
      [editButton, deleteButton].forEach(btn => btn.dataset.id = essai.IdEssai);
  
      essaisContainer.appendChild(clone);

      [date, heure, status, editButton].forEach((btn)=>{
        btn.addEventListener('click', async(e) => {
          const sectionToShowClass = e.currentTarget.dataset.section;
          toggleSection(sectionToShowClass);

          const brandId = parseInt(e.currentTarget.dataset.id);
          const brand = await fetchData(endPoint(brandId));
          Object.keys(brand).forEach(key => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input) input.value = brand[key];
          }); 
        })
      })
    });
    checkEssai = document.querySelectorAll('.checkbox-essai');
  }
  const essais = await fetchData(endPoint("all"))
  displayEssais(essais, 'Date', 'asc')

  checkAllEssais.addEventListener('change', (e) => {
    const isChecked = e.currentTarget.checked;
    checkEvent.forEach(checkbox => {
      checkbox.checked = isChecked;
    });
  });


  // dynamic pagination
  const paginationContainer = document.querySelector(".pagination");
  async function pagination(pagination) {
    const data = await fetchData(endPoint("all"));
    const events = data.data;
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

      prevBtn.addEventListener('click', async(e)=>{
        e.preventDefault();
        const currentPage = parseInt(localStorage.getItem('essaisCurrentPage'));
        if(currentPage > 1){
          const prevPage = currentPage - 1;
          localStorage.setItem('essaisCurrentPage', prevPage);
          const events = await fetchData(endPoint("all", prevPage))
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          const numPage = document.getElementById(`${prevPage}`)
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          displayEssais(events, 'DateDebut', 'asc')
          checkAllEssais.checked = false;
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
          localStorage.setItem("essaisCurrentPage", e.currentTarget.textContent);
          const currentPage = parseInt(localStorage.getItem("essaisCurrentPage"));
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          const events = await fetchData(endPoint("all", currentPage))
          displayEssais(events, 'DateDebut', 'asc');
          checkAllEssais.checked = false;
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
        const currentPage = parseInt(localStorage.getItem('essaisCurrentPage'));
        if(currentPage < totalPages){
          const NextPage = currentPage + 1;
          localStorage.setItem('essaisCurrentPage', NextPage);
          const events = await fetchData(endPoint("all", NextPage));
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          const numPage = document.getElementById(`${NextPage}`)
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          displayEssais(events, 'DateDebut', 'asc')
          checkAllEssais.checked = false;
        }
      })
      
    }
  }
  checkAllEssais.addEventListener('change', (e)=>{
    if(e.currentTarget.checked){
      checkEssai.forEach(checkbox => {
        checkbox.checked = true;
      })
    }else{
      checkEssai.forEach(checkbox => {
        checkbox.checked = false;
      })
    }
  })
  // display paginations buttons
  pagination(paginationContainer);
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

