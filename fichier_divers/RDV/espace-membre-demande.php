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
<?php require 'header-membre.php';
?>



<?php
//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
if (isset($_POST['valider1'])) {

	$user_id = $info['user_id']; //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	$rdv_date = htmlentities($_POST['rdv_date']); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	$heure = htmlentities($_POST['heure']); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format

	$transport_type = htmlentities($_POST['transport_type']); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	$transport_kms = htmlentities($_POST['transport_kms']); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	$rdv_raison = htmlentities($_POST['rdv_raison']); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	$ald = htmlentities($_POST['ald']); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	//Adresse de prise en charge
	$pick_name = htmlentities($_POST['pick_name'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	$pick_adress = htmlentities($_POST['pick_adress'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	$pick_zip = htmlentities($_POST['pick_zip']); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	$pick_ville = htmlentities($_POST['pick_ville'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	//Adresse de destination
	$dest_name = htmlentities($_POST['dest_name'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	$dest_adress = htmlentities($_POST['dest_adress'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	$dest_zip = htmlentities($_POST['dest_zip']); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	$dest_ville = htmlentities($_POST['dest_ville'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
	$statut = 0;
	$req = $bdd->exec("INSERT INTO rdv SET fk_user='$user_id', rdv_date='$rdv_date', heure='$heure', transport_type='$transport_type', transport_kms='$transport_kms', rdv_raison='$rdv_raison', ald='$ald' , pick_name='$pick_name', pick_adress='$pick_adress',  pick_zip='$pick_zip', pick_ville='$pick_ville', dest_name='$dest_name', dest_adress='$dest_adress',  dest_zip='$dest_zip', dest_ville='$dest_ville', statut=$statut");
}
if (!isset($TraitementFini)) { //quand le membre sera inscrit, on définira cette variable afin de cacher le formulaire
?>

	<br><br>

	<div class="container-fluid mt-5 m-3">
		<form class="" method="post" action="espace-membre-demande.php">
			<div class="row">
				<div class="col-lg-6">
					<h2 class="text-primary">Remplir tous les champs :</h2>
				</div>
				<div class="col-lg-6"></div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<div class="input-group">
						<span class="input-group-text bg-primary text-white">Heure du RDV :</span>
						<input type="time" class="form-control" name="heure" step="" required>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="input-group">
						<span class="input-group-text bg-primary text-white">Date du RDV :</span>
						<input type="hidden" name="fk_user" value="<?= $info['user_id']; ?>" required><!-- On récupère l'ID user pour le renvoyer en fk_user de la table rdv / required permet d'empêcher l'envoi du formulaire si le champ est vide -->
						<input type="date" class="form-control" name="rdv_date" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2">
					<h5>Type de transport :</h5>
				</div>
				<div class="col-lg-2">
					<input type="radio" name="transport_type" id="assis" value="0">
					<label for="assis">Transport assis</label>
				</div>
				<div class="col-lg-2">
					<input type="radio" name="transport_type" id="couche" value="1">
					<label for="couche">Transport couché</label>
				</div>
				<div class="col-lg-6"></div>
			</div>
			<div class="row">
				<div class="col-lg-2">
					<h5>Distance à parcourir :</h5>
				</div>
				<div class="col-lg-2">
					<input type="radio" name="transport_kms" id="moins" value="0">
					<label for="moins">jusqu'à 150 kms.</label>
				</div>
				<div class="col-lg-2">
					<input type="radio" name="transport_kms" id="plus" value="1">
					<label for="plus">151 kms et plus.</label>
				</div>
				<div class="col-lg-6"></div>
			</div>
			<div class="row">
				<div class="col-lg-2">
					<h5>Raison :</h5>
				</div>
				<div class="col-lg-2">
					<input type="radio" name="rdv_raison" id="consult" value="0">
					<label for="consult">Consultation</label>
				</div>
				<div class="col-lg-2">
					<input type="radio" name="rdv_raison" id="hospi_jour" value="1">
					<label for="hospi_jour">Hospitalisation de jour</label>
				</div>
				<div class="col-lg-2">
					<input type="radio" name="rdv_raison" id="hospi" value="2">
					<label for="hospi">Hospitalisation de plus de 12h</label>
				</div>
				<div class="col-lg-2">
					<input type="radio" name="rdv_raison" id="sortie" value="3">
					<label for="sortie">Sortie d'hospitalisation</label>
				</div>
				<div class="col-lg-2"></div>
			</div>
			<div class="row">
				<div class="col-lg-2">
					<h5>Affection de longue durée :</h5>
				</div>
				<div class="col-lg-2">
					<input type="radio" name="ald" id="oui" value="0">
					<label for="oui">Concerne une ALD</label>
				</div>
				<div class="col-lg-2">
					<input type="radio" name="ald" id="non" value="1">
					<label for="non">Ne concerne pas une ALD</label>
				</div>
				<div class="col-lg-6"></div>
			</div>

			<div class="row align-items-center">
				<div class="col-sm-6  ">
					<h5 class="text-info">Lieu de prise en charge :</h5>
					<div class="input-group">
						<span class="input-group-text bg-info text-white">Lieu :</span>
						<input type="text" class="form-control" name="pick_name" placeholder="Maison / Praticien / Hopital">
						<div class="input-group">
							<span class="input-group-text bg-info text-white">Numéro, voie, lieu-dit :</span>
							<input type="text" class="form-control" name="pick_adress" placeholder="Adresse de prise en charge" size="100">
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-text bg-info text-white">C.P. :</span>
						<input type="number" class="form-control" name="pick_zip" placeholder="Code postal..." required>
						<span class="input-group-text bg-info text-white">Ville :</span>
						<input type="text" class="form-control" name="pick_ville" placeholder="Ville..." required>
					</div>
				</div>

				<div class="col-sm-6  ">
					<h5 class="text-success">Destination :</h5>
					<div class="input-group">
						<span class="input-group-text bg-success text-white">Lieu :</span>
						<input type="text" class="form-control" name="dest_name" placeholder="Hopital / Praticien / Maison">
						<div class="input-group">
							<span class="input-group-text bg-success text-white">Numéro, voie, lieu-dit :</span>
							<input type="text" class="form-control" name="dest_adress" placeholder="Adresse de destination" size="100">

						</div>
					</div>
					<div class="input-group">
						<span class="input-group-text bg-success text-white">C.P. :</span>
						<input type="number" class="form-control" name="dest_zip" placeholder="Code postal..." required>
						<span class="input-group-text bg-success text-white">Ville :</span>
						<input type="text" class="form-control" name="dest_ville" placeholder="Ville..." required>
					</div>
				</div>
			</div>
			<div class="d-grid gap-2 d-md-flex justify-content-md-center">
				<input class="btn btn-primary mx-auto" type="submit" name="valider1" value="Cliquez ici pour envoyer le formulaire">
			</div>
		</form>
	</div>

	<hr>


<?php
}
?>



<?php
require 'footer.php';
?>