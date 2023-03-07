<?php
ob_start();
if(!isset($_SESSION)){ 
    session_start(); 
} 
require "sendEmail.php";

// ************* MODIFICATION DES PROFILS ************************

if (isset($_POST['modifProfil'])) {
    $userId =  checkFormulaire($_POST["user_id"]);
    $nom =  checkFormulaire($_POST["modifNom"]);
    $prenom = checkFormulaire($_POST["modifPrenom"]); 
    $adresse = checkFormulaire($_POST["modifAdress"]);
    $zip = checkFormulaire($_POST["modifZip"]);
    $ville = checkFormulaire($_POST["modifVille"]);
    $tel = checkFormulaire($_POST["modifTel"]);
    $dob = checkFormulaire($_POST["modifAnniv"]);
    $email = checkFormulaire($_POST["modifMail"]);
    $mdp = checkFormulaire($_POST["modifMdp"]);
    $verifMdp = checkFormulaire($_POST["modifVerifMdp"]);
    $mdpCrypted = hash('sha256', $mdp);
    if(isset($mdp) && !empty($mdp) && $mdp === $verifMdp){
        if (isset ($userId) && isset($nom) && isset($prenom) && isset($adresse) && isset($zip) && isset($ville) && isset($tel) && isset($dob) && isset($email) && isset($mdp) && $mdp == $verifMdp) {
        $send = injectionModificationProfilMdp($userId, $nom, $prenom, $adresse, $zip, $ville, $tel, $dob, $email, $mdpCrypted);
        $refresh = initSession($email, $mdpCrypted, $_SESSION['id_societe']);
            }
    } else {
        if (isset ($userId) && isset($nom) && isset($prenom) && isset($adresse) && isset($zip) && isset($ville) && isset($tel) && isset($dob) && isset($email)) {
            $send = injectionModificationProfil($userId, $nom, $prenom, $adresse, $zip, $ville, $tel, $dob, $email);
            $refresh = initSession($email, $_SESSION['mdp'], $_SESSION['id_societe']);
        }
    }
    }

