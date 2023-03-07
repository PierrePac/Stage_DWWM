
<?php 
require 'bdd.php';
if (isset($_POST)) {
    $statut = $_POST['statut'];
    $rdv_id = $_POST['rdv_id'];
    $conn2 = $bdd->query("UPDATE rdv SET statut='$statut' WHERE rdv_id='$rdv_id'");
    header('location:espace-regul.php');
}
?>
