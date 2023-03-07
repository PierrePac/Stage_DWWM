let sidebarToggle = document.getElementById('sidebarToggle');
let width = window.screen.width;
let btn = document.querySelector('.btn-switch');
let sideMenu = document.getElementById('side-menu');
let offCanvaSideMenu = document.getElementById('offcanvasScrolling');
let topBarMenu = document.getElementById('top-bar-menu');
let burgerSideBar = document.getElementById('burger-side-bar');
let arrowSideBar = document.getElementById('arrow-side-bar');
let main = document.getElementById('main');
let mobileProfil = document.querySelectorAll('.mobile-profile');
let desktopProfil = document.querySelectorAll('.desktop-profil');
let padding = document.querySelector('.padding');
let checkbox = document.querySelector('.checkbox');
let emploiFiltre = document.querySelectorAll('.emploi-filtre');

if(checkbox){
    checkbox.addEventListener('click', _e=>{
        let backCard = document.querySelector('.card-back');
        backCard.classList.toggle('display');
        console.log(backCard);
    })
}
if(btn){
    btn.addEventListener('click', _e=>{
        let box = document.getElementById('box');
        box.classList.toggle('switch');
        box.style.transitionDuration = "1.5s";
    })
};
// message de confirmation de mail
let Msgalert = document.getElementById('alert');
if(Msgalert){  
    function removeDiv(){
        Msgalert.remove()
    };
    window.addEventListener("load", _e=> {
        setTimeout(removeDiv, 3000);
    });
}


window.addEventListener("load", _e=> {
    if(width>1000){
        offCanvaSideMenu.style.visibility = "visible";
        offCanvaSideMenu.classList.add('show');
        topBarMenu.classList.add('display');
        padding.style.paddingLeft = "300px";
        emploiFiltre.forEach(element =>{
            element.style.width = "25%";
        })
    }
    if(width<1000){
        if(offCanvaSideMenu){
            offCanvaSideMenu.classList.remove('show');
        }
        main.classList.remove('main');
        
        mobileProfil.forEach(element => {
            element.classList.remove('display');
        });
        desktopProfil.forEach(element => {
            element.classList.add('display');
        });
        emploiFiltre.forEach(element =>{
            element.style.width = "100%";
        })
    }
});
if(arrowSideBar){
    arrowSideBar.addEventListener('click', _e =>{
        burgerSideBar.classList.remove('display');
        topBarMenu.classList.remove('display');
        main.classList.remove('main');
    });
}
if(burgerSideBar){
    burgerSideBar.addEventListener('click', _e =>{
        burgerSideBar.classList.add('display');
        topBarMenu.classList.add('display');
        main.classList.add('main');
    });
}

