
export async function fetchUsers(page=1){
  try{
    const response = await fetch(`http://localhost/Super-car/admin/api/utilisateurs?user=all&page=${page}`)
    if(!response.ok){
      throw new Error(response.statusText)
    }
    const users = await response.json()
    console.log(users)
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
function sortData(data, sortBy, order) {
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
