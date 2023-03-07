<?php

if (!isset($_SESSION['profil'])) {
    header('location:../index.php');
}
?>

<table class="table">
<tbody>
<tr>
<th scope="row">Nom</th>
<td><?= $_SESSION['nom'] ?></td>
</tr>
<tr>
<th scope="row">Prenom</th>
<td><?= $_SESSION['prenom'] ?></td>
</tr>
<tr>
<th scope="row">Adresse</th>
<td><?= $_SESSION['adress'] ?></td>
</tr>
<tr>
<th scope="row">Code postal</th>
<td><?= $_SESSION['zip'] ?></td>
</tr>
<tr>
<th scope="row">Ville</th>
<td><?= $_SESSION['ville'] ?></td>
</tr>
<tr>
<th scope="row">Téléphone</th>
<td>0<?= $_SESSION['tel'] ?></td>
</tr>
<tr>
<th scope="row">E-mail</th>
<td><?= $_SESSION['mail'] ?></td>
</tr>
<tr>
<th scope="row">Date de naissance</th>
<td><?= $_SESSION['anniv'] ?></td>
</tr>
</tbody>
</table>