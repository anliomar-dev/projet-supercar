
document.addEventListener('DOMContentLoaded', ()=>{
  const navBar = document.querySelector('.dashboard-header');
  const openSidebarButton = document.querySelector('.toggle-sidebar');
  const sidebar = document.querySelector('.sidebar');
  const closeSidebarButton = document.querySelector('.close-sidebar');
  const xMarqueSidebar = document.querySelector('.x-mark-sidebar');

  openSidebarButton.addEventListener('click', (e)=>{
    e.currentTarget.style.display = 'none';
    closeSidebarButton.style.display = 'block'
  })
  const closeSidebarButtons = [closeSidebarButton, xMarqueSidebar]
  closeSidebarButtons.forEach(btn =>{
    btn.addEventListener('click', (e)=>{
    if(closeSidebarButton.style.display != 'none'){
      closeSidebarButton.style.display = 'none';
      openSidebarButton.style.display = 'block'
    }
  }) 
  })

  window.addEventListener('resize', function() {
    if(window.innerWidth < 1200){
      openSidebarButton.style.display = 'block';
      closeSidebarButton.style.display = 'none'
    }else{
      openSidebarButton.style.display = 'none';
      closeSidebarButton.style.display = 'none'
    }
  })
})