function injectionModificationProfilMdp($userId, $nom, $prenom, $adresse, $zip, $ville, $tel, $dob, $email, $mdpCrypted){
    $db = connectBd();
    $modificationProfile = $db->prepare("UPDATE `ambu_utilisateur` SET `nom` = :nom, `prenom` = :prenom, `adress` = :adresse, `zip` = :zip, `ville` = :ville,
     `tel` = :tel, `mail` = :email, `mdp` = :mdpCrypted, `anniv` = :dob WHERE `user_id` = :userId");
    $modificationProfile->BindParam('userId', $userId, PDO::PARAM_INT);
    $modificationProfile->BindParam('nom', $nom, PDO::PARAM_STR);
    $modificationProfile->BindParam('prenom', $prenom, PDO::PARAM_STR);
    $modificationProfile->BindParam('adresse', $adresse, PDO::PARAM_STR);
    $modificationProfile->BindParam('zip', $zip, PDO::PARAM_INT);
    $modificationProfile->BindParam('ville', $ville, PDO::PARAM_STR);
    $modificationProfile->BindParam('tel', $tel, PDO::PARAM_INT);
    $modificationProfile->BindParam('dob', $dob);
    $modificationProfile->BindParam('email', $email, PDO::PARAM_STR);
    $modificationProfile->BindParam('mdpCrypted', $mdpCrypted, PDO::PARAM_STR);
    $modificationProfile->execute();
    header('location:../index.php');
    return true;
}

function injectionModificationProfil($userId, $nom, $prenom, $adresse, $zip, $ville, $tel, $dob, $email){
    $db = connectBd();
    $modificationProfile = $db->prepare("UPDATE `ambu_utilisateur` SET `nom` = :nom, `prenom` = :prenom, `adress` = :adresse, `zip` = :zip, `ville` = :ville, `tel` = :tel, `mail` = :email, `anniv` = :dob WHERE `user_id` = :userId");
    $modificationProfile->BindParam('userId', $userId, PDO::PARAM_INT);
    $modificationProfile->BindParam('nom', $nom, PDO::PARAM_STR);
    $modificationProfile->BindParam('prenom', $prenom, PDO::PARAM_STR);
    $modificationProfile->BindParam('adresse', $adresse, PDO::PARAM_STR);
    $modificationProfile->BindParam('zip', $zip, PDO::PARAM_INT);
    $modificationProfile->BindParam('ville', $ville, PDO::PARAM_STR);
    $modificationProfile->BindParam('tel', $tel, PDO::PARAM_INT);
    $modificationProfile->BindParam('dob', $dob);
    $modificationProfile->BindParam('email', $email, PDO::PARAM_STR);
    $modificationProfile->execute();
    if($_SESSION['profil'] == 2 && $_SESSION['user_id'] != $userId){
        header('location:../clients.php');
    } else{
        header('location:../index.php');
    }
}

// Désactivation d'un client

if(isset($_POST['desactiverClient'])){
    desactivationClient($_POST['id_client']);

}

function desactivationClient($userId){
    $db = connectBd();
    $desactivation = $db->prepare("UPDATE `ambu_utilisateur` SET `active` = 0 WHERE `user_id` = :idClient");
    $desactivation->BindParam('idClient', $userId, PDO::PARAM_INT);
    $desactivation->execute();
    header('location:../clients.php');
}

// Réactivation d'un client

if(isset($_POST['reactiverClient'])){
    reactivationClient($_POST['id_client']);

}

function reactivationClient($userId){
    $db = connectBd();
    $reactivation = $db->prepare("UPDATE `ambu_utilisateur` SET `active` = 1 WHERE `user_id` = :idClient");
    $reactivation->BindParam('idClient', $userId, PDO::PARAM_INT);
    $reactivation->execute();
    header('location:../clients.php');
}


//*********************** MODIFICATION DES SOCIETES *********************

// Vérification des images
function vérificationImages($img, $type){
    $idSociete = $_POST['id_societe'];
    $db = connectBd();
    $getImage = $db->prepare("SELECT `img_1`, `img_2`, `img_3`, `slider_1`, `slider_2`, `slider_3`, `logo` FROM ambu_site_societe WHERE `id_societe` = $idSociete");
    $getImage->execute();
    $getImages = $getImage->fetch(PDO::FETCH_ASSOC);
    if(in_array($img['name'], $getImages)){
        return $img;
    } else {
        // vérification de la bonne extension
        $extension = strtolower(substr($img['name'],-4));
        $allowExtension = array(".jpg", "jpeg", ".png", ".gif", "webp");
        if(in_array($extension, $allowExtension)){
            if($extension == "jpeg" || $extension == "webp"){
                $img['name'] = '.webp';
                $img['type'] = str_replace($img['type'], "image/".$extension, "image/webp");
            } else{
                $img['name'] = '.webp';
                $img['type'] = str_replace($img['type'], "image/".$extension, "image/webp");
            }
                (!file_exists("../../ambulances".$_POST["dossier"]."/media/"))? mkdir("../../ambulances".$_POST["dossier"]."/media/"):"";
                move_uploaded_file($img['tmp_name'], "../../ambulances".$_POST["dossier"]."/media/". $_POST["id_societe"]."-".$type."-".$img['name']);
                $img['name'] = $_POST["id_societe"]."-".$type."-".$img['name'];
        }
        return $img['name'];    
    }
}

function resizeimgcarre($img, $height, $width){
    (!file_exists("../media/".$_POST["modifSocieteNom"]))? mkdir("../media/".$_POST["modifSocieteNom"]):"";
    $image = imagecreatefromjpeg($img['tmp_name']);
    $filename = ($img['tmp_name']);
    $infos = getimagesize($img['tmp_name']);
    $hauteur = $infos[1];
    $largeur = $infos[0];
    $finalHauteur = $height;
    $finalLargeur = $width;
    if ( $hauteur < $largeur ){
        $newHauteur = $finalHauteur;
        $newLargeur = ($largeur * $newHauteur) / $hauteur;
    } elseif ( $hauteur > $largeur ) {
        $newLargeur = $finalLargeur;
        $newHauteur = ($hauteur * $newLargeur) / $largeur;
    } else {
        $newHauteur = $finalHauteur;
        $newLargeur = $finalLargeur;
    }
    $newImage = imagecreatetruecolor($newLargeur, $newHauteur);

    // Resize and crop
    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newLargeur, $newHauteur, $largeur, $hauteur);
    imagejpeg($newImage, $filename, 100);
    $newImage2 = imagecrop($newImage, ['x' => 0, 'y' => 0, 'width' => $width, 'height' => $height]);
    imagejpeg($newImage2, $filename, 100);
    imagedestroy($newImage);
    return $newImage2;
}

