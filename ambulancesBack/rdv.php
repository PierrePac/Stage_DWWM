<?php
ob_start();
(isset($_SESSION['profil']))? header('location: index.php'):"";
require "include/content/head.php";
require 'profile/profile.php';
?>

    <title>Rendez-Vous</title>
</head>

<body>
    <nav class="top-bar navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <?php
                if (isset($_SESSION['profil'])):
                    if($_SESSION['profil'] == 0):
                        if(infoSoc($_SESSION['fk_societe'])):
                            $dataSoc = infoSoc($_SESSION['fk_societe']);
                            $dataSocNom = str_replace(" ","",$dataSoc['societe_nom']);
                            echo "<span class='greetings d-flex flex-row bd-highlight mb-3'><img src=../".$dataSocNom."/media/".$dataSoc['logo']." alt='Logo' style='width:60px; height:60px'><h1 class='ms-3 mt-1'>".$dataSoc['societe_nom']. "</h1></span>";
                        endif;
                    elseif($_SESSION['profil'] == 1):
                        ?>
                            <div class="d-inline-flex p-2 bd-highlight">
                                <img src="media/croix_ambulances.jpg" alt="croix_ambulance" style="width: 75px; height: 75px;">
                                <p class="my-auto mx-3"><h1><?= $_SESSION['societe_nom'] ?></h1></p>
                            </div>
                        <?php
                    elseif($_SESSION['profil'] == 2):
                        echo "<h1>Bonjour vous êtes connecté en Super Admin</h1>";
                    elseif($_SESSION['profil'] == 4):
                        echo "<h1>Bonjour vous êtes connecté en Régule itinérante</h1>";
                    endif;
                else:
                    echo "<h1>Vous n'êtes pas connecté</h1>";
                endif;
                ?>
            </a>
            <?php
            if (isset($_SESSION['profil'])){
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
                        if($_SESSION['profil'] == 0){
                            echo $linkTopRdv;
                            echo $linkTopJob;
                        } elseif($_SESSION['profil'] == 1){
                            echo $linkTopRdv;
                            echo $linkTopClient;
                            echo $linkTopSoc;
                        } elseif($_SESSION['profil'] == 2){
                            echo $linkTopSocAdmin;
                            echo $linkTopClient;
                            echo $linkTopRdv;
                            echo $linkTopTemplate;
                        } elseif($_SESSION['profil'] == 4){
                            echo $linkTopClient;
                            echo $linkTopRdv;
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
                    if(infoSoc($_SESSION['id_societe'])):
                        $dataSoc = infoSoc($_SESSION['id_societe']);
                        $dataSocNom = str_replace(" ","",$dataSoc['societe_nom']);
                        ?>
                        <div class='profil d-flex flex-wrap desktop-profil'>
                            <a class='btn btn-primary me-3 d-flex flex-row mx-2 my-2' href='../<?=$dataSocNom?>/index.php'>
                            <em class='bi bi-house me-3'></em>
                            <h5 class="mt-1">Accueil</h5></a>
                        </div>
                        <div class='profil d-flex flex-wrap desktop-profil'>
                            <a class='btn btn-primary me-3 d-flex flex-row mx-2 my-2' href='tel:+330 <?=$dataSoc['societe_tel']?>'>
                            <em class='bi bi-telephone me-3'></em>
                            <h5 class="mt-1">0<?=$dataSoc['societe_tel']?></h5></a>
                        </div>
                        <?php
                    endif;
                    echo $btnConnexion;
                } else {
                    require 'navbar/navbar.php';
                    if($_SESSION['profil'] == 0 && infoSoc($_SESSION['fk_societe'])):
                        $dataSoc = infoSoc($_SESSION['fk_societe']);
                        $dataSocNom = str_replace(" ","",$dataSoc['societe_nom']);
                        ?>
                        <div class='profil d-flex flex-wrap desktop-profil'>
                            <a class='btn btn-primary me-3 d-flex flex-row mx-2 my-2' href='../<?=$dataSocNom?>/index.php'>
                            <em class='bi bi-house me-3'></em>
                            <h5 class="mt-1">Accueil</h5></a>
                        </div>
                        <div class='profil d-flex flex-wrap desktop-profil'>
                            <a class='btn btn-primary me-3 d-flex flex-row mx-2 my-2' href='tel:+330 <?=$dataSoc['societe_tel']?>'>
                            <em class='bi bi-telephone me-3'></em>
                            <h5 class="mt-1">0<?=$dataSoc['societe_tel']?></h5></a>
                        </div>
                        <?php
                    endif;
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
                                if($_SESSION['profil'] == 0){
                                    echo $linkProfil;
                                    echo $linkRdv;
                                    echo $linkJob;
                                } elseif($_SESSION['profil'] == 1){
                                    echo $linkProfil;
                                    echo $linkRdv;
                                    echo $linkClient;
                                    echo $linkSoc;
                                } elseif($_SESSION['profil'] == 2){
                                    echo $linkProfil;
                                    echo $linkSocAdmin;
                                    echo $linkClient;
                                    echo $linkRdv;
                                    echo $linkTemplate;
                                } elseif($_SESSION['profil'] == 4){
                                    echo $linkProfil;
                                    echo $linkClient;
                                    echo $linkRdv;
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
                if(isset($_GET['message']) && $_GET['message'] == 'success'){
                    echo'<div id="alert" class="alert alert-danger w-50 mx-auto" role="alert">Message envoyé avec succés</div>';
                }
                if (isset($_SESSION['profil'])):
                    (isset($fkSociete) == NULL) ? $fkSociete = '' : "";
                    (isset($_POST['triRdv'])) ? $fkSociete = 'AND ambu_rdv.fk_societe = '.$_POST['fk_societe'] : $fkSociete = '';
                    $rdv = 0;
                    if(isset($_POST['triOldRdv'])){
                        $fkSociete = 'AND ambu_rdv.fk_societe = '.$_POST['fk_societe'];
                        $rdv = 1;
                    } else{
                        $fkSociete = '';
                    }
                    if (isset($_POST['vueRdv'])){
                        $rdv = 0;
                    }
                    if (isset($_POST['historiqueRdv'])){
                        $rdv = 1;
                    }
                    if (isset($_POST['traitementRdv'])){
                        $rdv = 2;
                    }
                    if($rdv == 0):
                        require 'rdv/infoRdv.php';
                        if($_SESSION['profil'] == 0):
                            navRdvClient($rdv)
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de <?= $_SESSION['prenom']. ' ' .$_SESSION['nom']?></h5>
                            <?php
                            if(isset($_GET['message']) && $_GET['message'] == 'success'){
                                echo'<div id="alert" class="alert alert-success w-50 mx-auto" role="alert">Message envoyé avec succés</div>';
                            }
                            require 'rdv/prendreRdv.php';
                        elseif($_SESSION['profil'] == 1):
                            navRdvAdmin($rdv)
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de <?= $_SESSION['societe_nom']?></h5>                                    <div class="row">
                            <?php
                            if(allSocieteRdv($_SESSION['id_societe'], 0)){
                                foreach(allSocieteRdv($_SESSION['id_societe'], 0) as $dataRdv){
                                    require 'rdv/cardRdvClients.php';
                                }
                            }else{
                                echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Vous n\'avez aucun rendez-vous en attente</div>';

                            }
                            ?>
                                </div>
                            <?php
                        elseif($_SESSION['profil'] == 2 || $_SESSION['profil'] == 4):
                            navRdvAdmin($rdv)
                            ?>
                                <div class="card-body">
                                <?php if($_SESSION['profil'] == 2): ?>
                                        <h5 class="card-title">Bienvenue sur le profil du super Admin </h5>
                                        <?php else: ?>
                                        <h5 class="card-title">Bienvenue sur le profil de la régule itinérante </h5>
                                        <?php endif; ?>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Filtrer par société
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <form action="" method="post">
                                                    <input type="submit" class="nav-link active w-100" name="triClient" value="Toutes les sociétés"></input>
                                                </form>
                                            </li>
                                            <li>
                                                <?php foreach(socName(0) as $socName): ?>
                                                <form action="" method="post">
                                                    <input type="submit" class="nav-link active w-100" name="tridRdv" value="<?= $socName['societe_nom'] ?>"></input>
                                                    <input type="hidden" name="fk_societe" value="<?= $socName['fk_societe'] ?>"></input>
                                                </form>
                                                <?php endforeach; ?>
                                            </li>
                                        </ul>
                                    </div>
                                <div class="row">     
                            <?php
                            if(allAdminRdv($fkSociete, 0)){
                                foreach(allAdminRdv($fkSociete, 0) as $dataRdv){
                                    require 'rdv/cardRdvClients.php';
                                }
                            }else{
                                echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Vous n\'avez aucun rendez-vous en attente</div>';
                            }
                            ?>
                                </div>
                            <?php
                        endif;
                    elseif($rdv == 1):
                        require 'rdv/infoRdv.php';
                        if($_SESSION['profil'] == 0):
                            navRdvClient($rdv)
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de <?= $_SESSION['prenom']. ' ' .$_SESSION['nom']?></h5>
                                <div class="row">
                            <?php
                            if(!empty(allClientRdv($_SESSION['user_id'], $_SESSION['fk_societe'], 1))){
                                foreach(allClientRdv($_SESSION['user_id'], $_SESSION['fk_societe'], 1) as $dataRdv){
                                    require 'rdv/cardRdvClients.php';
                                }
                            } else{
                                echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Vous n\'avez aucun hitorique de rendez-vous</div>';
                            }
                            ?>
                                </div>
                            <?php
                        elseif($_SESSION['profil'] == 1):
                            navRdvAdmin($rdv)
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de <?= $_SESSION['societe_nom']?></h5>
                                <div class="row">
                            <?php
                            if(!empty(allSocieteRdv($_SESSION['id_societe'], 1))){
                                foreach(allSocieteRdv($_SESSION['id_societe'], 1) as $dataRdv){
                                    require 'rdv/cardRdvClients.php';
                                }
                            } else{
                                echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Vous n\'avez aucun rendez-vous en traité</div>';
                            }
                            ?>
                                </div>
                            <?php
                        elseif($_SESSION['profil'] == 2 || $_SESSION['profil'] == 4):
                            navRdvAdmin($rdv)
                            ?>
                                <div class="card-body">
                                <?php if($_SESSION['profil'] == 2): ?>
                                        <h5 class="card-title">Bienvenue sur le profil du super Admin </h5>
                                        <?php else: ?>
                                        <h5 class="card-title">Bienvenue sur le profil de la régule itinérante </h5>
                                        <?php endif; ?>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Filtrer par société
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <form action="" method="post">
                                                    <input type="submit" class="nav-link active w-100" name="triClient" value="Toutes les sociétés"></input>
                                                </form>
                                            </li>
                                            <li>
                                                <?php foreach(socName(1) as $socName): ?>
                                                <form action="" method="post">
                                                    <input type="submit" class="nav-link active w-100" name="triOldRdv" value="<?= $socName['societe_nom'] ?>"></input>
                                                    <input type="hidden" name="fk_societe" value="<?= $socName['fk_societe'] ?>"></input>
                                                </form>
                                                <?php endforeach; ?>
                                            </li>
                                        </ul>
                                    </div>
                                <div class="row">
                            <?php
                            if(allAdminRdv($fkSociete, 1)){
                                foreach(allAdminRdv($fkSociete, 1) as $dataRdv){
                                    require 'rdv/cardRdvClients.php';
                                }
                            }else{
                                echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Vous n\'avez aucun rendez-vous en traité</div>';
                            }
                            ?>
                                </div>
                            <?php
                        endif;
                    elseif($rdv == 2):
                        require 'rdv/infoRdv.php';
                        if($_SESSION['profil'] == 0):
                            navRdvClient($rdv)
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de <?= $_SESSION['prenom']. ' ' .$_SESSION['nom']?></h5>
                                <div class="row">
                            <?php
                            if(!empty(allClientRdv($_SESSION['user_id'], $_SESSION['fk_societe'], 0))){
                                foreach(allClientRdv($_SESSION['user_id'], $_SESSION['fk_societe'], 0) as $dataRdv){
                                    require 'rdv/cardRdvClients.php';
                                }
                            }else{
                                echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Vous n\'avez aucun rendez-vous en traitement</div>';
                            }
                            ?>
                                </div>
                            <?php
                        endif;
                    endif;
                endif;
                ?>
            </div>
        </div>
    </div>
<?php
require "include/content/footer.php";
?>