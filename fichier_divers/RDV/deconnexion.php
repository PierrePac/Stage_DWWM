<?php
session_start();//session_start() nous permet ici d'appeler toutes les sessions actives de l'utilisateur, enregistrées avec $_SESSION['nom_que_vous_souhaitez']
require 'header.php';
unset($_SESSION['mail']);//unset() détruit une variable, si vous enregistrez aussi l'id du membre (par exemple) vous pouvez comme avec isset(), mettre plusieurs variables séparés par une virgule:
//unset($_SESSION['mail'],$_SESSION['id']);

header("Refresh: 3; url=./");//redirection vers le formulaire de connexion dans 5 secondes
echo "<div class=\"mt-5\"><h3 class=\"mt-5\">Vous avez été correctement déconnecté du site !</h3></div>.<br><br><i>Redirection en cours, vers la page d'accueil...</i>";

?>

<?php
require 'footer.php';
?>