function resizeimgrectangle($img, $height, $width){
    (!file_exists("../media/".$_POST["modifSocieteNom"]))? mkdir("../media/".$_POST["modifSocieteNom"]):"";
    $image = imagecreatefromjpeg($img['tmp_name']);
    $filename = ($img['tmp_name']);
    $infos = getimagesize($img['tmp_name']);
    $hauteur = $infos[1];
    $largeur = $infos[0];
    $finalHauteur = $height;
    $finalLargeur = $width;
    if ( 3*$hauteur < $largeur ){
        $newHauteur = $finalHauteur;
        $newLargeur = ($largeur * $newHauteur) / $hauteur;
    } elseif ( 3*$hauteur > $largeur ) {
        $newLargeur = $finalLargeur;
        $newHauteur = ($hauteur * $newLargeur) / $largeur;
    } else {
        $newHauteur = $finalHauteur;
        $newLargeur = $finalLargeur;
    }
    $newImage = imagecreatetruecolor($newLargeur, $newHauteur);

    // Resize and crop
    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newLargeur, $newHauteur, $largeur, $hauteur);
    imagejpeg($newImage, $filename, 100);
    $newImage2 = imagecrop($newImage, ['x' => 0, 'y' => 0, 'width' => $width, 'height' => $height]);
    imagejpeg($newImage2, $filename, 100);
    imagedestroy($newImage);
    return $newImage2;
}

if(isset($_POST['modifSociete'])){
    $idSociete = checkFormulaire($_POST["id_societe"]);
    $societeNom = checkFormulaire($_POST["modifSocieteNom"]);
    $dateCreation =  checkFormulaire($_POST["modifDateCreation"]);
    $societeAdress =  checkFormulaire($_POST["modifSocieteAdress"]);
    $societeZip =  checkFormulaire($_POST["modifSocieteZip"]);
    $societeVille =  checkFormulaire($_POST["modifSocieteVille"]);
    $societeTel =  checkFormulaire($_POST["modifSocieteTel"]);
    $societeMail =  checkFormulaire($_POST["modifSocieteMail"]);
    $story1 =  checkFormulaire($_POST["modifStory1"]);
    $story2 =  checkFormulaire($_POST["modifStory2"]);
    if($_FILES["img_1"]['name'] == ''){
        $img1 = $_POST['img_1'];
    }else{
        $img1 = resizeimgrectangle($_FILES["img_1"], 600, 1800);
        $img1 = vérificationImages($_FILES["img_1"], 'img1');
    }
    if($_FILES["img_2"]['name'] == ''){
        $img2 = $_POST['img_2'];
    }else{
        $img2 = resizeimgcarre($_FILES["img_2"], 600, 600);
        $img2 = vérificationImages($_FILES["img_2"], 'img2');
    }
    if($_FILES["img_3"]['name'] == ''){
        $img3 = $_POST['img_3'];
    }else{
        $img3 = resizeimgcarre($_FILES["img_3"], 600, 600);
        $img3 = vérificationImages($_FILES["img_3"], 'img3');
    }
    if($_FILES["slider_1"]['name'] == ''){
        $slider1 = $_POST['slider_1'];
    }else{
        $slider1 = resizeimgrectangle($_FILES["slider_1"], 600, 1800);
        $slider1 = vérificationImages($_FILES["slider_1"], 'slider_1');
    }
    if($_FILES["slider_2"]['name'] == ''){
        $slider2 = $_POST['slider_2'];
    }else{
        $slider2 = resizeimgrectangle($_FILES["slider_2"], 600, 1800);
        $slider2 = vérificationImages($_FILES["slider_2"], 'slider_2');
    }
    if($_FILES["slider_3"]['name'] == ''){
        $slider3 = $_POST['slider_3'];
    }else{
        $slider3 = resizeimgrectangle($_FILES["slider_3"], 600, 1800);
        $slider3 = vérificationImages($_FILES["slider_3"], 'slider_3');
    }
    if($_FILES["logo"]['name'] == ''){
        $logo = $_POST['logo'];
    }else{
        $logo = resizeimgcarre($_FILES["logo"], 75, 75);
        $logo = vérificationImages($_FILES["logo"], 'logo');
    }
    $map = checkFormulaire($_POST['map']);
    $templateId =  checkFormulaire($_POST["modifTemplate"]);
    var_dump($logo);
    if(isset($idSociete) && isset($societeNom) && isset($dateCreation) && isset($societeAdress) && isset($societeZip) && isset($societeVille) && isset($societeTel) && isset($societeMail) && isset($story1) && isset($story2) && isset($img1) && isset($img2) && isset($img3) && isset($slider1) && isset($slider2) && isset($slider3) && isset($logo) && isset($map) && isset($templateId)){
        $send = injectionModificationSociete($idSociete, $societeNom, $dateCreation, $societeAdress, $societeZip, $societeVille, $societeTel, $societeMail, $story1, $story2, $img1, $img2, $img3, $slider1, $slider2, $slider3, $logo, $map, $templateId);
        $refresh = initSession($_SESSION['mail'], $_SESSION['mdp'], $_SESSION['societe_id']);     
    } else {
        header('location: ../societe.php');
    }
}

