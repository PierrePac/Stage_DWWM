<?php

if (!isset($_SESSION['profil'])) {
    header('location:../index.php');
}
?>

<form method="post" action="include/modification.php">
    <div class="row mb-3">
      <label for="modifClientNom" class="col-sm-2 col-form-label">Nom</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="modifClientNom" name="modifNom" pattern="[A-Za-zàâäéèêëïîôöùûüç' ]{2,30}" value="<?= $arrayClient['nom'] ?>">
      </div>
    </div>
    <div class="row mb-3">
      <label for="modifClientPrenom" class="col-sm-2 col-form-label">Prénom</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="modifClientPrenom" name="modifPrenom" pattern="[A-Za-zàâäéèêëïîôöùûüç' ]{2,30}" value="<?= $arrayClient['prenom'] ?>">
      </div>
    </div>
    <div class="row mb-3">
      <label for="modifClientAdress" class="col-sm-2 col-form-label">Adresse</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="modifClientAdress" name="modifAdress" pattern="[0-9]{1,3}(([,. ]?){1}[-a-zA-Zàâäéèêëïîôöùûüç']+)*" value="<?= $arrayClient['adress'] ?>">
      </div>
    </div>
    <div class="row mb-3">
      <label for="modifClientZip" class="col-sm-2 col-form-label">Code postal</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="modifClientZip" name="modifZip" pattern="[0-9]{5}" value="<?= $arrayClient['zip'] ?>">
      </div>
    </div>
    <div class="row mb-3">
      <label for="modifClientville" class="col-sm-2 col-form-label">Ville</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="modifClientville" name="modifVille" pattern="[A-Za-zàâäéèêëïîôöùûüç' ]{2,30}" value="<?= $arrayClient['ville'] ?>">
      </div>
    </div>
    <div class="row mb-3">
      <label for="modifClientTel" class="col-sm-2 col-form-label">Téléphonne</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="modifClientTel" name="modifTel" pattern="[0-9]{10}" value="0<?= $arrayClient['tel'] ?>">
      </div>
    </div>
    <div class="row mb-3">
      <label for="modifClientMail" class="col-sm-2 col-form-label">E-mail</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="modifClientMail" name="modifMail" value="<?= $arrayClient['mail'] ?>">
      </div>
    </div>
    <div class="row mb-3">
      <label for="modifClientAnniv" class="col-sm-2 col-form-label">Date de naissance</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" id="modifClientAnniv" name="modifAnniv" value="<?= $arrayClient['anniv'] ?>">
      </div>
    </div>
    <input type="hidden" class="btn btn-primary" value="<?= $arrayClient['user_id'] ?>" name="user_id">
    <input type="submit" class="btn btn-primary" value="Modifier" name="modifProfil">
  </form>
<?php
if($_SESSION['profil'] == 2):
    if($arrayClient['active'] == 0):
?>
<form method="post" action="include/modification.php">
<div class="row mb-3">
<div class="col-12 d-flex justify-content-end">
<input type="submit" class="btn btn-success" value="Réactiver Client" name="reactiverClient">
<input type="hidden" name="id_client" value="<?= $arrayClient['user_id'] ?>">
</div>
</div>
</form>
<?php
  else:
?>
<form method="post" action="include/modification.php">
<div class="row mb-3">
<div class="col-12 d-flex justify-content-end">
<input type="submit" class="btn btn-warning" value="Désactiver Client" name="desactiverClient">
<input type="hidden" name="id_client" value="<?= $arrayClient['user_id'] ?>">
</div>
</div>
</form>
<?php
  endif;
endif; 
  