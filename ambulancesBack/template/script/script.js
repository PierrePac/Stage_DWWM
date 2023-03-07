let next = document.getElementById('next');
let container = document.getElementById('theme');
let btn = document.querySelector('.btn-switch');
let offCanvaSideMenu = document.getElementById('offcanvasScrolling');
let topBarMenu = document.getElementById('top-bar-menu');
let burgerSideBar = document.getElementById('burger-side-bar');
let arrowSideBar = document.getElementById('arrow-side-bar');
let main = document.getElementById('main');
let mobileProfil = document.querySelectorAll('.mobile-profile');
let desktopProfil = document.querySelectorAll('.desktop-profil');

next.addEventListener('click', _e=>{
    if(container.classList.contains('theme-1')){
        container.classList.remove('theme-1');
        container.classList.add('theme-2');
            
    } else if(container.classList.contains('theme-2')){
        container.classList.add('theme-3');
        container.classList.remove('theme-2');
            
    } else {
        location.reload();
        container.classList.remove('theme-3');
    }
})
    
if(btn){
    let box = document.getElementById('box');
    btn.addEventListener('click', _e=>{
        box.style.transitionDuration = "1.5s";
        box.classList.toggle('switch');
    })
}
    
if(offCanvaSideMenu){
    offCanvaSideMenu.classList.remove('show');
}
if(main){
    main.classList.remove('main');
}
if(mobileProfil){
    mobileProfil.forEach(element => {
        element.classList.remove('display');
    });
}
if(desktopProfil){
    desktopProfil.forEach(element => {
        element.classList.add('display');
    });
}
        

if(arrowSideBar){
    arrowSideBar.addEventListener('click', _e =>{
        topBarMenu.classList.remove('display');
        burgerSideBar.classList.remove('display');
        main.classList.remove('main');
    })
}
if(burgerSideBar){
    burgerSideBar.addEventListener('click', _e =>{
        topBarMenu.classList.add('display');
        burgerSideBar.classList.add('display');
        main.classList.add('main');
    })
}