function injectionModificationSociete($idSociete, $societeNom, $dateCreation, $societeAdress, $societeZip, $societeVille, $societeTel, $societeMail, $story1, $story2, $img1, $img2, $img3, $slider1, $slider2, $slider3, $logo, $map, $templateId){
    $db = connectBd();
    $modificationSociete = $db->prepare("UPDATE `ambu_site_societe` SET `societe_nom` = :societeNom, `date_creation` = :dateCreation, `societe_adress` = :societeAdress, `societe_zip` = :societeZip, `societe_ville` = :societeVille, `societe_tel` = :societeTel, `societe_mail` = :societeMail, `story_1` = :story1, `story_2` = :story2, `img_1` = :img1, `img_2` = :img2, `img_3` = :img3, `slider_1` = :slider1, `slider_2` = :slider2, `slider_3` = :slider3, `logo` = :logo, `map` = :map, `template_id` = :templateId WHERE `id_societe` = :idSociete");
    $modificationSociete->BindParam('idSociete', $idSociete, PDO::PARAM_INT);
    $modificationSociete->BindParam('societeNom', $societeNom, PDO::PARAM_STR);
    $modificationSociete->BindParam('dateCreation', $dateCreation);
    $modificationSociete->BindParam('societeAdress', $societeAdress, PDO::PARAM_STR);
    $modificationSociete->BindParam('societeZip', $societeZip, PDO::PARAM_INT);
    $modificationSociete->BindParam('societeVille', $societeVille, PDO::PARAM_STR);
    $modificationSociete->BindParam('societeTel', $societeTel, PDO::PARAM_INT);
    $modificationSociete->BindParam('societeMail', $societeMail, PDO::PARAM_STR);
    $modificationSociete->BindParam('story1', $story1, PDO::PARAM_STR);
    $modificationSociete->BindParam('story2', $story2, PDO::PARAM_STR);
    $modificationSociete->BindParam('img1', $img1, PDO::PARAM_STR);
    $modificationSociete->BindParam('img2', $img2, PDO::PARAM_STR);
    $modificationSociete->BindParam('img3', $img3, PDO::PARAM_STR);
    $modificationSociete->BindParam('slider1', $slider1, PDO::PARAM_STR);
    $modificationSociete->BindParam('slider2', $slider2, PDO::PARAM_STR);
    $modificationSociete->BindParam('slider3', $slider3, PDO::PARAM_STR);
    $modificationSociete->BindParam('map', $map, PDO::PARAM_STR);
    $modificationSociete->BindParam('logo', $logo, PDO::PARAM_STR);
    $modificationSociete->BindParam('templateId', $templateId, PDO::PARAM_INT);
    $modificationSociete->execute();
    header('location: ../societe.php');
    return true;
}


