<?php
if(!isset($_SESSION)){ 
    session_start(); 
} 
require "inscription.php";

function feedsite(){
    $db = connectBd();
    $getSocNom = $db->prepare("SELECT dossier FROM ambu_site_societe");
    $getSocNom->execute();
    $socFullNom = $getSocNom->fetchAll(PDO::FETCH_ASSOC);
    for($i=0; $i<sizeof($socFullNom) ;$i++){
        $socFullNom[$i] = ($socFullNom[$i]['dossier']);
    }
    return $socFullNom;
}

if (isset($_POST['identification'])){
    $email = checkFormulaire($_POST["email"]);
    $mdp = checkFormulaire($_POST["mdp"]);
    $mdpCrypted = hash('sha256', $mdp);
    $idSoc = $_SESSION['id_societe'];
    if(isset($email) && isset($mdpCrypted)){
        $send = connexion($email, $mdpCrypted, $idSoc);
    } 
}

function connexion($email, $mdpCrypted, $idSoc){
    $sessionInit = initSession($email, $mdpCrypted, $idSoc);
    $user = $sessionInit['profil'];
    if($user == 0 || $user == 1 || $user == 2 || $user == 4){
        header("location:../index.php");
    }
    if ($user == 3){
        header("location:../emploi.php");
    }
}

function getWebsite($data){
    $nomAmbulance = substr(basename($data), 10);
    if(in_array($nomAmbulance, feedsite())){
        $db = connectBd();
        $getSocinfos = $db->prepare("SELECT * FROM ambu_site_societe WHERE `dossier` = '$nomAmbulance'");
        $getSocinfos->execute();
        $dataSoc = $getSocinfos->fetch(PDO::FETCH_ASSOC);
    }
    return $dataSoc;
}
