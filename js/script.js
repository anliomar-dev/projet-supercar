document.addEventListener('DOMContentLoaded', function () {
    const header = document.querySelector('header');
    const logoSupercar = document.getElementById('logo');
    const headerLinks = document.querySelectorAll('.header_link');
    const headerBtnSecondary = document.querySelector('.header_secondary');    
    document.addEventListener('scroll', function() {
        if (window.scrollY > 0) { 
            header.style.backgroundColor = '#fff'; // background color on scroll
            logoSupercar.src = '../medias/images/supercar_logo_noir.webp' // logo on scroll
            header.style.padding = '10px'; //padding of the header on scroll
            logoSupercar.style.height = '55px'; // size of the logo on scroll
            headerBtnSecondary.style.color = '#18191f'; // color of header secondary button on scroll
            
            //header secondary button on scroll(hover)
            headerBtnSecondary.onmouseover = function () {
                headerBtnSecondary.style.color = 'green';
            }

            headerBtnSecondary.onmouseout = function () {
                headerBtnSecondary.style.color = 'black';
            }
            // headr links color on scroll
            headerLinks.forEach(function(link){
                link.style.color = '#18191f';
            })
            
        } else {
            // initiales: not scroll
            header.style.backgroundColor = 'transparent';
            logoSupercar.src = '../medias/images/supercar_logo_blanc.webp';
            logoSupercar.style.height = '75px';
            header.style.padding = '30px';
            headerBtnSecondary.style.color = 'white';
            headerBtnSecondary.onmouseover = function () {
                headerBtnSecondary.style.color = 'green';
            }
            headerBtnSecondary.onmouseout = function () {
                headerBtnSecondary.style.color = 'white';
            }
            headerLinks.forEach(function(link){
                link.style.color = 'white';
            })
        }
    });
    headerLinks.forEach(function(link){
        link.onmouseover = () =>{
            link.classList.add('header_link-hover');
        }
    })
})