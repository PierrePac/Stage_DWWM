<?php
if(isset($emploi)){
    switch($emploi){
        case 0:
            $bgColor = 'style="background-color: blue"';
            break;
        default;
        break;
    }
}

// *********** Nav RH ****************
function navrhEmploi($emploi){
    $style0='style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"';
    $style1='style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"';
    $style2='style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"';
    $style4='style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"';
    ($emploi==0)? $style0 = ' ':'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"';
    ($emploi==1)? $style1 = ' ':'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"';
    ($emploi==2)? $style2 = ' ':'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"';
    ($emploi==4)? $style4 = ' ':'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"';

    echo'<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item ">
                <form action="" method="post">
                    <input type="submit" class="nav-link ongletActif" id="vueEmploi" '. $style0 .' name="vueEmploi" value="visualiser les offres d\'emploi"></input>
                </form>
            </li>
            <li class="nav-item">
                <form action="" method="post">
                    <input type="submit" class="nav-link" id="postulants" '. $style1 .' name="postulants" value="Visualiser les postulants"></input>
                </form>
            </li>
            <li class="nav-item">
                <form action="" method="post">
                    <input type="submit" class="nav-link" id="formEmploi" '. $style2 .' name="formEmploi" value="Mettre une offre en ligne"></input>
                </form>
            </li>
            <li class="nav-item">
                <form action="" method="post">
                    <input type="submit" class="nav-link" id="oldEmploi" '. $style4 .' name="oldEmploi" value="Anciennes Offres"></input>
                </form>
            </li>
        </ul>
    </div>';

}


// *********** Nav Postulant ****************
function navPostulant($emploi){
    $style0="";
    $style2="";
    ($emploi==0)? $style2 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";
    ($emploi==2)? $style0 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";

    echo '<div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <form action="" method="post">
                            <input type="submit" class="nav-link active" name="vueEmploi" '. $style0 .' value="les offres d\'emploi"></input>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="" method="post">
                            <input type="submit" class="nav-link " name="postulerSpontanne" '. $style2 .' value="Candidature spontannée"></input>
                        </form>
                    </li>
                </ul>
            </div>';
}

// **************** Visualiser les offres d'emploi *******************
function allSocieteEmploi($fkSociete){
    $db = connectBd();
    $GetThemAll = $db->prepare("SELECT * FROM `ambu_emploi` JOIN ambu_site_societe ON fk_societe = ambu_site_societe.id_societe JOIN ambu_utilisateur ON ambu_site_societe.id_societe = ambu_utilisateur.fk_societe WHERE `statut` = 1 $fkSociete GROUP BY `emploi_id` ORDER BY ambu_emploi.date DESC");
    $GetThemAll->execute();
    $allEmploiSociete = $GetThemAll->fetchAll(PDO::FETCH_ASSOC);
    return $allEmploiSociete;
}

function oneSocieteEmploi($idSociete){
    $db = connectBd();
    $GetThemAll = $db->prepare("SELECT * FROM `ambu_emploi` JOIN ambu_site_societe ON fk_societe = ambu_site_societe.id_societe JOIN ambu_utilisateur ON ambu_site_societe.id_societe = ambu_utilisateur.fk_societe WHERE `statut` = 1 AND id_societe = $idSociete GROUP BY `emploi_id` ORDER BY `emploi_id` DESC");
    $GetThemAll->execute();
    $allEmploiSociete = $GetThemAll->fetchAll(PDO::FETCH_ASSOC);
    return $allEmploiSociete;
}

// modifier une offre

function recuperationOffre($data){
  $emploiId = $data['emploi_id'];
  $db = connectBd();
  $GetTheJob = $db->prepare("SELECT * FROM ambu_emploi WHERE $emploiId = emploi_id");
  $GetTheJob->execute();
  $gotIt = $GetTheJob->fetch(PDO::FETCH_ASSOC);
  return $gotIt;
}

// visualisation des anciennes offres

