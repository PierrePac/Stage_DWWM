<?php

if (!isset($_SESSION['profil'])) {
    header('location:../index.php');
}
?>
<form action="include/modification.php" method="post">
  <div class="mb-3 row">
    <label for="societe" class="col-sm-4 col-form-label"></label>
    <div class="col-sm-3 col-md-5">
      <select class="form-select" name="id_societe" required>
          <option selected>Selectionner Une Société</option>
          <?php
          foreach(allSocName() as $socName):
          ?><option value="<?=$socName['id_societe']?>"><?=$socName['societe_nom']?></option><?php
          endforeach;
          ?>
      </select>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="nom_emploi" class="col-sm-4 col-form-label">Intitulé de l'emploi</label>
    <div class="col-sm-6 col-md-4 col-md-4">
      <input type="text" class="form-control" name="nom_emploi" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{2,30}">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="description_emploi" class="col-sm-4 col-form-label">description du poste</label>
    <div class="col-sm-6 col-md-4">
      <input type="text" class="form-control" name="description_emploi" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{2,30}">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="obligation_emploi" class="col-sm-4 col-form-label">Prérequis du poste</label>
    <div class="col-sm-6 col-md-4">
      <textarea type="text" class="form-control" name="obligation_emploi" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{2,300}"></textarea>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="contrat" class="col-sm-4 col-form-label">Type de contrat</label>
    <div class="col-sm-6 col-md-4">
      <input type="text" class="form-control" name="contrat" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{2,20}">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="temps" class="col-sm-4 col-form-label">Nombre d'heure par semaine</label>
    <div class="col-sm-6 col-md-4">
      <input type="number" class="form-control" name="temps">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="salaire_heure" class="col-sm-4 col-form-label">rémunération horaire</label>
    <div class="col-sm-6 col-md-4">
      <input type="number" class="form-control" name="salaire_heure" step= 0.01>
    </div>
  </div>
<input type="submit" class="btn btn-primary" name="posterOffre">
</form>
</div>