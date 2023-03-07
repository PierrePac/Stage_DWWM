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
//si "?creer" est dans l'URL
if (isset($_GET['creer'])) {
}
//si "?modifier" est dans l'URL:
if (isset($_GET['supprimer'])) {
	if ($_GET['supprimer'] != "ok") {
		echo "<p>Êtes-vous sûr de vouloir supprimer votre compte définitivement?</p>
				<br>
				<a href='espace-membre.php?supprimer=ok' style='color:red'>OUI</a> - <a href='espace-membre.php' style='color:green'>NON</a>";
	} else {
		//on supprime le membre avec "DELETE"
		if (mysqli_query($mysqli, "DELETE FROM utilisateur WHERE mail='$mail'")) {
			echo "Votre compte vient d'être supprimé définitivement.";
			unset($_SESSION['mail']); //on tue la session mail avec unset()
		} else {
			echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
			//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
		}
	}
}
//si "?modifier" est dans l'URL:
if (isset($_GET['modifier'])) {
?>
	<div class="container-xl">
		<div class="row mt-5">
			<div class="col-12 mt-5">
				<h1 class="mt-5">Modification du compte</h1>
				<a href="espace-membre.php"><button>Fermer la modification</button></a>
				<h2>Choisissez une option: </h2>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Nom</th>
							<th scope="col">Prenom</th>
							<th scope="col">Adresse</th>
							<th scope="col">Code postale</th>
							<th scope="col">Ville</th>
							<th scope="col">Téléphone</th>
							<th scope="col">eMail</th>
							<th scope="col">Date de naissance</th>
							<th scope="col">Mot de passe</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?= $info['nom']; ?></td>
							<td><?= $info['prenom']; ?></td>
							<td><?= $info['adress']; ?></td>
							<td><?= $info['zip']; ?></td>
							<td><?= $info['ville']; ?></td>
							<td><?= '0' . $info['tel']; ?></td>
							<td><?= $info['mail']; ?></td>
							<td><?= $info['anniv']; ?></td>
							<td><input type="password" name="mdp" value=""></td>
						</tr>
						<tr>
							<td><a href="espace-membre.php?modifier=nom">Corriger votre nom</a></td>
							<td><a href="espace-membre.php?modifier=prenom">Corriger votre prenom</a></td>
							<td><a href="espace-membre.php?modifier=adress">Corriger votre adress</a></td>
							<td><a href="espace-membre.php?modifier=zip">Corriger votre code postal</a></td>
							<td><a href="espace-membre.php?modifier=ville">Corriger votre ville</a></td>
							<td><a href="espace-membre.php?modifier=tel">Corriger votre téléphone</a></td>
							<td><a href="espace-membre.php?modifier=mail">Modifier l'adresse mail</a></td>
							<td><a href="espace-membre.php?modifier=anniv">Modifier votre date de naissance</a></td>
							<td><a href="espace-membre.php?modifier=mdp">Modifier le mot de passe</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
	<p>

		<br>

	</p>
	<hr />
	<?php
	if ($_GET['modifier'] == "mail") {
		echo "<p>Renseignez le formulaire ci-dessous pour modifier vos informations:</p>";
		if (isset($_POST['valider'])) {
			if (!isset($_POST['mail'])) {
				echo "Le champ mail n'est pas reconnu.";
			} else {
				if (!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,30}$#i", $_POST['mail'])) {
					//cette preg_match est un petit peu complexe, je vous invite à regarder l'explication détaillée sur mon site c2script.com
					echo "L'adresse mail est incorrecte.";
					//normalement l'input type="email" vérifie que l'adresse mail soit correcte avant d'envoyer le formulaire mais il faut toujours être prudent et vérifier côté serveur (ici) avant de valider définitivement
				} else {
					//tout est OK, on met à jours son compte dans la base de données:
					if (mysqli_query($mysqli, "UPDATE utilisateur SET mail='" . htmlentities($_POST['mail'], ENT_QUOTES, "UTF-8") . "' WHERE mail='$mail'")) {
						echo "Adresse mail {$_POST['mail']} modifiée avec succès!";
						$TraitementFini = true; //pour cacher le formulaire
					} else {
						echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
						//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
					}
				}
			}
		}
		if (!isset($TraitementFini)) {
	?>
			<br>
			<form method="post" action="espace-membre.php?modifier=mail">
				<input type="email" name="mail" value="<?php echo $info['mail']; ?>" required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
				<input type="submit" name="valider" value="Valider la modification">
			</form>
		<?php
		}
	} elseif ($_GET['modifier'] == "mdp") {
		echo "<p>Renseignez le formulaire ci-dessous pour modifier vos informations:</p>";
		//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
		if (isset($_POST['valider'])) {
			//vérifie si tous les champs sont bien pris en compte:
			if (!isset($_POST['nouveau_mdp'], $_POST['confirmer_mdp'], $_POST['mdp'])) {
				echo "Un des champs n'est pas reconnu.";
			} else {
				if ($_POST['nouveau_mdp'] != $_POST['confirmer_mdp']) {
					echo "Les mots de passe ne correspondent pas.";
				} else {
					$Mdp = md5($_POST['mdp']);
					$NouveauMdp = md5($_POST['nouveau_mdp']);
					$req = mysqli_query($mysqli, "SELECT * FROM utilisateur WHERE mail='$mail' AND mdp='$Mdp'");
					//on regarde si le mot de passe correspond à son compte:
					if (mysqli_num_rows($req) != 1) {
						echo "Mot de passe actuel incorrect.";
					} else {
						//tout est OK, on met à jours son compte dans la base de données:
						if (mysqli_query($mysqli, "UPDATE utilisateur SET mdp='$NouveauMdp' WHERE mail='$mail'")) {
							echo "Mot de passe modifié avec succès!";
							$TraitementFini = true; //pour cacher le formulaire
						} else {
							echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
							//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
						}
					}
				}
			}
		}
		if (!isset($TraitementFini)) {
		?>
			<br>
			<form method="post" action="espace-membre.php?modifier=mdp">
				<input type="password" name="nouveau_mdp" placeholder="Nouveau mot de passe..." required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
				<input type="password" name="confirmer_mdp" placeholder="Confirmer nouveau passe..." required>
				<input type="password" name="mdp" placeholder="Votre mot de passe actuel..." required>
				<input type="submit" name="valider" value="Valider la modification">
			</form>
		<?php
		}
	} elseif ($_GET['modifier'] == "nom") {
		echo "<p>Renseignez le formulaire ci-dessous pour modifier votre nom :</p>";
		//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
		if (isset($_POST['valider'])) {
			//vérifie si tous les champs sont bien pris en compte:
			if (!isset($_POST['nouveau_nom'])) {
				echo "Merci de remplir le champ.";
			} else {
				if ($_POST['nouveau_nom']) {
					$nom = htmlentities($_POST['nouveau_nom']);
					$req = mysqli_query($mysqli, "SELECT * FROM utilisateur WHERE mail='$mail'");
					//on regarde si le mot de passe correspond à son compte:

					//tout est OK, on met à jours son compte dans la base de données:
					if (mysqli_query($mysqli, "UPDATE utilisateur SET nom='$nom' WHERE mail='$mail'")) {
						echo "Nom modifié avec succès!";
						$TraitementFini = true; //pour cacher le formulaire
						header('location:espace-membre.php?modifier');
					} else {
						echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
						//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
					}
				}
			}
		}
		if (!isset($TraitementFini)) {
		?>
			<br>
			<form method="post" action="espace-membre.php?modifier=nom">
				<input type="text" name="nouveau_nom" value="<?php echo $info['nom']; ?>" required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
				<input type="submit" name="valider" value="Valider la modification">
			</form>
		<?php
		}
	} elseif ($_GET['modifier'] == "prenom") {
		echo "<p>Renseignez le formulaire ci-dessous pour modifier votre nom :</p>";
		//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
		if (isset($_POST['valider'])) {
			//vérifie si tous les champs sont bien pris en compte:
			if (!isset($_POST['nouveau_prenom'])) {
				echo "Merci de remplir le champ.";
			} else {
				if ($_POST['nouveau_prenom']) {
					$prenom = htmlentities($_POST['nouveau_prenom']);
					$req = mysqli_query($mysqli, "SELECT * FROM utilisateur WHERE mail='$mail'");
					//on regarde si le mot de passe correspond à son compte:

					//tout est OK, on met à jours son compte dans la base de données:
					if (mysqli_query($mysqli, "UPDATE utilisateur SET prenom='$prenom' WHERE mail='$mail'")) {
						echo "Nom modifié avec succès!";
						$TraitementFini = true; //pour cacher le formulaire
						header('location:espace-membre.php?modifier');
					} else {
						echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
						//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
					}
				}
			}
		}
		if (!isset($TraitementFini)) {
		?>
			<br>
			<form method="post" action="espace-membre.php?modifier=prenom">
				<input type="text" name="nouveau_prenom" value="<?php echo $info['prenom']; ?>" required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
				<input type="submit" name="valider" value="Valider la modification">
			</form>
		<?php
		}
	} elseif ($_GET['modifier'] == "adress") {
		echo "<p>Renseignez le formulaire ci-dessous pour modifier votre nom :</p>";
		//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
		if (isset($_POST['valider'])) {
			//vérifie si tous les champs sont bien pris en compte:
			if (!isset($_POST['nouveau_adress'])) {
				echo "Merci de remplir le champ.";
			} else {
				if ($_POST['nouveau_adress']) {
					$adress = htmlentities($_POST['nouveau_adress']);
					$req = mysqli_query($mysqli, "SELECT * FROM utilisateur WHERE mail='$mail'");
					//on regarde si le mot de passe correspond à son compte:

					//tout est OK, on met à jours son compte dans la base de données:
					if (mysqli_query($mysqli, "UPDATE utilisateur SET adress='$adress' WHERE mail='$mail'")) {
						echo "Nom modifié avec succès!";
						$TraitementFini = true; //pour cacher le formulaire
						header('location:espace-membre.php?modifier');
					} else {
						echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
						//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
					}
				}
			}
		}
		if (!isset($TraitementFini)) {
		?>
			<br>
			<form method="post" action="espace-membre.php?modifier=adress">
				<input type="text" name="nouveau_adress" value="<?php echo $info['adress']; ?>" required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
				<input type="submit" name="valider" value="Valider la modification">
			</form>
		<?php
		}
	} elseif ($_GET['modifier'] == "zip") {
		echo "<p>Renseignez le formulaire ci-dessous pour modifier votre nom :</p>";
		//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
		if (isset($_POST['valider'])) {
			//vérifie si tous les champs sont bien pris en compte:
			if (!isset($_POST['nouveau_zip'])) {
				echo "Merci de remplir le champ.";
			} else {
				if ($_POST['nouveau_zip']) {
					$zip = htmlentities($_POST['nouveau_zip']);
					$req = mysqli_query($mysqli, "SELECT * FROM utilisateur WHERE mail='$mail'");
					//on regarde si le mot de passe correspond à son compte:

					//tout est OK, on met à jours son compte dans la base de données:
					if (mysqli_query($mysqli, "UPDATE utilisateur SET zip='$zip' WHERE mail='$mail'")) {
						echo "Nom modifié avec succès!";
						$TraitementFini = true; //pour cacher le formulaire
						header('location:espace-membre.php?modifier');
					} else {
						echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
						//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
					}
				}
			}
		}
		if (!isset($TraitementFini)) {
		?>
			<br>
			<form method="post" action="espace-membre.php?modifier=zip">
				<input type="text" name="nouveau_zip" value="<?php echo $info['zip']; ?>" required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
				<input type="submit" name="valider" value="Valider la modification">
			</form>
		<?php
		}
	} elseif ($_GET['modifier'] == "tel") {
		echo "<p>Renseignez le formulaire ci-dessous pour modifier votre nom :</p>";
		//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
		if (isset($_POST['valider'])) {
			//vérifie si tous les champs sont bien pris en compte:
			if (!isset($_POST['nouveau_tel'])) {
				echo "Merci de remplir le champ.";
			} else {
				if ($_POST['nouveau_tel']) {
					$tel = htmlentities($_POST['nouveau_tel']);
					$req = mysqli_query($mysqli, "SELECT * FROM utilisateur WHERE mail='$mail'");
					//on regarde si le mot de passe correspond à son compte:

					//tout est OK, on met à jours son compte dans la base de données:
					if (mysqli_query($mysqli, "UPDATE utilisateur SET tel='$tel' WHERE mail='$mail'")) {
						echo "Nom modifié avec succès!";
						$TraitementFini = true; //pour cacher le formulaire
						header('location:espace-membre.php?modifier');
					} else {
						echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
						//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
					}
				}
			}
		}
		if (!isset($TraitementFini)) {
		?>
			<br>
			<form method="post" action="espace-membre.php?modifier=tel">
				<input type="text" name="nouveau_tel" value="<?php echo '0' . $info['tel']; ?>" required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
				<input type="submit" name="valider" value="Valider la modification">
			</form>
		<?php
		}
	} elseif ($_GET['modifier'] == "anniv") {
		echo "<p>Renseignez le formulaire ci-dessous pour modifier votre nom :</p>";
		//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
		if (isset($_POST['valider'])) {
			//vérifie si tous les champs sont bien pris en compte:
			if (!isset($_POST['nouveau_anniv'])) {
				echo "Merci de remplir le champ.";
			} else {
				if ($_POST['nouveau_anniv']) {
					$anniv = htmlentities($_POST['nouveau_anniv']);
					$req = mysqli_query($mysqli, "SELECT * FROM utilisateur WHERE mail='$mail'");
					//on regarde si le mot de passe correspond à son compte:

					//tout est OK, on met à jours son compte dans la base de données:
					if (mysqli_query($mysqli, "UPDATE utilisateur SET anniv='$anniv' WHERE mail='$mail'")) {
						echo "Nom modifié avec succès!";
						$TraitementFini = true; //pour cacher le formulaire
						header('location:espace-membre.php?modifier');
					} else {
						echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
						//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
					}
				}
			}
		}
		if (!isset($TraitementFini)) {
		?>
			<br>
			<form method="post" action="espace-membre.php?modifier=anniv">
				<input type="date" name="nouveau_anniv" value="<?php echo $info['anniv']; ?>" required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
				<input type="submit" name="valider" value="Valider la modification">
			</form>
<?php
		}
	}

	echo "";
}
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


	<div class="container-fluid">
		<div class="row mt-5">
			<div class="col-12 mt-5">
				<form method="post" action="espace-membre.php">
					<div class="row m-3">
						<div class="col-6">
							<h2 class="text-primary">Remplissez l'intégralité du formulaire pour une réservation :</h2>
						</div>
						<div class="col-6">
							<div class="input-group">
								<span class="input-group-text bg-primary text-white">Date du rendez-vous :</span>
								<input type="hidden" name="fk_user" value="<?= $info['user_id']; ?>" required><!-- On récupère l'ID user pour le renvoyer en fk_user de la table rdv / required permet d'empêcher l'envoi du formulaire si le champ est vide -->
								<input type="date" class="form-control" name="rdv_date" required>
								<span class="input-group-text bg-primary text-white">Heure du rendez-vous :</span>
								<input type="time" class="form-control" name="heure" step="" required>
							</div>
						</div>
					</div>


					<div class="row m-3">
						<div class="col-6">
							<div class="form-check">
								<h5>Type de transport :</h5>
								<input type="radio" name="transport_type" id="assis" value="0">
								<label for="assis">Transport assis</label>
								<input type="radio" name="transport_type" id="couche" value="1">
								<label for="couche">Transport couché</label>
							</div>
						</div>
						<div class="col-6">
							<div class="form-check">
								<h5>Distance à parcourir :</h5>
								<input type="radio" name="transport_kms" id="moins" value="0">
								<label for="moins">Distance jusqu'à 150 kms inclus.</label>
								<input type="radio" name="transport_kms" id="plus" value="1">
								<label for="plus">Distance supérieure à 150 kms.</label>
							</div>
						</div>
					</div>

					<div class="row m-3">
						<div class="col-6">
							<div class="form-check">
								<h5>Type de transport :</h5>
								<input type="radio" name="rdv_raison" id="consult" value="0">
								<label for="consult">Consultation</label>
								<input type="radio" name="rdv_raison" id="hospi_jour" value="1">
								<label for="hospi_jour">Hospitalisation de jour</label>
								<input type="radio" name="rdv_raison" id="hospi" value="2">
								<label for="hospi">Hospitalisation de plus de 12h</label>
								<input type="radio" name="rdv_raison" id="sortie" value="3">
								<label for="sortie">Sortie d'hospitalisation</label>
							</div>
						</div>
						<div class="col-6">
							<div class="form-check">
								<h5>Distance à parcourir :</h5>
								<input type="radio" name="ald" id="oui" value="0">
								<label for="oui">Soumis à une affection de longue durée</label>
								<input type="radio" name="ald" id="non" value="1">
								<label for="non">Non soumis à une affection de longue durée</label>
							</div>
						</div>
					</div>
					<!--input type="radio" name="" id="domicile" value="0">
						<label for="domicile">Domicile enregistré dans votre profil</label>
						<input type="radio" name="" id="autre" value="1">
						<label for="autre">Autre lieue</label>
						<br-->
					<div class="row align-items-center m-3 ">
						<div class="col-sm-6  ">
							<h5 class="text-info">Lieu de prise en charge :</h5>
							<div class="input-group p-3">
								<span class="input-group-text bg-info text-white">Où se situe la prise en charge :</span>
								<input type="text" class="form-control" name="pick_name" placeholder="Maison / Praticien / Hopital">
								<div class="input-group">
									<span class="input-group-text bg-info text-white">Numéro, voie, lieu-dit :</span>
									<input type="text" class="form-control" name="pick_adress" placeholder="Adresse de prise en charge" size="100">
								</div>
							</div>
							<div class="input-group p-3">
								<span class="input-group-text bg-info text-white">Code Postal :</span>
								<input type="number" class="form-control" name="pick_zip" placeholder="Code postal..." required>
								<span class="input-group-text bg-info text-white">Ville :</span>
								<input type="text" class="form-control" name="pick_ville" placeholder="Ville..." required>
							</div>
						</div>

						<div class="col-sm-6  ">
							<h5 class="text-success">Destination :</h5>
							<div class="input-group p-3">
								<span class="input-group-text bg-success text-white">Où se situe la prise en charge :</span>
								<input type="text" class="form-control" name="dest_name" placeholder="Hopital / Praticien / Maison">
								<div class="input-group">
									<span class="input-group-text bg-success text-white">Numéro, voie, lieu-dit :</span>
									<input type="text" class="form-control" name="dest_adress" placeholder="Adresse de destination" size="100">

								</div>
							</div>
							<div class="input-group p-3">
								<span class="input-group-text bg-success text-white">Code Postal :</span>
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
		</div>
	</div>

	<hr>


<?php
}
?>

</div>

<?php
require 'footer.php';
?>