<?php
ob_start();
(isset($_SESSION) && $_SESSION['profil'] === 0 || isset($_SESSION) && $_SESSION['profil'] === 3)? header('location: index.php'):"";
require "include/content/head.php";
?>

    <title>Société</title>
</head>

<body>
    <nav class="top-bar navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
            <?php
                if (isset($_SESSION['profil'])):
                    if($_SESSION['profil'] == 1):
                    ?>
                        <div class="d-inline-flex p-2 bd-highlight">
                            <img src="media/croix_ambulances.jpg" alt="croix_ambulance" style="width: 75px; height: 75px;">
                            <p class="my-auto mx-3"><h1><?= $_SESSION['societe_nom'] ?></h1></p>
                        </div>
                    <?php
                    elseif($_SESSION['profil'] == 2):
                            echo "<h1>Bonjour vous êtes connecté en Super Admin</h1>";
                    endif;
                else:
                    echo "<h1>Vous n'êtes pas connecté<h1>";
                endif;
                ?>
            </a>
            <?php
            if (isset($_SESSION['profil'])) {
                require 'navbar/navbar.php';
                echo $btnToggle;
            }
            ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="top-bar-menu">
                <?php
                    // affichage des differentes catégories dans le top menu suivant les profils
                    if (isset($_SESSION['profil'])) {
                        require 'navbar/navbar.php';
                        if($_SESSION['profil']==2){
                            echo $linkTopSocAdmin;
                            echo $linkTopClient;
                            echo $linkTopRdv;
                            echo $linkTopTemplate;
                        }
                        if($_SESSION['profil']==1){
                            echo $linkTopClient;
                            echo $linkTopRdv;
                            echo $linkTopSoc;
                        }
                    }
                    if (!isset($_SESSION['profil'])) {
                        echo '<li class="nav-item mobile-profile display">
                                <a class="nav-link" aria-current="page" href="index.php">Connexion</a>
                            </li>';
                    } else {
                        echo '<li class="nav-item mobile-profile display">
                                <a class="nav-link" aria-current="page" href="index.php">Profil</a>
                            </li>';
                        echo '<li class="nav-item mobile-profile display">
                                <form action="include/deconnexion.php" method="post">
                                    <input type="submit" class="nav-link nav-link-btn" name="deconnexion" value="déconnexion"></input>
                                </form>
                            </li>';
                    }
                    ?>
                </ul>
            </div>
            <!-- Affichage des bouton de connexion ou de déconnexion suivant si l'on est logged ou non -->
            <div class="bouton-float-right d-flex flex-row ms-auto me-0 me-md-3 my-2 my-md-0">
                <?php 
                if (!isset($_SESSION['profil'])){
                    require 'navbar/navbar.php';
                    echo $btnConnexion;
                } else {
                    require 'navbar/navbar.php';
                    echo $btnProfil;
                }
                ?>
            </div>
        </nav>
        <div id="container">
            <div class="side-menu offcanvas offcanvas-start " data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header d-flex justify-content-end">
                    <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">
                        <i class="bi bi-arrow-bar-left" id="arrow-side-bar"></i>
                    </button>
                    </div>
                    <div class="offcanvas-body">
                            <?php
                            if (isset($_SESSION['profil'])) {
                                require 'navbar/navbar.php';
                                
                                if($_SESSION['profil']==2){
                                    echo $linkProfil;
                                    echo $linkSocAdmin;
                                    echo $linkClient;
                                    echo $linkRdv;
                                    echo $linkTemplate;
                                }
                                if($_SESSION['profil']==1){
                                    echo $linkProfil;
                                    echo $linkRdv;
                                    echo $linkClient;
                                    echo $linkSoc;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if(isset($_SESSION['logged'])):
                    ?><div class="main padding" id="main"><?php
                else:
                    ?><div class="main" id="main"><?php
                endif;
                if (isset($_SESSION['profil'])):
                    $societe = 0;
                    if (isset($_POST['societe'])) {
                        $societe = 0;
                    }
                    if (isset($_POST['modifSociete'])) {
                        $societe = 1;
                    }
                    if (isset($_POST['template'])) {
                        $societe = 2;
                    }
                    if (isset($_POST['oldSociete'])) {
                        $societe = 3;
                    }
                    if($societe == 0):
                        require 'societe/infoSociete.php';
                        if($_SESSION['profil'] == 1):
                            echo $navSocieteSoc;
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de <?=$_SESSION['societe_nom']?></h5>
                            <?php
                            require "societe/vueSociete.php";
                        elseif($_SESSION['profil'] == 2):
                            echo navSocieteAdmin($societe);
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil du super Admin </h5>
                            <?php
                            ?>
                                <div class="row">
                            <?php
                            foreach (allSocietes(1) as $datasociete) { 
                                require "societe/cardAllSociete.php";
                            }
                            ?>
                                </div>
                            <?php
                        endif;
                    elseif($societe == 1):
                        require 'societe/infoSociete.php';
                        if ($_SESSION['profil'] == 2):
                            echo navSocieteAdmin($societe);
                            require "societe/onesoc.php";
                        else:
                            header('location: index.php');
                        endif;
                    elseif($societe == 2):
                        require 'societe/infoSociete.php';
                        if ($_SESSION['profil'] == 2):
                            require "template/index.php";
                        else:
                            header('location: index.php');
                        endif;
                    elseif($societe == 3):
                        require 'societe/infoSociete.php';
                        echo navSocieteAdmin($societe);
                        ?>
                            <div class="card-body">
                            <h5 class="card-title">Bienvenue sur le profil du super Admin </h5>
                        <?php
                        ?>
                            <div class="row">
                        <?php
                        if(!empty(allSocietes(0))){
                            foreach (allSocietes(0) as $datasociete) { 
                                require "societe/cardAllSociete.php";
                            }
                        } else{
                            echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Il n\'y a pas de société désactivées</div>';
                        }
                        ?>
                            </div>
                        <?php
                    endif;
                endif;
                ?>
            </div>
        </div>
    </div>
<?php
require "include/content/footer.php";
?>