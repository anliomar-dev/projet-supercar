document.addEventListener('DOMContentLoaded', ()=>{
    const moreDetailsBtn = document.querySelector('.more-details-btn');
    const descriptionContainer = document.querySelector('.description-container')
    moreDetailsBtn.addEventListener("click", function(){
        descriptionContainer.classList.toggle('d-none')
        if(descriptionContainer.classList.contains('d-none')){
            moreDetailsBtn.textContent = "plus de details ..."
        }else{
            moreDetailsBtn.textContent = "masquer les details"
        }
    })
})