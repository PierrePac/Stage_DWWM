<?php
session_start(); //session_start() combiné à $_SESSION (voir en fin de traitement du formulaire) nous permettra de garder le mail en sauvegarde pendant qu'il est connecté, si vous voulez que sur une page, le mail soit (ou tout autre variable sauvegardée avec $_SESSION) soit retransmis, mettez session_start() au début de votre fichier PHP, comme ici
// require 'header.php';
?>


<?php
require 'header.php';
require 'bdd.php';
//si une session est déjà "isset" avec ce visiteur, on l'informe:
if (isset($_SESSION['mail'])) {
	//mail et mot de passe sont trouvé sur une même colonne, on ouvre une session:
	$mail = $_SESSION['mail'];


	//echo "Vous êtes connecté avec l'adresse mail : $mail ! Vous pouvez accéder à l'espace membre en <a href='espace-membre.php'>cliquant ici</a>.";
	$TraitementFini = true; //pour cacher le formulaire

	//Je renvoie les utilisateurs en fonction de leurs profil : si patient= profil == 0 vers espace membres si regul= profil == 1 vers espace regul
	//Récupération du profil
	$req2 = mysqli_query($mysqli, "SELECT profil FROM utilisateur WHERE mail='$mail'");
	$result = mysqli_fetch_assoc($req2);
	//var_dump($result);
	if ($result['profil'] == 1) {
		$result['nom'] = $_SESSION['nom'];
		header('location:espace-regul.php');
	} else {
		$result['nom'] = $_SESSION['nom'];
		header('location:espace-membre-demande.php');
	}
	//echo "Vous êtes déjà connecté, vous pouvez accéder à l'espace membre en <a href='espace-membre.php'>cliquant ici</a>.";
} else {
	//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
	if (isset($_POST['valider'])) {
		//vérifie si tous les champs sont bien pris en compte:
		if (!isset($_POST['mail'], $_POST['mdp'])) {
			echo "Un des champs n'est pas reconnu.";
		} else {
			//tous les champs sont précisés, on regarde si le membre est inscrit dans la bdd:
			//d'abord il faut créer une connexion à la base de données dans laquelle on souhaite regarder:
			if (!$mysqli) {
				echo "Erreur connexion BDD";
				//Dans ce script, je pars du principe que les erreurs ne sont pas affichées sur le site, vous pouvez donc voir qu'elle erreur est survenue avec mysqli_error(), pour cela décommentez la ligne suivante:
				//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
			} else {
				//on défini nos variables:
				$mail = htmlentities($_POST['mail'], ENT_QUOTES, "UTF-8"); //htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
				$Mdp = md5($_POST['mdp']);
				$req = mysqli_query($mysqli, "SELECT * FROM utilisateur WHERE mail='$mail' AND mdp='$Mdp'");
				//on regarde si le membre est inscrit dans la bdd:
				if (mysqli_num_rows($req) != 1) {
					echo "mail ou mot de passe incorrect.";
				} else {
					//mail et mot de passe sont trouvé sur une même colonne, on ouvre une session:
					$_SESSION['mail'] = $mail;


					//echo "Vous êtes connecté avec l'adresse mail : $mail ! Vous pouvez accéder à l'espace membre en <a href='espace-membre.php'>cliquant ici</a>.";
					$TraitementFini = true; //pour cacher le formulaire

					//Je renvoie les utilisateurs en fonction de leurs profil : si patient= profil == 0 vers espace membres si regul= profil == 1 vers espace regul
					//Récupération du profil
					$req2 = mysqli_query($mysqli, "SELECT profil FROM utilisateur WHERE mail='$mail'");
					$result = mysqli_fetch_assoc($req2);
					//var_dump($result);
					if ($result['profil'] == 1) {
						header('location:espace-regul.php');
					} else {
						header('location:espace-membre-demande.php');
					}
				}
			}
		}
	}
	if (!isset($TraitementFini)) { //quand le membre sera connecté, on définira cette variable afin de cacher le formulaire
?>

		<div class="container-xl">
			<div class="row mt-5">
				<div class="col-9 text-center mt-5 ">
					<h2>J'ai déjà un compte :</h2>
					<form action="connexion.php" method="post">
						<label for="basic-url" class="form-label">Je m'y connecte :</label>
						<div class="col-12">
							<div class="input-group mb-3">
								<span class="input-group-text bg-primary text-white" id="basic-addon7">Mon adresse :</span>
								<input type="email" class="form-control" name="mail" placeholder="Mail ..." aria-label="eMail" aria-describedby="basic-addon7" required>
							</div>
						</div>
						<div class="col-12">
							<div class="input-group mb-3">
								<span class="input-group-text bg-primary text-white" id="basic-addon8">Mot de passe :</span>
								<input type="password" class="form-control" name="mdp" aria-describedby="basic-addon8" required>
							</div>
						</div>

						<div class="mx-auto">
							<div class="col-12 text-center">
								<input class="btn bg-primary mt-3" type="submit" name="valider" value="Se connecter">
							</div>
							<div class="col-12 text-center">
								<a class="nav-link" href="inscription.php">Je n'ai pas de compte, je m'inscris.</a>
							</div>
						</div>
					</form>
				</div>
				<div class="col-3 mt-5">
					<img class="img-fluid" src="img/demi.jpg" alt="">
				</div>
			</div>
		</div>







<?php
	}
}
?>
<?php
require 'footer.php';
?>