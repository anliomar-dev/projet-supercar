function sideBarLinks(element, colorSmallWidth, colorLargeWidth){
    if(window.innerWidth <= 1044){
        element.forEach(function(link){
            link.style.color = colorSmallWidth;
        })
    }else{
        element.forEach(function(link){
            link.style.color = colorLargeWidth;
        })
    }
};


document.addEventListener('DOMContentLoaded', () =>{
    const header = document.querySelector('.header');
    const logoSupercar = document.getElementById('logo');
    const headerLinks = document.querySelectorAll('.header_link');
    const headerBtnSecondary = document.querySelector('.header_secondary');
    const menuBurger = document.querySelector('.toggle-button').querySelector('svg');
    const headerBlock = document.querySelector('.header_links-buttons');
    const closeMenuButton = document.querySelector('.menu-close-button');
    const slogan = document.querySelector('.slogan');
    sideBarLinks(headerLinks, '#18191f', 'white');
    document.addEventListener('scroll', function() {
        if (window.scrollY > 0) { 
            header.classList.add('header-onScroll');
            logoSupercar.src = '../medias/images/supercar_logo_noir.webp'; // logo on scroll
            logoSupercar.style.height = '55px'; // size of the logo on scroll
            headerBtnSecondary.classList.add('secondary-onScroll');
            // headr links color on scroll
            headerLinks.forEach(function(link){
                link.style.color = '#18191f';
            })
            slogan.classList.add('sloganOnScroll');
        } else {
            // initiales: not scroll
            header.classList.remove('header-onScroll');
            slogan.classList.remove('sloganOnScroll');
            headerBtnSecondary.classList.remove('secondary-onScroll');
            logoSupercar.src = '../medias/images/supercar_logo_blanc.webp';
            logoSupercar.style.height = '75px';
            sideBarLinks(headerLinks, '#18191f', 'white');
            
        }
    });
    
    headerLinks.forEach(function(link){
        link.onmouseover = () =>{
            link.classList.add('header_link-hover');
        }
    })
    menuBurger.addEventListener('click', ()=>{
        headerBlock.classList.add('header_links-buttons-open');
    })
    closeMenuButton.addEventListener('click', ()=>{
        headerBlock.classList.remove('header_links-buttons-open');
    })
});