// Désactivation d'une societe

if(isset($_POST['desactiverSociete'])){
    desactivationSociete($_POST['id_societe']);
}

function desactivationSociete($socId){
    $db = connectBd();
    $desactivation = $db->prepare("UPDATE `ambu_site_societe` SET `active` = 0 WHERE `id_societe` = :socId");
    $desactivation->BindParam('socId', $socId, PDO::PARAM_INT);
    $desactivation->execute();
    header('location:../societe.php');
}

// Réactivation d'une societe

if(isset($_POST['reactiverSociete'])){
    reactivationSociete($_POST['id_societe']);
}

function reactivationSociete($socId){
    $db = connectBd();
    $reactivation = $db->prepare("UPDATE `ambu_site_societe` SET `active` = 1 WHERE `id_societe` = :socId");
    $reactivation->BindParam('socId', $socId, PDO::PARAM_INT);
    $reactivation->execute();
    header('location:../societe.php');
}



//*********************** Prise de RDV *********************

if(isset($_POST['priseRdv'])){
    require "captcha.php";
    verifCaptcha($_POST['g-recaptcha-response']);
    if($sendEmail = 1){
        $idUser = $_SESSION['user_id'];
        $idSoc = $_SESSION['fk_societe'];
        $rdvDate =  checkFormulaire($_POST["rdv_date"]);
        $heure =  checkFormulaire($_POST["heure"]);
        $transportType =  checkFormulaire($_POST["transport_type"]);
        $transportKms =  checkFormulaire($_POST["transport_kms"]);
        $raison =  checkFormulaire($_POST["raison"]);
        $ald =  checkFormulaire($_POST["ald"]);
        $pickName =  checkFormulaire($_POST["pick_name"]);
        $pickAdress =  checkFormulaire($_POST["pick_adress"]);
        $pickZip =  checkFormulaire($_POST["pick_zip"]);
        $pickVille =  checkFormulaire($_POST["pick_ville"]);
        $destName =  checkFormulaire($_POST["dest_name"]);
        $destAdress =  checkFormulaire($_POST["dest_adress"]);
        $destZip =  checkFormulaire($_POST["dest_zip"]);
        $destVille =  checkFormulaire($_POST["dest_ville"]);
        if(isset($idUser) && isset($idSoc) && isset($rdvDate) && isset($heure) && isset($transportType) && isset($transportKms) && isset($raison) && isset($ald) && isset($pickName) && isset($pickAdress) && isset($pickZip) && isset($pickVille) && isset($destName) && isset($destAdress) && isset($destZip) && isset($destVille)){
            $send = priseRdv($idUser, $idSoc, $rdvDate, $heure, $transportType, $transportKms, $raison, $ald, $pickName, $pickAdress, $pickZip, $pickVille, $destName, $destAdress, $destZip, $destVille);
            $sendEmail = emailRdv($idSoc);
            $message = 'success';
            header('location:../rdv.php?message=success');
        }
    }
}

