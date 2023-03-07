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

//Récupération des infos des membres
$req = mysqli_query($mysqli, "SELECT * FROM utilisateur WHERE mail='$mail'");
$info = mysqli_fetch_assoc($req);
?>
<?php require 'header-membre.php';
?>
<div class="container-xl">
    <div class="row mt-5">
        <div class="col-12 mt-5">
            <h1 class="m-5 text-primary">Modification du compte</h1>
            <form action="espace-membre-transit.php" method="post">
                <table class="table col-12">
                    <thead>
                        <tr>
                            <th class="bg-primary text-white" scope="col">Nom</th>
                            <th class="bg-primary text-white" scope="col">Prenom</th>
                            <th class="bg-primary text-white" scope="col">Adresse</th>
                            <th class="bg-primary text-white" scope="col">Code postale</th>
                            <th class="bg-primary text-white" scope="col">Ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="nom" value="<?= $info['nom']; ?>"></td>
                            <td><input type="text" name="prenom" value="<?= $info['prenom']; ?>"></td>
                            <td><input type="text" name="adress" value="<?= $info['adress']; ?>"></td>
                            <td><input type="umber" name="zip" value="<?= $info['zip']; ?>"></td>
                            <td><input type="text" name="ville" value="<?= $info['ville']; ?>"></td>
                        </tr>
                    </tbody>                   
                    <thead>
                        <tr>
                            <th class="bg-primary text-white" scope="col">Téléphone</th>
                            <th class="bg-primary text-white" scope="col">eMail</th>
                            <th class="bg-primary text-white" scope="col">Date de naissance</th>
                            <th class="bg-primary text-white" scope="col"></th>
                            <th class="bg-primary text-white" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="number" name="tel" value="<?= '0' . $info['tel']; ?>"></td>
                            <td><input type="email" name="mail" value="<?= $info['mail']; ?>"></td>
                            <td><input type="date" name="anniv" value="<?= $info['anniv']; ?>"></td>
                            <td><input type="hidden" name="mdp" value=""></td>
                            <td><input type="submit" class="btn btn-primary" name="valider" value="Valider les modifications"></td>
                        </tr>
                    </tbody>
                </table>
                
            </form>
        </div>
    </div>
</div>




<?php
require 'footer.php';
?>