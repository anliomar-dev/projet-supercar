import {HOST} from './utils.js'
document.addEventListener('DOMContentLoaded', ()=>{
  const viewModelsButtons = document.querySelectorAll('.view-modelsBtn')
  viewModelsButtons.forEach((btn)=>{
    btn.addEventListener('click', (e)=>{
      const marque_id = e.currentTarget.dataset.idMarque;
      window.location.href = `${HOST}/supercar/modeles.php?brand=${marque_id}`;
    })
  })
})