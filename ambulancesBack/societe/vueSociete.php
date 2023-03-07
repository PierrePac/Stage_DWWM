<?php

if (!isset($_SESSION['profil'])) {
    header('location:../index.php');
}
?>
<div class="container pt-3">
    <div class="row p-2 border-bottom">
        <div class="col-4 font-weight-bold">Nom de la société</div>
        <div class="col-8"><?=$_SESSION['societe_nom'] ?></div>
    </div>
    <div class="row p-2 border-bottom">
        <div class="col-4 font-weight-bold">Date de création</div>
        <div class="col-8"><?= $_SESSION['date_creation'] ?></div>
    </div>
    <div class="row p-2 border-bottom">
        <div class="col-4 font-weight-bold">Addresse</div>
        <div class="col-8"><?= $_SESSION['societe_adress'] ?></div>
    </div>
    <div class="row p-2 border-bottom">
        <div class="col-4 font-weight-bold">Code postal</div>
        <div class="col-8"><?= $_SESSION['societe_zip'] ?></div>
    </div>
    <div class="row p-2 border-bottom">
        <div class="col-4 font-weight-bold">Ville</div>
        <div class="col-8"><?= $_SESSION['societe_ville'] ?></div>
    </div>
    <div class="row p-2 border-bottom">
        <div class="col-4 font-weight-bold">E-Téléphonne</div>
        <div class="col-8">0<?= $_SESSION['societe_tel'] ?></div>
    </div>
    <div class="row p-2 border-bottom">
        <div class="col-4 font-weight-bold">E-mail</div>
        <div class="col-8"><?= $_SESSION['societe_mail'] ?></div>
    </div>
</div>
