<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "inscription.php";

// traitement de la candidature spontannéé
if (isset($_POST['postulerSpontanneOffre'])) {
    require "captcha.php";
    verifCaptcha($_POST['g-recaptcha-response']);
    if ($sendEmail = 1) {
        $direction = $_POST['direction'];
        $nom = checkFormulaire($_POST['nom_postulant']);
        $prenom = checkFormulaire($_POST['prenom_postulant']);
        $emailPostulant = checkFormulaire($_POST['mail_postulant']);
        $body = 'Candidature spontannée de ' . $prenom . ' ' . $nom . '. CV en pièce Jointe';
        // vérification du cv
        $cv = $_FILES['cv'];
        $cvExtension = strtolower(substr($cv['name'], -4));
        $allowExtension = array(".pdf", "docx", ".doc");
        if (in_array($cvExtension, $allowExtension) && $cv['size'] < 3000000) {
            if ($cvExtension == 'docx') {
                $cv['name'] = $_POST['emploi_id'] . "-cv-" . checkFormulaire($_POST['nom_postulant']) . "-" . checkFormulaire($_POST['prenom_postulant']) . "." . $cvExtension;
            } else {
                $cv['name'] = $_POST['emploi_id'] . "-cv-" . checkFormulaire($_POST['nom_postulant']) . "-" . checkFormulaire($_POST['prenom_postulant']) . "" . $cvExtension;
            }
            move_uploaded_file($cv['tmp_name'], "../media/cv/" . $cv['name']);
            $cvName = $cv['name'];
            $formatcv = 'ok';
        }
        $cheminCv = '../media/cv/' . $cv['name'];
        // vérification de la lettre de motivation
        $motivation = $_FILES['motivation'];
        $motivationExtension = strtolower(substr($motivation['name'], -4));
        $allowExtension = array(".pdf", "docx", ".doc");
        if(strlen($_FILES['motivation']['name'])>0){
            if (in_array($motivationExtension, $allowExtension) && $motivation['size'] < 3000000) {
                if ($motivationExtension == 'docx') {
                    $motivation['name'] = $_POST['emploi_id'] . "-motivation-" . checkFormulaire($_POST['nom_postulant']) . "-" . checkFormulaire($_POST['prenom_postulant']) . "." . $motivationExtension;
                } else {
                    $motivation['name'] = $_POST['emploi_id'] . "-motivation-" . checkFormulaire($_POST['nom_postulant']) . "-" . checkFormulaire($_POST['prenom_postulant']) . "" . $motivationExtension;
                }
                move_uploaded_file($motivation['tmp_name'], "../media/cv/" . $motivation['name']);
                $motivationName = $motivation['name'];
                $formatmotivation = 'ok';
            }
            $cheminMotivation = '../media/cv/' . $motivation['name'];
        } else {
            $formatmotivation = 'ok';
            $motivationName = '';
        }
        $mailReception = 'recrutement@ambu17.com';
        $objet = 'Candidature Spontannée';
        if($formatcv == 'ok' && $formatmotivation == 'ok'){
            if (isset($nom) && isset($prenom) && isset($emailPostulant) && isset($body) && isset($cvName) && isset($cheminCv) && isset($mailReception) && isset($objet)) {
                $candidatureSpontanne = array('direction'=>$direction,'nom' => $nom, 'prenom' => $prenom, 'emailPostulant' => $emailPostulant, 'body' => $body, 'cvName' => $cvName, 'cheminCv' => $cheminCv, 'motivationName' => $motivationName, 'cheminMotivation' => $cheminMotivation, 'mailReception' => $mailReception, 'objet' => $objet);
                $send = sendMail($candidatureSpontanne);
            }
        } else {
            if($formatmotivation == 'ok'){
                ($cv['size'] < 1000000)? header("location:../emploi.php?message=errorcv"): header("location:../emploi.php?message=errortaille");
            } else {
                ($motivation['size'] < 3000000)? header("location:../emploi.php?message=errormotivation"): header("location:../emploi.php?message=errortaille");
            }
        }
    }
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function sendMail($candidatureSpontanne)
{
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = 'smtp.ionos.fr';               //Adresse IP ou DNS du serveur SMTP
    $mail->Port = 25;                          //Port TCP du serveur SMTP
    $mail->SMTPAuth = 1;                        //Utiliser l'identification
    $mail->CharSet = 'UTF-8';
    $mail->smtpConnect();

    if ($mail->SMTPAuth) {
        $mail->SMTPSecure = 'SFTP';               //Protocole de sécurisation des échanges avec le SMTP
        $mail->Username   =  'm82748737-155394313';    //Adresse email à utiliser
        $mail->Password   =  'Bentley@17800';         //Mot de passe de l'adresse email à utiliser
    }

    $mail->From       = trim($candidatureSpontanne['emailPostulant']);                //L'email à afficher pour l'envoi
    $mail->FromName   = trim($candidatureSpontanne['nom']);          //L'alias de l'email de l'emetteur

    $mail->AddAddress($candidatureSpontanne['mailReception']);

    $mail->Subject    =  $candidatureSpontanne['objet'];                      //Le sujet du mail
    $mail->WordWrap   = 50;                    //Nombre de caracteres pour le retour a la ligne automatique
    $mail->Body = $candidatureSpontanne['body'];            //Texte brut
    $mail->AddAttachment($candidatureSpontanne['cheminMotivation'], $candidatureSpontanne['motivationName']);  //pièce jointes avec 2 propriété (le chemin sur le serveur et le nom)
    $mail->AddAttachment($candidatureSpontanne['cheminCv'], $candidatureSpontanne['cvName']); //pièce jointes avec 2 propriété (le chemin sur le serveur et le nom)
    $mail->IsHTML(false);                                  //Préciser qu'il faut utiliser le texte brut

    if (!$mail->send()) {
        echo $mail->ErrorInfo;
    } else {
        if ($candidatureSpontanne['direction'] == "emploi" ) {
            unlink($candidatureSpontanne['cheminMotivation']);
            unlink($candidatureSpontanne['cheminCv']);
            header("location:../emploi.php?message=success");
        }
    }
} ?>

