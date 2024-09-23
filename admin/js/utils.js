export async function fetchUsers(page=1){
  try{
    const response = await fetch(`http://localhost/Super-car/admin/api/utilisateurs?user=all&page=${page}`)
    if(!response.ok){
      throw new Error(response.statusText)
    }
    const users = await response.json()
    return users
  }catch(e){
    console.log(e)
  }
}


export async function fetchData(endPoint){
  try{
    const response = await fetch(`${endPoint}`)
    if(!response.ok){
      throw new Error(response.statusText)
    }
    const data = await response.json()
    return data
  }catch(e){
    console.log(e)
  }
}

/**
 * Sorts an array of objects by a specified key in ascending or descending order.
 * 
 * @param {Array} data - Array of objects to be sorted.
 * @param {string} sortBy - The key by which to sort the objects (e.g., 'first_name', 'last_name') depending on the data we sort.
 * @param {string} order - Sorting order: 'asc' for ascending, 'desc' for descending.
 * @returns {Array} - The sorted array.
 */
export function sortData(data, sortBy, order) {
  return data.sort((a, b) => {
    if (a[sortBy] < b[sortBy]) {
      return order === 'asc' ? -1 : 1;
    }
    if (a[sortBy] > b[sortBy]) {
      return order === 'asc' ? 1 : -1;
    }
    return 0;
  });
}

export async function getUser(userId){
  try{
    const response = await fetch(`http://localhost/Super-car/admin/api/utilisateurs?user=${userId}`)
    if(!response.ok){
      throw new Error(response.statusText)
    }
    const user = await response.json()
    return user
  }catch(e){
    console.log(e)
  }
}


export async function toggleAndSortDataBtns(theadColumns, sortButtons){
  theadColumns.forEach((col) => {
    col.addEventListener('click', (e) => {
      // Récupérer les boutons de tri de la colonne cliquée
      const buttons = col.parentElement.querySelectorAll('.sortBtn');
      
      // Vérifier si un bouton est déjà visible
      const visibleButton = Array.from(buttons).find(btn => !btn.classList.contains('d-none'));

      if (visibleButton) {
        // if there is any visible button: then hide it
        visibleButton.classList.add('d-none');
      } else {
        // hide all sort button to ensure only one button is display
        sortButtons.forEach((btn) => {
          btn.classList.add('d-none');
        });

        // display first sort button for the first click of the column
        buttons[0].classList.remove('d-none');
      }
    });

    // handdle display and hide sort buttons
    col.parentElement.querySelectorAll('.sortBtn').forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();

        // hide clicked button
        btn.classList.add('d-none');

        // display other sort button
        const otherBtn = btn.nextElementSibling || btn.previousElementSibling;
        otherBtn.classList.remove('d-none');
      });
    });
  });
}

export function resetFormInputs(form){
  form.querySelectorAll('input').forEach((input) => {
    input.value = '';
    });
}

