<?php
session_start(); //session_start() combiné à $_SESSION (voir en fin de traitement du formulaire) nous permettra de garder le mail en sauvegarde pendant qu'il est connecté, si vous voulez que sur une page, le mail soit (ou tout autre variable sauvegardée avec $_SESSION) soit retransmis, mettez session_start() au début de votre fichier PHP, comme ici
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

//on récupère les infos du membre si on souhaite les afficher dans la page:
$req = mysqli_query($mysqli, "SELECT * FROM utilisateur WHERE mail='$mail'");
$info = mysqli_fetch_assoc($req);

//var_dump($info);

?>
<?php require 'header-regul.php';
?>

<?php
$conn=$bdd->query("SELECT * FROM rdv INNER JOIN utilisateur ON rdv.fk_user=utilisateur.user_id WHERE statut=1 ORDER BY rdv_id DESC");
$conn->execute(array());
$userData=$conn->fetchAll();
?>

<div class="row row-cols-1 row-cols-md-4 g-4 mx-auto mt-3">
    <?php foreach ($userData as $row) : ?>

        <div class="col">
            <div class="card bg-white mt-5">
                <div class="card-body">
                    <div class="">
                        <h4 class="text-success">Validé</h4>
                        <div class="col">
                            <span class="text-success">Nom du patient :</span>
                            <input type="text" name="" value="<?= $row['nom']; ?>" disabled>
                        </div>
                        <div class="col">
                            <span class="text-success">Prénom :</span>
                            <input type="text" name="" value="<?= $row['prenom']; ?>" disabled>
                        </div>
                        <div class="col">
                            <span class="text-success">Téléphone :</span>
                            <input type="number" name="" value="<?= '0'.$row['tel']; ?>" disabled>
                        </div>
                        <span class="text-success">Date :</span>
                        <input type="date" name="" value="<?= $row['rdv_date']; ?>" disabled>
                        <span class="text-success">Heure :</span>
                        <input type="time" name="" value="<?= $row['heure']; ?>" disabled>
                    </div>
                    <div class="col">
                        <span class="text-success">Type de transport :</span>
                        <input type="text" name="" value="<?php
                                                            if ($row['transport_type'] == 0) {
                                                                echo ('Assis');
                                                            } elseif ($row['transport_type'] == 1) {
                                                                echo ('Couché');
                                                            }; ?>" disabled>
                    </div>
                    <div class="col">
                        <span class="text-success">Raison transport :</span>
                        <!-- <input type="text" name="" value="<?= $row['rdv_raison']; ?>" disabled> -->
                        <input type="text" name="" value="<?php
                                                            if ($row['rdv_raison'] == 0) {
                                                                echo ('Consultation');
                                                            } elseif ($row['rdv_raison'] == 1) {
                                                                echo ('Hospitalisation de jour');
                                                            } elseif ($row['rdv_raison'] == 2) {
                                                                echo ('Hospitalisation de plus de 12h');
                                                            } elseif ($row['rdv_raison'] == 3) {
                                                                echo ('Sortie d\'hospitalisation');
                                                            }; ?>" disabled>
                    </div>
                    <div class="col">
                        <span class="text-success">150 kms :</span>
                        <input type="text" name="" value="<?php
                                                            if ($row['transport_kms'] == 0) {
                                                                echo ('Inférieur ou égal');
                                                            } elseif ($row['transport_kms'] == 1) {
                                                                echo ('Supérieur !');
                                                            }; ?>" disabled>

                    </div>
                    <div class="col">
                        <span class="text-success">Soumis à ALD :</span>
                        <input type="text" name="" value="<?php
                                                            if ($row['ald'] == 0) {
                                                                echo ('Oui');
                                                            } elseif ($row['ald'] == 1) {
                                                                echo ('Non');
                                                            }; ?>" disabled>
                    </div>
                    <div class="">
                        <h6>Prise en charge :</h6>
                        <div class="col">
                            <span class="text-success">Lieu :</span>
                            <input type="text" name="" value="<?= $row['pick_name']; ?>" disabled>
                        </div>
                        <div class="col">
                            <span class="text-success">Adresse :</span>
                            <input type="text" name="" value="<?= $row['pick_adress']; ?>" disabled>
                        </div>
                        <div class="col">
                            <span class="text-success">Code postal :</span>
                            <input type="number" name="" value="<?= $row['pick_zip']; ?>" disabled>
                        </div>
                        <div class="col">
                            <span class="text-success">Ville :</span>
                            <input type="text" name="" value="<?= $row['pick_ville']; ?>" disabled>
                        </div>
                    </div>
                    <div class="">
                        <h6>Destination :</h6>
                        <div class="col">
                            <span class="text-success">Lieu :</span>
                            <input type="text" name="" value="<?= $row['dest_name']; ?>" disabled>
                        </div>
                        <div class="col">
                            <span class="text-success">Adresse :</span>
                            <input type="text" name="" value="<?= $row['dest_adress']; ?>" disabled>
                        </div>
                        <div class="col">
                            <span class="text-success">Code postal :</span>
                            <input type="number" name="" value="<?= $row['dest_zip']; ?>" disabled>
                        </div>
                        <div class="col">
                            <span class="text-success">Ville :</span>
                            <input type="text" name="" value="<?= $row['dest_ville']; ?>" disabled>
                        </div>
                    </div>
                    <input type="hidden" name="" value="<?= $row['statut']; ?>" disabled>
                </div>
            </div>
        </div>




    <?php endforeach; ?>
</div>

<?php
require 'footer.php';
?>