<?php

if (!isset($_SESSION['profil'])) {
    header('location:../index.php');
}
require 'include/bdd.php';

// *********** Nav societe ****************
function navClient($societe){
    $style0="";
    $style2="";
    ($societe==0)? $style2 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";
    ($societe==2)? $style0 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";
   
    echo '<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <form action="" method="post">
                    <input type="submit" class="nav-link active" '. $style0 .' name="clients" value="Vos clients"></input>
                </form>
            </li>
            <li class="nav-item">
                <form action="" method="post">
                <input type="submit" class="nav-link active" '. $style2 .' name="oldClients" value="Vos anciens clients"></input>
                </form>
            </li>
        </ul>
    </div>';
  }
$navClientSoc = '<div class="card text-center">
<div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
            <form action="" method="post">
                <input type="submit" class="nav-link active" name="clients" value="Vos clients"></input>
            </form>
        </li>
      </ul>
</div>';

$navClientSAdmin = '<div class="card text-center">
<div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
            <form action="" method="post">
                <input type="submit" class="nav-link active" name="clients" value="les clients"></input>
            </form>
        </li>
    </ul>
</div>';

// *********** si c'est un profil Societe *****************

// *********** Vue profil des Clients ****************

function allClients($idsoc, $active){
    $db = connectBd();
    $GetThemAll = $db->prepare("SELECT * FROM ambu_utilisateur WHERE `active` = $active AND `fk_societe` = $idsoc AND `profil` = 0");
    $GetThemAll->execute();
    $allClients = $GetThemAll->fetchAll(PDO::FETCH_ASSOC);
    return $allClients;
}


// *********** Vue profil d'un Client ***************

function oneUser($idClient){
    $db = connectBd();
    $GetOne = $db->prepare("SELECT * FROM ambu_utilisateur WHERE `user_id` = $idClient AND `active` = 1");
    $GetOne->execute();
    $oneClient = $GetOne->fetch(PDO::FETCH_ASSOC);
    return $oneClient;
  }
  function oneUserSAdmin($idClient){
    $db = connectBd();
    $GetOne = $db->prepare("SELECT * FROM ambu_utilisateur WHERE `user_id` = $idClient");
    $GetOne->execute();
    $oneClient = $GetOne->fetch(PDO::FETCH_ASSOC);
    return $oneClient;
  }

// *********** si c'est un profil super admin *****************

// *********** Vue profil des Clients ****************


function allClientsSAdmin($active, $triClient){
    $db = connectBd();
    $GetThemAll = $db->prepare("SELECT * FROM ambu_utilisateur WHERE `profil` = 0  AND `active` = $active $triClient");
    $GetThemAll->execute();
    $allClients = $GetThemAll->fetchAll(PDO::FETCH_ASSOC);
    return $allClients;
}

// *********** Récupération des noms de sociétés qui ont au moins 1 client ****************

function socName($statut){
    $db = connectBd();
    $GetThemAll = $db->prepare("SELECT ambu_site_societe.societe_nom, ambu_site_societe.id_societe FROM `ambu_utilisateur` JOIN `ambu_site_societe` ON id_societe = fk_societe WHERE ambu_utilisateur.active = $statut GROUP BY fk_societe");
    $GetThemAll->execute();
    $allClientsSoc = $GetThemAll->fetchAll(PDO::FETCH_ASSOC);
    return $allClientsSoc;
}
