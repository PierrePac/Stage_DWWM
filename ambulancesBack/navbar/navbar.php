<?php
if(!isset($_SESSION)){ 
    session_start(); 
} 

// ********  TOP NAV-BAR **********

//bouton toggle de la top nav-bar
$btnToggle =    '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="btn display" type="button" id="burger-side-bar" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    <span class="navbar-toggler-icon"></span>
                </button>';

//bouton connexion de la top nav-bar
$btnConnexion = '<div class="connexion desktop-profil">
<a class="btn btn-primary me-3 d-flex flex-row mx-2 my-2" href="index.php">
    <div class="sb-nav-link-icon">
        <i class="bi bi-box-arrow-in-right me-3"></i>
    </div>
    Connexion
</a>
</div>';

//bouton profil et deconnexion de la top nav-bar
$btnProfil = '
            <div class="profil d-flex flex-wrap desktop-profil">
                <a class="btn btn-primary me-3 d-flex flex-row mx-2 my-2" href="index.php">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-address-card me-3"></i>
                    </div>
                    Mon profil
                </a>
                <form action="include/deconnexion.php" method="post">
                    <input type="submit" class="btn btn-primary me-3 mx-2 my-2" name="deconnexion" value="déconnexion"></input>
                </form>
            </div>';


// ********  SIDE-BAR **********

//lien top société
$linkTopProfil ='<li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Profil</a>
                  </li>'; 
//lien société
$linkProfil = '<div class="sb-sidenav-menu-heading mx-5 mt-3 text-uppercase"></div>
<a class="nav-link  link-side-bar icone" href="index.php">
    <div class="sb-nav-link-icon">
        <i class="bi bi-file-person-fill me-3 icone"></i>
    </div>
    Profil
</a>';

//lien top société
$linkTopSocAdmin ='<li class="nav-item">
                    <a class="nav-link" aria-current="page" href="societe.php">Les sociétés</a>
                  </li>'; 
//lien société
$linkSocAdmin = '<div class="sb-sidenav-menu-heading mx-5 mt-3 text-uppercase"></div>
<a class="nav-link  link-side-bar icone" href="societe.php">
    <div class="sb-nav-link-icon">
        <i class="fa-solid fa-truck-medical me-3 icone"></i>
    </div>
    Les Sociétés
</a>';

//lien top société
$linkTopSoc ='<li class="nav-item">
                    <a class="nav-link" aria-current="page" href="societe.php">La sociétés</a>
                  </li>'; 
//lien société
$linkSoc = '<div class="sb-sidenav-menu-heading mx-5 mt-3 text-uppercase"></div>
<a class="nav-link  link-side-bar icone" href="societe.php">
    <div class="sb-nav-link-icon">
        <i class="fa-solid fa-truck-medical me-3 icone"></i>
    </div>
    La Sociétés
</a>';

//lien top client
$linkTopClient ='<li class="nav-item">
<a class="nav-link" aria-current="page" href="clients.php">Les clients</a>
</li>';
//lien client
$linkClient = '<div class="sb-sidenav-menu-heading mx-5 mt-3 text-uppercase"></div>
<a class="nav-link link-side-bar icone" href="clients.php">
    <div class="sb-nav-link-icon">
        <i class="fa-solid fa-hospital-user me-3 icone"></i>
    </div>
    Les clients
</a>';

//lien top Rdv
$linkTopRdv ='<li class="nav-item">
<a class="nav-link" aria-current="page" href="rdv.php">Les rendez-vous</a>
</li>';
//lien rdv
$linkRdv = '<div class="sb-sidenav-menu-heading mx-5 mt-3 text-uppercase"></div>
<a class="nav-link link-side-bar icone" href="rdv.php">
    <div class="sb-nav-link-icon">
        <i class="fa-solid fa-calendar-check me-3 icone"></i>
    </div>
    Les rendez-vous
</a>';

//lien top Emploi
$linkTopJob ='<li class="nav-item">
<a class="nav-link" aria-current="page" href="emploi.php">Les emplois</a>
</li>';
//Lien Emploi
$linkJob ='<div class="sb-sidenav-menu-heading mx-5 mt-3 text-uppercase"></div>
<a class="nav-link link-side-bar icone" href="emploi.php">
    <div class="sb-nav-link-icon">
        <i class="fa-solid fa-truck-medical me-3 icone"></i>
    </div>
    Les emplois
</a>';

//lien top candidature spontané
$linkTopSpontaneJob ='<li class="nav-item">
<a class="nav-link" aria-current="page" href="emploi.php">Postuler</a>
</li>';
//Lien candidature spontané
$linkSpontaneJob = '<div class="sb-sidenav-menu-heading mx-5 mt-3 text-uppercase"></div>
<a class="nav-link link-side-bar icone" href="emploi.php">
    <div class="sb-nav-link-icon">
        <i class="fa-solid fa-truck-medical me-3 icone"></i>
    </div>
    Postuler
</a>';

//lien top Template
$linkTopTemplate ='<li class="nav-item">
<a class="nav-link" aria-current="page" href="template/templates.php">Les Templates</a>
</li>';
//Lien Template
$linkTemplate = '<div class="sb-sidenav-menu-heading mx-5 mt-3 text-uppercase"></div>
<a class="nav-link link-side-bar icone" href="template/templates.php">
    <div class="sb-nav-link-icon">
        <i class="fa-solid fa-truck-medical me-3 icone"></i>
    </div>
    Template
</a>';