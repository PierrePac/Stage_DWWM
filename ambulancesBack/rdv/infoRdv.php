<?php

if (!isset($_SESSION['profil'])) {
  header('location:../index.php');
}

// *********** Nav societe ****************

function navRdvClient($rdv){
  $style0="";
  $style1="";
  $style2="";
  ($rdv==0)? $style0 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";
  ($rdv==1)? $style1 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";
  ($rdv==2)? $style2 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";
 
  echo '<div class="card text-center">
  <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
              <form action="" method="post">
                  <input type="submit" class="nav-link active" '. $style0 .' name="vueRdv" value="Prendre un rendez-vous"></input>
              </form>
          </li>
          <li class="nav-item">
              <form action="" method="post">
                  <input type="submit" class="nav-link active" '. $style2 .' name="traitementRdv" value="Rendez-vous en traitement"></input>
              </form>
          </li>
          <li class="nav-item">
              <form action="" method="post">
                  <input type="submit" class="nav-link active" '. $style1 .' name="historiqueRdv" value="historique des rendez-vous"></input>
              </form>
          </li>
      </ul>
  </div>';
}

function navRdvAdmin($rdv){
  $style0="";
  $style1="";
  ($rdv==0)? $style1 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";
  ($rdv==1)? $style0 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";
 
  echo '<div class="card text-center">
  <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
              <form action="" method="post">
                  <input type="submit" class="nav-link active" '. $style0 .' name="vueRdv" value="Les demandes"></input>
              </form>
          </li>
          <li class="nav-item">
              <form action="" method="post">
                  <input type="submit" class="nav-link active" '. $style1 .' name="historiqueRdv" value="Les demandes traitées"></input>
              </form>
          </li>
      </ul>
  </div>';
}


// *********** si c'est un profil Client *****************

// *********** Vue historique rdv ****************

// vue de l'historique des rdv pour le client

function allClientRdv($idClient, $fkSociete, $statut)
{
  $db = connectBd();
  $GetThemAll = $db->prepare("SELECT * FROM ambu_rdv JOIN ambu_utilisateur ON `fk_user` = `user_id` WHERE `statut` = $statut AND `user_id` = $idClient AND ambu_rdv.fk_societe = $fkSociete ORDER BY `rdv_id` DESC");
  $GetThemAll->execute();
  $allClientRdv = $GetThemAll->fetchAll(PDO::FETCH_ASSOC);
  return $allClientRdv;
}

// vue des rdv en traitement pour la societe
function allSocieteRdv($idSociete, $statut)
{
  $db = connectBd();
  $GetThemAll = $db->prepare("SELECT * FROM `ambu_rdv` JOIN ambu_utilisateur ON fk_user = user_id JOIN ambu_site_societe ON id_societe = ambu_rdv.fk_societe WHERE `statut` = $statut AND id_societe = $idSociete ORDER BY `rdv_id` ASC");
  $GetThemAll->execute();
  $allClientRdv = $GetThemAll->fetchAll(PDO::FETCH_ASSOC);
  return $allClientRdv;
}
// vue des rdv en traitement pour le super Admin
function allAdminRdv($fkSociete, $statut)
{
  $db = connectBd();
  $GetThemAll = $db->prepare("SELECT * FROM `ambu_rdv` JOIN ambu_utilisateur ON fk_user = user_id JOIN ambu_site_societe ON id_societe = ambu_rdv.fk_societe WHERE `statut` = $statut $fkSociete ORDER BY `rdv_id` DESC");
  $GetThemAll->execute();
  $allClientRdv = $GetThemAll->fetchAll(PDO::FETCH_ASSOC);
  return $allClientRdv;
}


// Récupération des nom des Société qui ont des rdv en ligne

function socName($statut){
  $db = connectBd();
  $GetName = $db->prepare("SELECT * FROM `ambu_rdv` JOIN ambu_site_societe ON ambu_site_societe.id_societe = ambu_rdv.fk_societe WHERE ambu_rdv.statut = $statut GROUP BY ambu_rdv.fk_societe");
  $GetName->execute();
  $getAllNames = $GetName->fetchAll(PDO::FETCH_ASSOC);
  return $getAllNames;
}
