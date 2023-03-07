<?php
if(!isset($_SESSION)){ 
    session_start(); 
} 

require 'bdd.php';


function checkFormulaire ($data){
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    $data = htmlentities($data);
    return $data;
}

// insert formulaire inscription
function inscription ($nom, $prenom, $adresse, $zip, $ville, $tel, $dob, $email, $mdpCrypted, $idSoc){
    $db = connectBd();
    $inscription = $db->prepare("INSERT INTO `ambu_utilisateur` (`user_id`, `nom`, `prenom`, `adress`, `zip`, `ville`, `tel`, `mail`, `mdp`, `profil`, `anniv`, `fk_societe`) VALUES (NULL, :nom, :prenom, :adresse, :zip, :ville, :tel, :email, :mdpCrypted, '0', :dob, :idSoc)");
    $inscription->BindParam('nom',$nom,PDO::PARAM_STR);
    $inscription->BindParam('prenom',$prenom,PDO::PARAM_STR);
    $inscription->BindParam('adresse',$adresse,PDO::PARAM_STR);
    $inscription->BindParam('zip',$zip,PDO::PARAM_INT);
    $inscription->BindParam('ville',$ville,PDO::PARAM_STR);
    $inscription->BindParam('tel',$tel,PDO::PARAM_INT);
    $inscription->BindParam('dob',$dob);
    $inscription->BindParam('email',$email,PDO::PARAM_STR);
    $inscription->BindParam('mdpCrypted',$mdpCrypted,PDO::PARAM_STR);
    $inscription->BindParam('idSoc',$idSoc,PDO::PARAM_INT);
    $inscription -> execute();
    header('location:../index.php');
}

// initialisation de la session
function initSession($email, $mdpCrypted, $idSoc){
    $db = connectBd();
    $sessionInit = $db->prepare("SELECT * FROM ambu_utilisateur LEFT JOIN ambu_site_societe 
    ON ambu_site_societe.id_societe = `fk_societe` WHERE (`mail` = :email AND `mdp` = :mdpCrypted 
    AND `fk_societe` = :idSoc) OR (`mail` = :email AND `mdp` = :mdpCrypted AND `fk_societe` IS NULL)");
    $sessionInit->bindParam('email', $email,PDO::PARAM_STR);
    $sessionInit->bindParam('mdpCrypted', $mdpCrypted,PDO::PARAM_STR);
    $sessionInit->bindParam('idSoc', $idSoc,PDO::PARAM_INT);
    $sessionInit->execute();
    $dataSession = $sessionInit->fetch(PDO::FETCH_ASSOC);
    if($sessionInit->rowCount()==1){
        if($dataSession['profil'] !== 1){
            $_SESSION['logged'] = true;
            $_SESSION['user_id'] = $dataSession['user_id'];
            $_SESSION['nom'] = $dataSession['nom'];
            $_SESSION['prenom'] = $dataSession['prenom'];
            $_SESSION['adress'] = $dataSession['adress'];
            $_SESSION['zip'] = $dataSession['zip'];
            $_SESSION['ville'] = $dataSession['ville'];
            $_SESSION['tel'] = $dataSession['tel'];
            $_SESSION['mail'] = $dataSession['mail'];
            $_SESSION['mdp'] = $dataSession['mdp'];
            $_SESSION['profil'] = $dataSession['profil'];
            $_SESSION['anniv'] = $dataSession['anniv'];
            $_SESSION['fk_societe'] = $dataSession['fk_societe'];
            $_SESSION['societe_nom'] = $dataSession['societe_nom'];
        }
        if($dataSession['profil'] == 1){
            $_SESSION['logged'] = true;
            $_SESSION['user_id'] = $dataSession['user_id'];
            $_SESSION['nom'] = $dataSession['nom'];
            $_SESSION['prenom'] = $dataSession['prenom'];
            $_SESSION['adress'] = $dataSession['adress'];
            $_SESSION['zip'] = $dataSession['zip'];
            $_SESSION['ville'] = $dataSession['ville'];
            $_SESSION['tel'] = $dataSession['tel'];
            $_SESSION['mail'] = $dataSession['mail'];
            $_SESSION['mdp'] = $dataSession['mdp'];
            $_SESSION['profil'] = $dataSession['profil'];
            $_SESSION['anniv'] = $dataSession['anniv'];
            $_SESSION['id_societe'] = $dataSession['id_societe'];
            $_SESSION['societe_nom'] = $dataSession['societe_nom'];
            $_SESSION['societe_createur'] = $dataSession['societe_createur'];
            $_SESSION['date_creation'] = $dataSession['date_creation'];
            $_SESSION['societe_adress'] = $dataSession['societe_adress'];
            $_SESSION['societe_zip'] = $dataSession['societe_zip'];
            $_SESSION['societe_ville'] = $dataSession['societe_nom'];
            $_SESSION['societe_tel'] = $dataSession['societe_tel'];
            $_SESSION['societe_mail'] = $dataSession['societe_mail'];
            $_SESSION['story_1'] = $dataSession['story_1'];
            $_SESSION['story_2'] = $dataSession['story_2'];
            $_SESSION['img_1'] = $dataSession['img_1'];
            $_SESSION['img_2'] = $dataSession['img_2'];
            $_SESSION['img_3'] = $dataSession['img_3'];
            $_SESSION['slider_1'] = $dataSession['slider_1'];
            $_SESSION['slider_2'] = $dataSession['slider_2'];
            $_SESSION['slider_3'] = $dataSession['slider_3'];
            $_SESSION['logo'] = $dataSession['logo'];
            $_SESSION['map'] = $dataSession['map'];
            $_SESSION['template_id'] = $dataSession['template_id'];
        }
    }
    return $_SESSION;
}


// check data
if (isset($_POST['inscription'])){
    $idSoc = $_SESSION['id_societe'];
    $nom =  checkFormulaire($_POST["nom"]);
    $prenom = checkFormulaire($_POST["prenom"]);
    $adresse = checkFormulaire($_POST["adresse"]);
    $zip = checkFormulaire($_POST["zip"]);
    $ville = checkFormulaire($_POST["ville"]);
    $tel = checkFormulaire($_POST["tel"]);
    $dob = checkFormulaire($_POST["dob"]);
    $email = checkFormulaire($_POST["email"]);
    $mdp = checkFormulaire($_POST["mdp"]);
    $verifMdp = checkFormulaire($_POST["verifMdp"]);
    $mdpCrypted = hash('sha256', $mdp);
    if(isset($nom) && isset($prenom) && isset($adresse) && isset($zip) && isset($ville) && isset($tel) && isset($dob) && isset($email) && isset($mdp) && $mdp == $verifMdp){
        $send = inscription($nom, $prenom, $adresse, $zip, $ville, $tel, $dob, $email, $mdpCrypted, $idSoc);
        $send = initSession($email, $mdpCrypted, $idSoc);
    }
}
