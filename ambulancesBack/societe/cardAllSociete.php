<?php

if (!isset($_SESSION['profil'])) {
    header('location:../index.php');
}
?>

<div class="col-sm-11 col-md-5 my-1 mx-auto">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?= $datasociete['societe_nom'] ?></h5>
      <p class="card-text"><?= $datasociete['societe_adress'] ?></p>
      <p class="card-text"><?= $datasociete['societe_zip'] ?> <?= $datasociete['societe_ville'] ?></p>
      <form method="post" action="">
        <input type="submit" class="btn btn-primary" value="Voir Profil Société" name="modifSociete">
        <input type="hidden" name="id_societe" value="<?= $datasociete['id_societe'] ?>">
        <input type="hidden" name="dossier" value="<?= $datasociete['dossier'] ?>">
      </form>
    </div>
  </div>
</div>