function priseRdv($idUser, $idSoc, $rdvDate, $heure, $transportType, $transportKms, $raison, $ald, $pickName, $pickAdress, $pickZip, $pickVille, $destName, $destAdress, $destZip, $destVille){
    $db = connectBd();
    $priseRdv = $db->prepare("INSERT INTO `ambu_rdv` (`fk_user`, `rdv_date`, `heure`, `transport_type`, `transport_kms`, `rdv_raison`, `ald`, `pick_name`, `pick_adress`, `pick_zip`, `pick_ville`, `dest_name`, `dest_adress`, `dest_zip`, `dest_ville`, `fk_societe`) VALUES (:idUser, :rdvDate, :heure, :transportType, :transportKms, :raison, :ald, :pickName, :pickAdress, :pickZip, :pickVille, :destName, :destAdress, :destZip, :destVille, :idSoc)");
    $priseRdv->BindParam('idUser', $idUser, PDO::PARAM_INT);
    $priseRdv->BindParam('idSoc', $idSoc, PDO::PARAM_INT);
    $priseRdv->BindParam('rdvDate', $rdvDate, PDO::PARAM_STR);
    $priseRdv->BindParam('heure', $heure, PDO::PARAM_STR);
    $priseRdv->BindParam('transportType', $transportType, PDO::PARAM_INT);
    $priseRdv->BindParam('transportKms', $transportKms, PDO::PARAM_INT);
    $priseRdv->BindParam('raison', $raison, PDO::PARAM_INT);
    $priseRdv->BindParam('ald', $ald, PDO::PARAM_INT);
    $priseRdv->BindParam('pickName', $pickName, PDO::PARAM_STR);
    $priseRdv->BindParam('pickAdress', $pickAdress, PDO::PARAM_STR);
    $priseRdv->BindParam('pickZip', $pickZip, PDO::PARAM_INT);
    $priseRdv->BindParam('pickVille', $pickVille, PDO::PARAM_STR);
    $priseRdv->BindParam('destName', $destName, PDO::PARAM_STR);
    $priseRdv->BindParam('destAdress', $destAdress, PDO::PARAM_STR);
    $priseRdv->BindParam('destZip', $destZip, PDO::PARAM_INT);
    $priseRdv->BindParam('destVille', $destVille, PDO::PARAM_STR);
    $priseRdv->execute();
    return $priseRdv;
}

// envoie du rendez-vous par e-mail
function emailRdv($idSco){
        $db = connectBd();
        $infoSoc = $db->prepare("SELECT `societe_nom`, `societe_mail` FROM `ambu_site_societe` WHERE `id_societe` = $idSco");
        $infoSoc->execute();
        $getinfoSoc = $infoSoc->fetch(PDO::FETCH_ASSOC);
        $nom = $getinfoSoc['societe_nom'];
        $prenom = '';
        $emailPostulant = $getinfoSoc['societe_mail'];
        $body = 'Un rendez-vous à été demandé sur le site de '. $nom;
        $cvName = '';
        $cheminCv = '';
        $direction='rdv';
        $mailReception = 'site-web-ambulances@etoilesecours.com';
        $objet = 'Demande prise de rendez-vous';
        if(isset($nom) && isset($prenom) && isset($emailPostulant) && isset($body) && isset($cvName) && isset($cheminCv) && isset($mailReception) && isset($objet)){
            $candidatureSpontanne = array('direction'=>$direction, 'nom' => $nom, 'prenom' => $prenom, 'emailPostulant' => $emailPostulant, 'body' => $body, 'cvName' =>$cvName, 'cheminCv' => $cheminCv, 'mailReception' => $mailReception, 'objet' => $objet);
            $send = sendMail($candidatureSpontanne);
        }
}

//*********************** Traitement u RDV *********************

if(isset($_POST['traitement'])){
    $rdvId = checkFormulaire($_POST["rdv_id"]);
    if(isset($rdvId)){
        $send = traitementRdv($rdvId);
        $refresh = initSession($_SESSION['mail'], $_SESSION['mdp'], $_SESSION['id_societe']);
    }
}

function traitementRdv($rdvId){
    $db = connectBd();
    $traitementRdv = $db->prepare('UPDATE `ambu_rdv` SET `statut` = 1 WHERE `rdv_id` = :rdvId');
    $traitementRdv->BindParam('rdvId', $rdvId, PDO::PARAM_INT);
    $traitementRdv->execute();
    header('location:../rdv.php');
    return true;
}

// ******************* Les emplois *************************

// Mettre une annonce en ligne

if(isset($_POST['posterOffre'])){
    $idSociete = checkFormulaire($_POST["id_societe"]);
    $nomEmploi =  checkFormulaire($_POST["nom_emploi"]);
    $descriptionEmploi =  checkFormulaire($_POST["description_emploi"]);
    $obligatioEmploi =  checkFormulaire($_POST["obligation_emploi"]);
    $contrat =  checkFormulaire($_POST["contrat"]);
    $temps =  checkFormulaire($_POST["temps"]);
    $salaireHeure =  checkFormulaire($_POST["salaire_heure"]);
    if(isset($idSociete) && isset($nomEmploi) && isset($descriptionEmploi) && isset($obligatioEmploi) && isset($contrat) && isset($temps) && isset($salaireHeure)){
        $send = traitementOffre($idSociete, $nomEmploi, $descriptionEmploi, $obligatioEmploi, $contrat, $temps, $salaireHeure);
    }
}

