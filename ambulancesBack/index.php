<?php
require "include/content/head.php";
if(!isset($_SESSION['profil'])):
    ?><title>authentification</title><?php
else:
    ?><title>Profil</title><?php
endif;
require 'profile/profile.php';
?>
</head>
<body>
    <nav class="top-bar navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
                <?php
                // message d'entête dans le menu suivant les profils
                if (isset($_SESSION['profil'])):
                    if($_SESSION['profil'] == 0):
                        if(infoSoc($_SESSION['fk_societe'])):
                            $dataSoc = infoSoc($_SESSION['fk_societe']);
                            $dataSocNom = str_replace(" ","",$dataSoc['societe_nom']);
                            echo '<span class="greetings d-flex flex-row bd-highlight mb-3"><img src="media/croix_ambulances.jpg" alt="Logo" style="width:60px; height:60px"><h1 class="ms-3 mt-1">'.$dataSoc["societe_nom"]. '</h1></span>';
                            endif;
                    elseif($_SESSION['profil'] == 1):
                        ?>
                            <div class="d-inline-flex p-2 bd-highlight">
                                <img src="media/croix_ambulances.jpg" alt="croix_ambulance" style="width: 75px; height: 75px;">
                                <p class="my-auto mx-3"><h1><?= $_SESSION['societe_nom'] ?></h1></p>
                            </div>
                        <?php
                    elseif($_SESSION['profil'] == 2):
                        echo "<span class='greetings'><h1>Bonjour vous êtes connecté en Super Admin</h1></span>";
                    elseif($_SESSION['profil'] == 3):
                            echo "<span class='greetings'><h1>Bonjour vous êtes connecté en tant que RH</h1></span>";
                    elseif($_SESSION['profil'] == 4):
                        echo "<span class='greetings'><h1>Bonjour vous êtes connecté en tant que Régule itinérante</h1></span>";
                    endif;
                else:
                    if(isset($_POST['connexion']) && infoSoc($_POST['connexion'])):
                        $dataSoc = infoSoc($_POST['connexion']);
                        $dataSocNom = str_replace(" ","",$dataSoc['societe_nom']);
                        echo "<span class='greetings d-flex flex-row bd-highlight mb-3'><img src=media/croix_ambulances.jpg alt='Logo' style='width:60px; height:60px'><h1 class='ms-3 mt-1'>".$dataSoc['societe_nom']. "</h1></span>";
                    elseif(isset($_SESSION['id_societe']) && infoSoc($_SESSION['id_societe'])):
                        $dataSoc = infoSoc($_SESSION['id_societe']);
                        $dataSocNom = str_replace(" ","",$dataSoc['societe_nom']);
                        echo "<span class='greetings d-flex flex-row bd-highlight mb-3'><img src=media/croix_ambulances.jpg alt='Logo' style='width:60px; height:60px'><h1 class='ms-3 mt-1'>".$dataSoc['societe_nom']. "</h1></span>";
                    elseif(isset($_POST['rdv']) && infoSoc($_POST['rdv'])):
                        $dataSoc = infoSoc($_POST['rdv']);
                        $dataSocNom = str_replace(" ","",$dataSoc['societe_nom']);
                        echo "<span class='greetings d-flex flex-row bd-highlight mb-3'><img src=media/croix_ambulances.jpg alt='Logo' style='width:60px; height:60px'><h1 class='ms-3 mt-1'>".$dataSoc['societe_nom']. "</h1></span>";
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
            <!-- Affichage des bouton de menu suivant le profil -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="top-bar-menu">
                    <?php
                    // affichage des differentes catégories dans le top menu suivant les profils
                    if (isset($_SESSION['profil'])) {
                        require 'navbar/navbar.php';
                        switch ($_SESSION['profil']) {
                            case 0:
                                echo $linkTopProfil;
                                echo $linkTopRdv;
                                echo $linkTopJob;
                                break;
                            case 1:
                                echo $linkTopProfil;
                                echo $linkTopRdv;
                                echo $linkTopClient;
                                echo $linkTopSoc;
                                break;
                            case 2:
                                echo $linkTopProfil;
                                echo $linkTopSocAdmin;
                                echo $linkTopClient;
                                echo $linkTopRdv;
                                echo $linkTopTemplate;
                                break;
                            case 3:
                                echo $linkTopProfil;
                                echo $linkTopJob;
                            case 4:
                                echo $linkTopProfil;
                                echo $linkTopClient;
                                echo $linkTopRdv;
                                break;
                            default:
                            break;
                        }
                    }
                    if (!isset($_SESSION['profil'])) {
                        echo '<li class="nav-item mobile-profile display">
                                <a class="nav-link" aria-current="page" href="index.php">Connexion</a>
                            </li>';
                    } else {
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
            <div class="bouton-float-right d-flex flex-row flex-wrap ms-auto me-0 me-md-3 my-2 my-md-0">
                <?php 
                if (isset($_SESSION['profil'])):
                    require 'navbar/navbar.php';
                    if($_SESSION['profil'] == 0 && infoSoc($_SESSION['fk_societe'])):
                        $dataSoc = infoSoc($_SESSION['fk_societe']);
                        $dataSocNom = str_replace(" ","",$dataSoc['societe_nom']);
                        ?>
                        <div class='profil d-flex flex-wrap desktop-profil'>
                            <a class='btn btn-primary me-3 d-flex flex-row mx-md-2 my-2 mb-3 mb-md-0 mx-5' href='../<?=$dataSocNom?>/index.php'>
                            <em class='bi bi-house me-3'></em>
                            <h5 class="mt-1">Accueil</h5></a>
                        </div>
                        <div class='profil d-flex flex-wrap desktop-profil'>
                            <a class='btn btn-primary me-3 d-flex flex-row mx-md-2 my-2 mb-3 mb-md-0 mx-5' href='tel:+330 <?=$dataSoc['societe_tel']?>'>
                            <em class='bi bi-telephone me-3'></em>
                            <h5 class="mt-1">0<?=$dataSoc['societe_tel']?></h5></a>
                        </div>
                        <?php
                    endif;
                    echo $btnProfil;
                else:
                    if((isset($_POST['connexion']) && infoSoc($_POST['connexion'])) || isset($_SESSION['id_societe']) && infoSoc($_SESSION['id_societe']) || isset($_POST['rdv']) && infoSoc($_POST['rdv'])):
                        isset($_POST['connexion'])? $dataSoc = infoSoc($_POST['connexion']):"";
                        isset($_SESSION['id_societe'])?$dataSoc = infoSoc($_SESSION['id_societe']):"";
                        isset($_POST['rdv'])?$dataSoc = infoSoc($_POST['rdv']):"";
                        $dataSocNom = str_replace(" ","",$dataSoc['societe_nom']);
                        ?>
                        <div class='profil d-flex flex-wrap desktop-profil'>
                            <a class='btn btn-primary me-3 d-flex flex-row mx-md-2 mb-3 mb-md-0 mx-5' href='../<?=$dataSocNom?>/index.php'>
                            <em class='bi bi-house me-3'></em>
                            <h5 class="mt-1">Accueil</h5></a>
                        </div>
                        <div class='profil d-flex flex-wrap desktop-profil'>
                            <a class='btn btn-primary me-3 d-flex flex-row mx-md-2 mb-3 mb-md-0 mx-5' href='tel:+330 <?=$dataSoc['societe_tel']?>'>
                            <em class='bi bi-telephone me-3'></em>
                            <h5 class="mt-1">0<?=$dataSoc['societe_tel']?></h5></a>
                        </div>
                        <?php
                    endif;
                endif;
                ?>
            </div>
        </nav>
        <?php if(isset($_SESSION['logged'])): ?>
            <div id="container">
                <div class="side-menu offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
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
                                switch ($_SESSION['profil']) {
                                    case 0:
                                        echo $linkProfil;
                                        echo $linkRdv;
                                        echo $linkJob;
                                        break;
                                    case 1:
                                        echo $linkProfil;
                                        echo $linkRdv;
                                        echo $linkClient;
                                        echo $linkSoc;
                                        break;
                                    case 2:
                                        echo $linkProfil;
                                        echo $linkSocAdmin;
                                        echo $linkClient;
                                        echo $linkRdv;
                                        echo $linkTemplate;
                                        break;
                                    case 3:
                                        echo $linkProfil;
                                        echo $linkJob;
                                        break;
                                    case 4:
                                        echo $linkProfil;
                                        echo $linkClient;
                                        echo $linkRdv;
                                        break;
                                    default:
                                    break;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif;
                if(isset($_SESSION['logged'])):
                    ?><div class="main padding" id="main"><?php
                else:
                    ?><div class="main" id="main"><?php
                endif;
                if(!isset(($_SESSION['logged']))):
                ?>
                <div class="vidindex">
                <video autoplay loop muted id="bgvid">
                    <source src="media/vidindex.mp4" type="video/mp4">
                </video>
                </div>
                <?php
                endif;
                // vérification que l'user est bien connecté
                if (isset($_SESSION['profil'])):
                    $profil = 0;
                    // affichage de la page profil et modif profil
                    if (isset($_POST['profil'])) {
                        $profil = 0;
                    }
                    if (isset($_POST['modifProfil'])) {
                        $profil = 1;
                    }
                    if($profil == 0):
                        if($_SESSION['profil'] == 0):
                            navProfil($profil);
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de <?= $_SESSION['prenom']. ' ' .$_SESSION['nom']?></h5>
                            <?php
                        elseif($_SESSION['profil'] == 1):
                            navProfil($profil);
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de <?= $_SESSION['societe_nom']?></h5>
                            <?php
                        elseif($_SESSION['profil'] == 2):
                            navProfil($profil);
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil du super Admin</h5>
                            <?php
                        elseif($_SESSION['profil'] == 3):
                            navProfilRH()
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil du RH</h5>
                            <?php
                        elseif($_SESSION['profil'] == 4):
                            navProfilRH()
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de la régule itinérante</h5>
                            <?php
                        endif;
                            require 'profile/vueProfil.php';
                    elseif($profil == 1):
                        if($_SESSION['profil'] == 0):
                            navProfil($profil);
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de <?= $_SESSION['prenom']. ' ' .$_SESSION['nom']?></h5>
                            <?php
                        elseif($_SESSION['profil'] == 1):
                            navProfil($profil);
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de <?= $_SESSION['societe_nom']?></h5>
                            <?php
                        elseif($_SESSION['profil'] == 2):
                            navProfil($profil);
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil du super Admin</h5>
                            <?php
                        elseif($_SESSION['profil'] == 3):
                            navProfilRH()
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil du RH</h5>
                            <?php
                        elseif($_SESSION['profil'] == 3):
                            navProfilRH()
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de la régule itinérante</h5>
                            <?php
                        endif;
                            require 'profile/vueModifProfil.php';
                    endif;
                else:
                    echo $formLogInSignIn;
                endif;
                ?>
            </div>
        </div>
    </div>
<?php
require "include/content/footer.php";
?>
