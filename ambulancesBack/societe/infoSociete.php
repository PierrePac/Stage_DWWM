<?php

if (!isset($_SESSION['profil'])) {
    header('location:../index.php');
}
require 'include/bdd.php';

// *********** Nav societe ****************
$navSocieteSoc = '<div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <form action="" method="post">
                                    <input type="submit" class="nav-link active" name="societe" value="Votre société"></input>
                                </form>
                            </li>
                        </ul> 
                    </div>';
function navSocieteAdmin($societe){
  $style0="";
  $style3="";
  ($societe==0)? $style3 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";
  ($societe==3)? $style0 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";
 
  echo '<div class="card text-center">
  <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
              <form action="" method="post">
                <input type="submit" class="nav-link active" '. $style0 .' name="societe" value="Liste des sociétés"></input>
              </form>
          </li>
          <li class="nav-item">
              <form action="" method="post">
                <input type="submit" class="nav-link active" '. $style3 .' name="oldSociete" value="anciennes sociétés"></input>
              </form>
          </li>
      </ul>
  </div>';
}


// *********** Vue profil des sociétés ****************

function allSocietes($active){
    $db = connectBd();
    $GetThemAll = $db->prepare("SELECT * FROM ambu_site_societe WHERE `active`=$active");
    $GetThemAll->execute();
    $allSocietes = $GetThemAll->fetchAll(PDO::FETCH_ASSOC);
    return $allSocietes;
}


// *********** Vue profil d'une sociétés ***************

function oneSocietes($idSoc){
  $db = connectBd();
  $GetOne = $db->prepare("SELECT * FROM ambu_site_societe WHERE `id_societe` = $idSoc");
  $GetOne->execute();
  $oneSocietes = $GetOne->fetch(PDO::FETCH_ASSOC);
  return $oneSocietes;
}