function traitementOffre($idSociete, $nomEmploi, $descriptionEmploi, $obligatioEmploi, $contrat, $temps, $salaireHeure){
    $db = connectBd();
    $posterOffre = $db->prepare("INSERT INTO `ambu_emploi` (`nom_emploi`, `description_emploi`, `obligation_emploi`, `contrat`, `temps`, `salaire_heure`, `fk_societe`, `date`) VALUES (:nom_emploi, :description_emploi, :obligation_emploi, :contrat, :temps, :salaire_heure, :fk_societe, NOW())");
    $posterOffre->BindParam('nom_emploi', $nomEmploi, PDO::PARAM_STR);
    $posterOffre->BindParam('description_emploi', $descriptionEmploi, PDO::PARAM_STR);
    $posterOffre->BindParam('obligation_emploi', $obligatioEmploi, PDO::PARAM_STR);
    $posterOffre->BindParam('contrat', $contrat, PDO::PARAM_STR);
    $posterOffre->BindParam('temps', $temps, PDO::PARAM_INT);
    $posterOffre->BindParam('salaire_heure', $salaireHeure, PDO::PARAM_INT);
    $posterOffre->BindParam('fk_societe', $idSociete, PDO::PARAM_INT);
    $posterOffre->execute();
    header('location:../emploi.php');
    return true;
}

// Modifier une offre d'emploi
if(isset($_POST['modifierOffre'])){
    $emploiId = checkFormulaire($_POST['emploi_id']);
    $nomEmploi =  checkFormulaire($_POST["nom_emploi"]);
    $descriptionEmploi = checkFormulaire($_POST["description_emploi"]);
    if($_POST["obligation_emploi"] == ''){
        $obligatioEmploi = $_POST['old_obligation_emploi'];
    } else {
        $obligatioEmploi =  checkFormulaire($_POST["obligation_emploi"]);
    }
    $contrat =  checkFormulaire($_POST["contrat"]);
    $temps =  checkFormulaire($_POST["temps"]);
    $salaireHeure =  checkFormulaire($_POST["salaire_heure"]);
    if(isset($emploiId) && isset($nomEmploi) && isset($descriptionEmploi) && isset($obligatioEmploi) && isset($contrat) && isset($temps) && isset($salaireHeure)){
        $send = modifOffre($emploiId, $nomEmploi, $descriptionEmploi, $obligatioEmploi, $contrat, $temps, $salaireHeure);
    }
}
function modifOffre($emploiId, $nomEmploi, $descriptionEmploi, $obligatioEmploi, $contrat, $temps, $salaireHeure){
    $db = connectBd();
    $modifOffre = $db->prepare("UPDATE ambu_emploi SET nom_emploi = :nom_emploi, description_emploi = :description_emploi, obligation_emploi = :obligation_emploi, contrat = :contrat, temps = :temps, salaire_heure = :salaire_heure, `statut` = 1, `date` = NOW() WHERE emploi_id = :emploi_id");
    $modifOffre->BindParam('emploi_id', $emploiId, PDO::PARAM_INT);
    $modifOffre->BindParam('nom_emploi', $nomEmploi, PDO::PARAM_STR);
    $modifOffre->BindParam('description_emploi', $descriptionEmploi, PDO::PARAM_STR);
    $modifOffre->BindParam('obligation_emploi', $obligatioEmploi, PDO::PARAM_STR);
    $modifOffre->BindParam('contrat', $contrat, PDO::PARAM_STR);
    $modifOffre->BindParam('temps', $temps, PDO::PARAM_INT);
    $modifOffre->BindParam('salaire_heure', $salaireHeure, PDO::PARAM_INT);
    $modifOffre->execute();
    header('location:../emploi.php');
    return true;
}

