<?php
require "include/content/head.php";
if(!isset($_SESSION['profil']) || $_SESSION['profil'] == 0){
    header('location: index.php');
}

?>
    <title>Clients</title>
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
                                <p class="my-auto mx-3"><h1><?= $_SESSION['societe_nom'] ?><h1></p>
                            </div>
                        <?php
                    elseif ($_SESSION['profil'] == 2):
                        echo "<h1>Bonjour vous êtes connecté en Super Admin</h1>";
                    elseif ($_SESSION['profil'] == 4):
                        echo "<h1>Bonjour vous êtes connecté en régule itinérante</h1>";
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
                        if($_SESSION['profil'] == 1){
                            echo $linkTopRdv;
                            echo $linkTopClient;
                            echo $linkTopSoc;
                        } elseif($_SESSION['profil'] == 2){
                            echo $linkTopSocAdmin;
                            echo $linkTopClient;
                            echo $linkTopRdv;
                            echo $linkTopTemplate;
                        }elseif($_SESSION['profil'] == 4){
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
                            if (isset($_SESSION['profil'])){
                                require 'navbar/navbar.php';
                                if($_SESSION['profil'] == 1){
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
                                }elseif($_SESSION['profil'] == 4){
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
                if (isset($_SESSION['profil'])):
                    (isset($triClient) == NULL) ? $triClient = '' : "";
                    (isset($_POST['triClient']))? $triClient = 'AND `fk_societe` = '.$_POST['id_societe']:$triClient = '';
                    $client = 0;
                    if(isset($_POST['triOldClient'])){
                        $triClient = 'AND `fk_societe` ='.$_POST['id_societe'];
                        $client = 2;
                    } else{
                        $triClient = '';
                    }
                    //(isset($id_societe) == NULL) ? $id_societe = '' :"";
                    if (isset($_POST['clients'])){
                        $client = 0;
                    }
                    if (isset($_POST['modifClients'])){
                        $client = 1;
                    }
                    if (isset($_POST['oldClients'])){
                        $client = 2;
                    }
                    if($client == 0):
                            require 'client/infoClients.php';
                            if($_SESSION['profil'] == 1):
                                echo navClient($client);
                                ?>
                                    <div class="card-body">
                                    <h5 class="card-title">Bienvenue sur le profil du super Admin </h5>
                                    <div class="row">
                                <?php
                                foreach(allClients($_SESSION['id_societe'], 1) as $dataclients){
                                    require "client/cardAllClients.php";
                                }
                                ?>
                                    </div>
                                <?php
                            elseif($_SESSION['profil'] == 2 || $_SESSION['profil'] == 4):
                                echo navClient($client);
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
                                                    <input type="submit" class="nav-link active w-100" name="triClient" value="Toutes les clients"></input>
                                                </form>
                                            </li>
                                            <li>
                                                <?php foreach(socName(1) as $socName): ?>
                                                <form action="" method="post">
                                                    <input type="submit" class="nav-link active w-100" name="triClient" value="<?= $socName['societe_nom'] ?>"></input>
                                                    <input type="hidden" name="id_societe" value="<?= $socName['id_societe'] ?>"></input>
                                                </form>
                                                <?php endforeach; ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="row mx-auto">
                                <?php
                                foreach(allClientsSAdmin(1, $triClient) as $dataclients){
                                    require "client/cardAllClients.php";
                                }
                                ?>
                                    </div>
                                <?php
                            endif;
                    elseif($client == 1):
                        require 'client/infoClients.php';
                        if($_SESSION['profil'] == 1):
                            echo navClient($client);
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil de <?=$_SESSION['societe_nom']?></h5>
                            <?php
                            $arrayClient = oneUser($_POST['id_client']);
                            require "client/oneClient.php";
                        elseif($_SESSION['profil'] == 2 || $_SESSION['profil'] == 4):
                            echo navClient($client);
                            ?>
                                <div class="card-body">
                                <?php if($_SESSION['profil'] == 2): ?>
                                <h5 class="card-title">Bienvenue sur le profil du super Admin </h5>
                                <?php else: ?>
                                <h5 class="card-title">Bienvenue sur le profil de la régule itinérante </h5>
                                <?php endif; ?>
                            <?php
                            $arrayClient = oneUserSAdmin($_POST['id_client']);
                            require "client/oneClient.php";
                        endif;
                    endif;
                    if($client == 2):
                        require 'client/infoClients.php';
                        if($_SESSION['profil'] == 1):
                            echo navClient($client);
                            ?>
                                <div class="card-body">
                                <h5 class="card-title">Bienvenue sur le profil du super Admin </h5>
                                <div class="row">
                            <?php
                            if(!empty(allClients($_SESSION['id_societe'], 0))):
                                foreach(allClients($_SESSION['id_societe'], 0) as $dataclients){
                                    require "client/cardAllClients.php";
                                }
                                ?>
                                    </div>
                                <?php
                            else:
                                echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Il n\'y a pas de client désactivé</div>';
                            endif;
                        elseif($_SESSION['profil'] == 2 || $_SESSION['profil'] == 4):
                            echo navClient($client);
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
                                                <input type="submit" class="nav-link active w-100" name="triOldClient" value="Toutes les clients"></input>
                                            </form>
                                        </li>
                                        <li>
                                            <?php foreach(socName(0) as $socName): ?>
                                            <form action="" method="post">
                                                <input type="submit" class="nav-link active w-100" name="triOldClient" value="<?= $socName['societe_nom'] ?>"></input>
                                                <input type="hidden" name="id_societe" value="<?= $socName['id_societe'] ?>"></input>
                                            </form>
                                            <?php endforeach; ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="row mx-auto">
                            <?php
                            if(!empty((allClientsSAdmin(0, $triClient)))):
                                foreach(allClientsSAdmin(0, $triClient) as $dataclients){
                                    require "client/cardAllClients.php";
                                }
                                ?>
                                    </div>
                                <?php
                            else:
                                echo '<div class="d-inline justify-content-center bg-primary text-white my-5 mx-auto w-50 p-3">Il n\'y a pas de client désactivé</div>';
                            endif;
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