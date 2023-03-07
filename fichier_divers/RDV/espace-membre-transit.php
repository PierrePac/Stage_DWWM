<?php
session_start();
require 'bdd.php';

if (!isset($_SESSION['mail'])) {
	header("Refresh: 5; url=connexion.php"); //redirection vers le formulaire de connexion dans 5 secondes
	echo "Vous devez vous connecter pour accéder à l'espace membre.<br><br><i>Redirection en cours, vers la page de connexion...</i>";
	exit(0); //on arrête l'éxécution du reste de la page avec exit, si le membre n'est pas connecté
}
$mail = $_SESSION['mail']; //on défini la variable $mail (Plus simple à écrire que $_SESSION['mail']) pour pouvoir l'utiliser plus bas dans la page

//on se connecte une fois pour toutes les actions possible de cette page:

if (!$mysqli) {
	echo "Erreur connexion BDD";
	//Dans ce script, je pars du principe que les erreurs ne sont pas affichées sur le site, vous pouvez donc voir qu'elle erreur est survenue avec mysqli_error(), pour cela décommentez la ligne suivante:
	//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
	exit(0);
}

if ($_POST['valider'] && ($_POST['mdp'] !='')) {
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $adress=$_POST['adress'];
    $zip=$_POST['zip'];
    $ville=$_POST['ville'];
    $tel=$_POST['tel'];
    $mail=$_POST['mail'];
    $anniv=$_POST['anniv'];
    $mdp=$_POST['mdp'];
    mysqli_query($mysqli, "UPDATE utilisateur SET nom='$nom', prenom='$prenom', adress='$adress', zip='$zip', ville='$ville', tel='$tel', mail='$mail', anniv='$anniv', mdp='$mdp' WHERE mail='$mail'");
    header('location:espace-membre-update.php');
    die;
} elseif ($_POST['valider'] && ($_POST['mdp'] =='')) {
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $adress=$_POST['adress'];
    $zip=$_POST['zip'];
    $ville=$_POST['ville'];
    $tel=$_POST['tel'];
    $mail=$_POST['mail'];
    $anniv=$_POST['anniv'];
    $mdp=$_POST['mdp'];
    mysqli_query($mysqli, "UPDATE utilisateur SET nom='$nom', prenom='$prenom', adress='$adress', zip='$zip', ville='$ville', tel='$tel', mail='$mail', anniv='$anniv' WHERE mail='$mail'");
    header('location:espace-membre-update.php');
    die;
}



?>