// Enregistrer un postulant et son cv
if(isset($_POST['postulerOffre'])){
    $idEmploi = $_POST['emploi_id'];
    $nomPostulant = checkFormulaire($_POST['nom_postulant']);
    $prenomPostulant = checkFormulaire($_POST['prenom_postulant']);
    $mailPostulant = checkFormulaire($_POST['mail_postulant']);
    // vérification du cv
    $cv = $_FILES['cv'];
    $cvExtension = strtolower(substr($cv['name'], -4));
    $allowExtension = array(".pdf", "docx", ".doc");
    (!file_exists("../media/Postulant"))? mkdir("../media/Postulant"):"";
    if(in_array($cvExtension, $allowExtension) && $cv['size'] < 3000000){
        if($cvExtension == 'docx'){
            $cv['name'] = $_POST['emploi_id']."-cv-".checkFormulaire($_POST['nom_postulant'])."-".checkFormulaire($_POST['prenom_postulant']).".".$cvExtension;
        } else{
            $cv['name'] = $_POST['emploi_id']."-cv-".checkFormulaire($_POST['nom_postulant'])."-".checkFormulaire($_POST['prenom_postulant'])."".$cvExtension;
        }
        move_uploaded_file($cv['tmp_name'], "../media/Postulant/".$cv['name']);
        $cvName = $cv['name'];
        $formatcv = 'ok';
    }
    // vérification de la lettre de motivation
    $motivation = $_FILES['motivation'];
    $motivationExtension = strtolower(substr($motivation['name'], -4));
    if(strlen($_FILES['motivation']['name'])>0){
        if(in_array($motivationExtension, $allowExtension) && $motivation['size'] < 3000000){
            if($motivationExtension == 'docx'){
                $motivation['name'] = $_POST['emploi_id']."-motivation-".checkFormulaire($_POST['nom_postulant'])."-".checkFormulaire($_POST['prenom_postulant']).".".$motivationExtension;
            } else{
                $motivation['name'] = $_POST['emploi_id']."-motivation-".checkFormulaire($_POST['nom_postulant'])."-".checkFormulaire($_POST['prenom_postulant']).".".$motivationExtension;
            }
            move_uploaded_file($motivation['tmp_name'], "../media/Postulant/".$motivation['name']);
            $motivationName = $motivation['name'];
            $formatmotivation = 'ok';
        }
    } else{
            $formatmotivation = 'ok';
            $motivationName = '';
    }
    if($formatcv == 'ok' && $formatmotivation == 'ok'){
        if(isset($idEmploi) && isset($nomPostulant) && isset($prenomPostulant) && isset($mailPostulant) && isset($cvName)){
            $send = addPostulant($idEmploi, $nomPostulant, $prenomPostulant, $mailPostulant, $cvName, $motivationName);
            var_dump($motivationName);
        }
    } else {
        if($formatmotivation == 'ok'){
            ($cv['size'] < 1000000)? header("location:../emploi.php?message=errorcv"): header("location:../emploi.php?message=errortaille");
        } else {
            ($motivation['size'] < 3000000)? header("location:../emploi.php?message=errormotivation"): header("location:../emploi.php?message=errortaille");
        }
    }
}

function addPostulant($idEmploi, $nomPostulant, $prenomPostulant, $mailPostulant, $cvName, $motivationName){
    $db = connectBd();
    $addPostulant = $db->prepare("INSERT INTO `ambu_postulant` (`postulant_id`, `fk_emploi`, `nom_postulant`, `prenom_postulant`, `mail_postulant`, `cv`, `motivation`) 
    VALUES (NULL, :fk_emploi, :nom_postulant, :prenom_postulant, :mail_postulant, :cv, :motivation);");
    $addPostulant->BindParam('fk_emploi', $idEmploi, PDO::PARAM_INT);
    $addPostulant->BindParam('nom_postulant', $nomPostulant, PDO::PARAM_STR);
    $addPostulant->BindParam('prenom_postulant', $prenomPostulant, PDO::PARAM_STR);
    $addPostulant->BindParam('mail_postulant', $mailPostulant, PDO::PARAM_STR);
    $addPostulant->BindParam('cv', $cvName, PDO::PARAM_STR);
    $addPostulant->BindParam('motivation', $motivationName, PDO::PARAM_STR);
    $addPostulant->execute();
    header('location:../emploi.php');
    return true;
}


ob_end_flush();