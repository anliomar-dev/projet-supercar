async function fetchOptionModels(brandId){
  try{
    const response = await fetch(`http://localhost/super-car/api/options_modeles?brand_id=${brandId}`);
    if(!response.ok){
      throw new Error(response.statusText);
    }
    const data = await response.json();
    return data;
  }catch(e){
    console.error(e);
  }
}