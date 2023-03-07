<?php

if (!isset($_SESSION['profil'])) {
    header('location:../index.php');
}
?>

<form method="post" action="include/modification.php">
  <div class="row mb-3">
    <label for="modifNom" class="col-sm-2 col-form-label">Nom</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="modifNom" name="modifNom" pattern="[A-Za-zàâäéèêëïîôöùûüç' ]{2,30}" value="<?= $_SESSION['nom'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifPrenom" class="col-sm-2 col-form-label">Prenom</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="modifPrenom" name="modifPrenom" pattern="[A-Za-zàâäéèêëïîôöùûüç' ]{2,30}" value="<?= $_SESSION['prenom'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifAdress" class="col-sm-2 col-form-label">Adresse</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="modifAdress" name="modifAdress" pattern="[0-9]{1,3}(([,. ]?){1}[-a-zA-Zàâäéèêëïîôöùûüç']+)*" value="<?= $_SESSION['adress'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifZip" class="col-sm-2 col-form-label">Code Postal</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="modifZip" name="modifZip" pattern="[0-9]{5}" value="<?= $_SESSION['zip'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifVille" class="col-sm-2 col-form-label">Ville</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="modifVille" name="modifVille" pattern="[A-Za-zàâäéèêëïîôöùûüç' ]{2,30}" value="<?= $_SESSION['ville'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifTel" class="col-sm-2 col-form-label">Téléphone</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="modifTel" name="modifTel" pattern="[0-9]{10}" value="0<?= $_SESSION['tel'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifMail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="modifMail" name="modifMail" value="<?= $_SESSION['mail'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifAnniv" class="col-sm-2 col-form-label">Date de naissance</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="modifAnniv" name="modifAnniv" value="<?= $_SESSION['anniv'] ?>">
    </div>
  </div>
  <span style="color:red; font-size:0.8rem;">*au moins 8 caractères, un chiffre, une lettre majuscule et une minuscule</span>
  <div class="row mb-3">
    <label for="modifMdp" class="col-sm-2 col-form-label">Mot de passe</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="modifMdp" name="modifMdp" pattern="(?=.*\d)(?=.*[a-zàâäéèêëïîôöùûüç'])(?=.*[A-Z]).{8,}" placeholder="changer votre mot de passe">
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifVerifMdp" class="col-sm-2 col-form-label">Vérification du mot de passe</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="modifVerifMdp" name="modifVerifMdp" pattern="(?=.*\d)(?=.*[a-zàâäéèêëïîôöùûüç'])(?=.*[A-Z]).{8,}" placeholder="confirmer votre nouveau mot de passe">
    </div>
  </div>
  <input type="hidden" class="btn btn-primary" value="<?= $_SESSION['user_id'] ?>" name="user_id">
  <input type="submit" class="btn btn-primary" value="Modifier" name="modifProfil">
  
</form>
    </body>
    </html>