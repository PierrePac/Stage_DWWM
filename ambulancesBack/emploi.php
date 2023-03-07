<?php
ob_start();
require "include/content/head.php";
require 'profile/profile.php';
?>

    <title>Emploi</title>
</head>

<body>
    <nav class="top-bar navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <?php
                // message d'entête dans le menu suivant les profils
                if (isset($_SESSION['profil']) && $_SESSION['profil'] == 3):
                    echo "<h1>Bonjour vous êtes connecté en tant que RH</h1>";
                else:
                    if(infoSoc($_SESSION['id_societe'])):
                        $dataSoc = infoSoc($_SESSION['id_societe']);
                        $dataSocNom = str_replace(" ","",$dataSoc['societe_nom']);
                        echo "<span class='greetings d-flex flex-row bd-highlight mb-3'><img src='media/croix_ambulances.jpg' alt='Logo' style='width:60px; height:60px'><h1 class='ms-3 mt-1'>".$dataSoc['societe_nom']. "</h1></span>";
                    endif;
                endif;
                ?>
            </a>
            <?php
            // affichage du bouton de déployment du side menu suivant les profils
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
                        if($_SESSION['profil'] == 3){
                            echo $linkTopJob;
                        } else{
                            echo $linkTopRdv;
                        }

                    } else {
                        require 'navbar/navbar.php';
                        echo $linkTopSpontaneJob;
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
        <?php if(isset($_SESSION) && isset($_SESSION['logged'])): ?>
        <div class="side-menu offcanvas offcanvas-start " data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header d-flex justify-content-end">
                    <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">
                        <i class="bi bi-arrow-bar-left" id="arrow-side-bar"></i>
                    </button>
                    </div>
                    <div class="offcanvas-body">
                            <?php
                            // affichage des differentes catégories dans le side menu suivant les profils
                            if (isset($_SESSION['profil'])) {
                                require 'navbar/navbar.php';
                                if($_SESSION['profil'] == 3){
                                    echo $linkProfil;
                                    echo $linkJob;
                                } else{
                                    echo $linkProfil;
                                    echo $linkRdv;
                                }

                            } else {
                                require 'navbar/navbar.php';
                                echo $linkSpontaneJob;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            endif;
            if(isset($_SESSION['logged'])):
                    ?><div class="main padding" id="main" style="width: 100%;"><?php
                else:
                    ?><div class="main" id="main" style="width: 100%;"><?php
                endif;
                if (isset($_GET['message'])){
                    switch ($_GET['message']){
                        case 'success':
                            echo'<div id="alert" class="alert alert-success w-50 mx-auto" role="alert">candidature envoyé avec succés</div>';
                            break;
                        case 'errorcaptcha':
                            echo'<div id="alert" class="alert alert-danger w-50 mx-auto" role="alert">Veuillez valider le Captcha</div>';
                            break;
                        case 'errorcv':
                            echo'<div id="alert" class="alert alert-danger w-50 mx-auto" role="alert">Format du cv incorrect</div>';
                            break;
                        case 'errortaille':
                            echo'<div id="alert" class="alert alert-danger w-50 mx-auto" role="alert">Les taille ficchiers doivent être nférieur à 3Mo</div>';
                            break;
                        case 'errormotivation':
                            echo'<div id="alert" class="alert alert-danger w-50 mx-auto" role="alert">Format de la lettre de motivation incorrect</div>';
                            break;
                    }

                }
                
                // vérification que l'user est bien connecté
                if (isset($_SESSION['profil']) && $_SESSION['profil'] == 3):
                    $emploi = 0;
                    require "emploi/infoEmploi.php";
                    (isset($fkSociete) == NULL) ? $fkSociete = '' : "";
                    (isset($idEmploi) == NULL) ? $idEmploi = '' : "";
                    // affichage de la page profil et modif profil
                    if (isset($_POST['vueEmploi'])) {
                        (isset($_POST['fk_societe'])) ? $fkSociete = 'AND ambu_utilisateur.fk_societe = '.$_POST['fk_societe'] : $fkSociete = '';
                        $emploi = 0;
                    }
                    if (isset($_POST['postulants'])) {
                        (isset($_POST['societe']) == '' || strlen($_POST['societe'])==0) ? $fkSociete = '' : $fkSociete = 'AND ambu_emploi.fk_societe = '.$_POST['societe'];
                        (isset($_POST['postulant']) == '' || strlen($_POST['postulant'])==0) ? $idEmploi = '' : $idEmploi = ' AND fk_emploi = '.$_POST['postulant'];
                        $emploi = 1;
                    }
                    (isset($_POST['PostulantTraite'])) ? $emploi = 1 : "";
                    (isset($_POST['formEmploi'])) ?$emploi = 2 :"";
                    (isset($_POST['modifOffre'])) ? $emploi = 3 :"";
                    (isset($_POST['oldEmploi'])) ? $emploi = 4 : "";
                    navrhEmploi($emploi);
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">Bienvenue sur le profil du RH</h5>
                    <?php
                    switch ($emploi) {
                        case 0:
                            if(isset($_SESSION['profil']) == 3){
                            ?>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Filtrer par société
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <form action="" method="post">
                                                <input type="submit" class="nav-link active w-100" name="vueEmploi" value="Toutes les sociétés"></input>
                                            </form>
                                        </li>
                                        <li>
                                            <?php foreach(socName() as $socName): ?>
                                            <form action="" method="post">
                                            <input type="submit" class="nav-link active w-100" name="vueEmploi" value="<?= $socName['societe_nom'] ?>"></input>
                                            <input type="hidden" name="fk_societe" value="<?= $socName['fk_societe'] ?>"></input>
                                            </form>
                                            <?php endforeach; ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="row">
                                    <?php
                                    if(!empty(allSocieteEmploi($fkSociete))){
                                        foreach (allSocieteEmploi($fkSociete) as $dataEmploi) {
                                            require "emploi/cardEmploi.php";
                                        }
                                    } else{
                                        echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Il n\'y a aucune offre d\'emploi</div>';     
                                    }
                                    ?>
                                </div>
                            <?php
                            }
                            break;
                        case 1:
                            ?>
                                <form action="" method="post">
                                    <div class="d-flex flex-wrap justify-content-center">
                                        <select class="form-select emploi-filtre mx-2 my-3" aria-label="Default select example" name="societe">
                                            <option selected value = "">Toutes les Sociétés</option>
                                            <?php foreach(socName() as $socName): ?>
                                            <option value="<?= $socName['fk_societe'] ?>"><?= $socName['societe_nom'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <select class="form-select emploi-filtre mx-2 my-3" aria-label="Default select example" name="postulant">
                                            <option selected value = "">Toutes les Offres</option>
                                            <?php foreach(allEmploi() as $emploi): ?>
                                                <option value="<?= $emploi['emploi_id'] ?>"><?= $emploi['nom_emploi'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="submit" class="btn btn-primary mx-2 my-3" value="Filtrer" name="postulants">
                                    </div>
                                </form>
                                <div class="row" style="width: 100%;">
                                    <?php
                                    if(!empty(allSocietePostulant($fkSociete, $idEmploi))){
                                        foreach (allSocietePostulant($fkSociete, $idEmploi) as $dataEmploi) {
                                            require "emploi/cardPostulant.php";
                                        }
                                    }else{
                                        echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Il n\'y a aucun Postulant</div>'; 
                                    }
                                    ?>
                                </div>
                            <?php
                            break;
                        case 2:
                            require "emploi/posterOffre.php";
                            break;
                        case 3:
                            require "emploi/modifOffre.php";
                            break;
                        case 4:
                            ?>
                                <div class="row" style="width:100%;">
                                    <?php
                                    if(!empty(oldSocieteEmploi())){
                                        foreach (oldSocieteEmploi() as $dataEmploi) {
                                            require "emploi/cardEmploi.php";
                                        }
                                    }else{
                                        echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Il n\'y a aucune ancienne offre</div>'; 
                                    }
                                    ?>
                                </div>
                            <?php
                            break;
                        default:
                        break;
                    }
                else:
                    require "emploi/infoEmploi.php";
                    $emploi = 0;
                    if (isset($_POST['vueEmploi'])) {
                        $emploi = 0;
                    }
                    if (isset($_POST['postuler'])) {
                        $emploi = 1;
                    }
                    if (isset($_POST['postulerSpontanne'])) {
                        $emploi = 2;
                    }
                    navPostulant($emploi);
                    if($emploi == 0):
                        ?>
                            <div class="row" style="width: 100%;">
                                <?php
                                (isset($_SESSION['profil']) && $_SESSION['profil'] == 0) ? $_SESSION['id_societe'] = $_SESSION['fk_societe'] : "";
                                if(!empty(oneSocieteEmploi($_SESSION['id_societe']))){
                                    foreach (oneSocieteEmploi($_SESSION['id_societe']) as $dataEmploi) {
                                        require "emploi/cardEmploi.php";
                                    }
                                } else {
                                    echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Aucune offre n\'est disponible pour le moment</div>';
                                }
                                ?>
                            </div>
                        <?php
                    elseif($emploi == 1):
                        $dataOffre = recuperationOffre($_POST);
                        require "emploi/candidater.php";
                    elseif($emploi == 2):
                        require "emploi/candidatureSpontanne.php";
                    endif;

                endif;
                ?>
            </div>
        </div>
    </div>
<?php
require "include/content/footer.php";
?>