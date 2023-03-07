<?php
require 'header.php';

?>


<?php
//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
if (isset($_POST['valider'])) {
	//vérifie si tous les champs sont bien  pris en compte:
	//on peut combiner isset() pour valider plusieurs champs à la fois
	if (!isset($_POST['nom'], $_POST['mdp'], $_POST['mail'])) {
		echo "Un des champs n'est pas reconnu.";
	} else {
		//on vérifie le contenu de tous les champs, savoir si ils sont correctement remplis avec les types de valeurs qu'on souhaitent qu'ils aient
		if (!preg_match("#^[a-zA-Z]{1,15}$#", $_POST['nom'])) {
			//la preg_match définie: ^ et $ pour dire commence et termine par notre masque;
			//notre masque défini a-z pour toutes les lettres en minuscules et 0-9 pour tous les chiffres;
			//d'une longueur de 1 min et 15 max
			echo "Le nom est incorrect, doit contenir seulement des lettres minuscules et/ou majuscules, d'une longueur minimum de 1 caractère et de 15 maximum.";
			//Il est préférable que le nom soit en lettres minuscules ceci afin d'être unique, par exemple si le choix peut être avec majuscule, deux membres pourrait avoir le même nom, par exemple Admin et admin et ce n'est pas ce que l'on veut.
		} else {
			//on vérifie le mot de passe:
			if (strlen($_POST['mdp']) < 5 or strlen($_POST['mdp']) > 15) {
				echo "Le mot de passe doit être d'une longueur minimum de 5 caractères et de 15 maximum.";
			} else {
				//on vérifie que l'adresse est correcte:
				if (!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,30}$#i", $_POST['mail'])) {
					//cette preg_match est un petit peu complexe, je vous invite à regarder l'explication détaillée sur mon site c2script.com
					echo "L'adresse mail est incorrecte.";
					//normalement l'input type="email" vérifie que l'adresse mail soit correcte avant d'envoyer le formulaire mais il faut toujours être prudent et vérifier côté serveur (ici) avant de valider définitivement
				} else {
					if (strlen($_POST['mail']) < 7 or strlen($_POST['mail']) > 50) {
						echo "Le mail doit être d'une longueur minimum de 7 caractères et de 50 maximum.";
					} else {
						//tout est précisés correctement, on inscrit le membre dans la base de données si le nom n'est pas déjà utilisé par un autre utilisateur
						//d'abord il faut créer une connexion à la base de données dans laquelle on souhaite l'insérer:
						$mysqli = mysqli_connect('localhost', 'root', '', 'ambulancesrdv'); //'serveur','nom d'utilisateur','pass','nom de la table'
						if (!$mysqli) {
							echo "Erreur connexion BDD";
							//Dans ce script, je pars du principe que les erreurs ne sont pas affichées sur le site, vous pouvez donc voir qu'elle erreur est survenue avec mysqli_error(), pour cela décommentez la ligne suivante:
							//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
						} else {
							$nom = htmlentities($_POST['nom'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
							$prenom = htmlentities($_POST['prenom'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
							$adress = htmlentities($_POST['adress'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
							$zip = htmlentities($_POST['zip'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
							$ville = htmlentities($_POST['ville'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
							$tel = htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
							$mail = htmlentities($_POST['mail'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
							$mdp = md5($_POST['mdp']); // la fonction md5() convertie une chaine de caractères en chaine de 32 caractères d'après un algorithme PHP, cf doc
							$profil = '0'; //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
							$date = htmlentities($_POST['anniv']); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format

							if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM utilisateur WHERE mail='$mail'")) != 0) { //si mysqli_num_rows retourne pas 0
								echo "Ce mail est déjà utilisé par un autre membre, veuillez en choisir un autre svp.";
							} else {
								//insertion du membre dans la base de données:
								if (mysqli_query($mysqli, "INSERT INTO utilisateur SET nom='$nom', prenom='$prenom', adress='$adress', zip='$zip', ville='$ville', tel='$tel', mail='$mail', mdp='$mdp', profil='$profil', anniv='$date'")) {
									echo "Inscrit avec succès! Vous pouvez vous connecter: <a href='connexion.php'>Cliquez ici</a>.";
									$TraitementFini = true; //pour cacher le formulaire
									header('location:connexion.php');
								} else {
									echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
									//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
								}
							}
						}
					}
				}
			}
		}
	}
}
if (!isset($TraitementFini)) { //quand le membre sera inscrit, on définira cette variable afin de cacher le formulaire
?>
	<div class="container-xl">
		<div class="row mt-5">
			<div class="col-3 mt-5">
				<img class="img-fluid" src="img/urgence.jpg" alt="">
			</div>
			<div class="col-9 mt-5">
				<h2>Je m'inscris :</h2>
				<form action="inscription.php" method="post">
					<label for="basic-url" class="form-label">Identité :</label>
					<div class="input-group mb-3">
						<span class="input-group-text bg-primary text-white" id="basic-addon1">Nom :</span>
						<input type="text" class="form-control" name="nom" placeholder="Nom ..." aria-label="Nom" aria-describedby="basic-addon1" required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
						<span class="input-group-text bg-primary text-white" id="basic-addon2">Prénom :</span>
						<input type="text" class="form-control" name="prenom" placeholder="Prénom ..." aria-label="Prénom" aria-describedby="basic-addon2" required>
					</div>
					<label for="basic-url" class="form-label">Adresse :</label>
					<div class="input-group mb-3">
						<span class="input-group-text bg-primary text-white" id="basic-addon3">Numéro, voie, lieu-dit :</span>
						<input type="text" class="form-control" name="adress" placeholder="mon adresse ..." aria-label="Nom" aria-describedby="basic-addon3" required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text bg-primary text-white" id="basic-addon3">Code postal :</span>
						<input type="number" class="form-control" name="zip" placeholder="Code postal ..." aria-label="Code postal" aria-describedby="basic-addon3" required>
						<span class="input-group-text bg-primary text-white" id="basic-addon4">Ville :</span>
						<input type="text" class="form-control" name="ville" placeholder="Ville ..." aria-label="Ville" aria-describedby="basic-addon4" required>
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text bg-primary text-white" id="basic-addon5">Je souhaite être rappelé au :</span>
						<input type="number" class="form-control" name="tel" placeholder="Numéro de téléphone ..." aria-label="Numéro de téléphone" aria-describedby="basic-addon5" required>
						<span class="input-group-text bg-primary text-white" id="basic-addon6">Date de naissance :</span>
						<input type="date" class="form-control" name="anniv" aria-describedby="basic-addon6" required>
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text bg-primary text-white" id="basic-addon7">Mon adresse :</span>
						<input type="email" class="form-control" name="mail" placeholder="Mail ..." aria-label="eMail" aria-describedby="basic-addon7" required>
						<span class="input-group-text bg-primary text-white" id="basic-addon8">Mot de passe :</span>
						<input type="password" class="form-control" name="mdp" aria-describedby="basic-addon8" required>
					</div>
					<div class="mx-auto">
						<div class="col-12 text-center form-check">
							<input class="" type="checkbox" value="" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								A partir du moment ou je valide et envoie le formulaire, c'est que j'ai lu et accèpté les conditions générales d'utilisation.
							</label>
						</div>
						<div class="col-12 text-center">
							<input class="btn bg-primary mt-3" type="submit" name="valider" value="Cliquez ici pour envoyer le formulaire">
						</div>
						<div class="col-12 text-center">
							<a class="nav-link" href="connexion.php">J'ai déjà un compte, je m'y connecte.</a>
						</div>
					</div>
				</form>
			</div>

		</div>

	</div>
<?php
}
?>

<?php
require 'footer.php';
?>