function oldSocieteEmploi(){
  $db = connectBd();
  $GetThemAll = $db->prepare("SELECT * FROM `ambu_emploi` JOIN ambu_site_societe ON fk_societe = ambu_site_societe.id_societe JOIN ambu_utilisateur ON ambu_site_societe.id_societe = ambu_utilisateur.fk_societe WHERE `statut` = 0 GROUP BY `emploi_id` ORDER BY `emploi_id` ASC");
  $GetThemAll->execute();
  $allEmploiSociete = $GetThemAll->fetchAll(PDO::FETCH_ASSOC);
  return $allEmploiSociete;
}

// Désactivation d'une offre d'emploi

if(isset($_POST['desactiverOffre'])){
  desactivationOffre($_POST['emploi_id']);
}

function desactivationOffre($emploiId){
  $db = connectBd();
  $desactivation = $db->prepare("UPDATE `ambu_emploi` SET `statut` = 0 WHERE `emploi_id` = :emploiId");
  $desactivation->BindParam('emploiId', $emploiId, PDO::PARAM_INT);
  $desactivation->execute();
  header('location:emploi.php');
}

// Réactivation d'une offre d'emploi

if(isset($_POST['reactiverOffre'])){
  reactivationOffre($_POST['emploi_id']);
}

function reactivationOffre($emploiId){
  $db = connectBd();
  $reactivation = $db->prepare("UPDATE `ambu_emploi` SET `statut` = 1, `date` = NOW() WHERE `emploi_id` = :emploiId");
  $reactivation->BindParam('emploiId', $emploiId, PDO::PARAM_INT);
  $reactivation->execute();
  header('location:emploi.php');
}


// Récupération des nom des Société qui ont des emploi en ligne

function socName(){
    $db = connectBd();
    $GetName = $db->prepare("SELECT `societe_nom`, `fk_societe`, `nom_emploi`, `emploi_id` FROM ambu_site_societe JOIN ambu_emploi ON id_societe = fk_societe AND ambu_emploi.statut = 1 GROUP BY fk_societe ORDER BY fk_societe DESC");
    $GetName->execute();
    $getAllNames = $GetName->fetchAll(PDO::FETCH_ASSOC);
    return $getAllNames;
  }

 // récupération des Postulants avec deux variable de trie sur la société et les offres

  function allSocietePostulant($fkSociete, $idEmploi){
    $db = connectBd();
    $GetThemAll = $db->prepare("SELECT * FROM `ambu_postulant` JOIN ambu_emploi ON fk_emploi = emploi_id WHERE `statut` = 1 $fkSociete $idEmploi ORDER BY `date` DESC");
    $GetThemAll->execute();
    $allEmploiPostulant = $GetThemAll->fetchAll(PDO::FETCH_ASSOC);
    return $allEmploiPostulant;
}

// récupération des Emplois

function allEmploi(){
    $db = connectBd();
    $getEmploi = $db->prepare("SELECT `emploi_id`,`nom_emploi`FROM ambu_emploi");
    $getEmploi->execute();
    $allEmploi = $getEmploi->fetchAll(PDO::FETCH_ASSOC);
    return $allEmploi;
}

// Postulant traité

if(isset($_POST['PostulantTraite'])){
    désactivationPostulant($_POST['postulant_id']);
    unlink($_POST['cv']);
    (isset($_POST['motivation']))?unlink($_POST['motivation']):"";
    $emploi = 1;
}

function désactivationPostulant($postulant_id){
    $db = connectBd();
    $desactivation = $db->prepare("DELETE FROM `ambu_postulant` WHERE postulant_id = :postulant_id ");
    $desactivation->BindParam('postulant_id', $postulant_id, PDO::PARAM_INT);
    $desactivation->execute();
    return $emploi = 1;
}

// nom de tout les sociétés

function allSocName(){
    $db = connectBd();
    $getSocName = $db->prepare("SELECT `societe_nom`, `id_societe` FROM ambu_site_societe WHERE active = 1");
    $getSocName->execute();
    $getAllNames = $getSocName->fetchAll(PDO::FETCH_ASSOC);
    return $getAllNames;
}