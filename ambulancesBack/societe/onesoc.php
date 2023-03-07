<?php

if (!isset($_SESSION['profil'])) {
  header('location:../index.php');
}
$arraySoc = oneSocietes($_POST['id_societe']);

?>

<form method="post" action="include/modification.php" enctype="multipart/form-data" class="needs-validation" novalidate>
  <div class="row mb-3 mt-3">
    <label for="modifSocieteNom" class="col-sm-2 col-form-label">Nom de la société</label>
    <div class="col-sm-10 col-md-6">
      <input type="text" class="form-control" id="modifSocieteNom" name="modifSocieteNom" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{0,80}" value="<?= $arraySoc['societe_nom'] ?>" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifDateCreation" class="col-sm-2 col-form-label">Date de création</label>
    <div class="col-sm-10 col-md-6">
      <input type="date" class="form-control" id="modifDateCreation" name="modifDateCreation" value="<?= $arraySoc['date_creation'] ?>" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifSocieteAdress" class="col-sm-2 col-form-label">Adresse</label>
    <div class="col-sm-10 col-md-6">
      <input type="text" class="form-control" id="modifSocieteAdress" name="modifSocieteAdress" pattern="[0-9A-Za-zàâäéèêëïîôöùûüç\' ]{0,80}" value="<?= $arraySoc['societe_adress'] ?>" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifSocieteZip" class="col-sm-2 col-form-label">Code Postal</label>
    <div class="col-sm-10 col-md-6">
      <input type="text" class="form-control" id="modifSocieteZip" name="modifSocieteZip" pattern="[0-9]{5}" value="<?= $arraySoc['societe_zip'] ?>" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifSocieteVille" class="col-sm-2 col-form-label">Ville</label>
    <div class="col-sm-10 col-md-6">
      <input type="text" class="form-control" id="modifSocieteVille" name="modifSocieteVille" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{0,80}" value="<?= $arraySoc['societe_ville'] ?>" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifSocieteTel" class="col-sm-2 col-form-label">Téléphone</label>
    <div class="col-sm-10 col-md-6">
      <input type="text" class="form-control" id="modifSocieteTel" name="modifSocieteTel" pattern="[0-9]{10}" value="0<?= $arraySoc['societe_tel'] ?>" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifSocieteMail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10 col-md-6">
      <input type="email" class="form-control" id="modifSocieteMail" name="modifSocieteMail" value="<?= $arraySoc['societe_mail'] ?>" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifStory1" class="col-sm-2 col-form-label">Text 1</label>
    <div class="col-sm-10 col-md-6">
      <textarea class="form-control" id="modifStory1" name="modifStory1" required><?= $arraySoc['story_1'] ?></textarea>
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifStory2" class="col-sm-2 col-form-label">Text 2</label>
    <div class="col-sm-10 col-md-6">
      <textarea class="form-control" id="modifStory2" name="modifStory2" value="" required><?= $arraySoc['story_2'] ?></textarea>
    </div>
  </div>
  <div class="row mb-3">
    <label for="img_1" class="col-sm-2 col-form-label">Image 1</label>
    <div class="col-sm-10 col-md-6">
      <input type="file" class="form-control" id="img_1" name="img_1">
      <input type="hidden" name="img_1" value="<?= $arraySoc['img_1'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="img_2" class="col-sm-2 col-form-label">Image 2</label>
    <div class="col-sm-10 col-md-6">
      <input type="file" class="form-control" id="img_2" name="img_2">
      <input type="hidden" name="img_2" value="<?= $arraySoc['img_2'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="img_3" class="col-sm-2 col-form-label">Image 3</label>
    <div class="col-sm-10 col-md-6">
      <input type="file" class="form-control" id="img_3" name="img_3">
      <input type="hidden" name="img_3" value="<?= $arraySoc['img_3'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="slider_1" class="col-sm-2 col-form-label">slider 1</label>
    <div class="col-sm-10 col-md-6">
      <input type="file" class="form-control" id="slider_1" name="slider_1">
      <input type="hidden" name="slider_1" value="<?= $arraySoc['slider_1'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="slider_2" class="col-sm-2 col-form-label">slider_2</label>
    <div class="col-sm-10 col-md-6">
      <input type="file" class="form-control" id="slider_2" name="slider_2">
      <input type="hidden" name="slider_2" value="<?= $arraySoc['slider_2'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="slider_3" class="col-sm-2 col-form-label">slider_3</label>
    <div class="col-sm-10 col-md-6">
      <input type="file" class="form-control" id="slider_3" name="slider_3">
      <input type="hidden" name="slider_3" value="<?= $arraySoc['slider_3'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="logo" class="col-sm-2 col-form-label">logo</label>
    <div class="col-sm-10 col-md-6">
      <input type="file" class="form-control" id="logo" name="logo">
      <input type="hidden" name="logo" value="<?= $arraySoc['logo'] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="map" class="col-sm-2 col-form-label">source map</label>
    <div class="col-sm-10 col-md-6">
      <input type="text" class="form-control" id="map" name="map" value="<?= $arraySoc['map'] ?>" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="modifTemplate" class="col-sm-2 col-form-label">template</label>
    <div class="col-sm-10 col-md-6">
      <input class="form-control" id="modifTemplate" name="modifTemplate" pattern="[1-4]{1}" value="<?= $arraySoc['template_id'] ?>" required>
    </div>
  </div>
  <input type="hidden" name="id_societe" value="<?= $arraySoc['id_societe'] ?>">
  <input type="hidden" name="dossier" value="<?= $arraySoc['dossier'] ?>">
  <input type="hidden" name="societe_nom" value="<?= $arraySoc['societe_nom'] ?>">
  <input type="submit" class="btn btn-primary" value="Modifier" name="modifSociete">
</form>

<!-- Bn à réactiver lorsque les sociétés auront des noms de domaines 
<form method="post" action="">
  <input type="submit" class="btn btn-success mt-2" value="voir le site" name="template">
  <input type="hidden" name="id_societe" value="<?= $arraySoc['id_societe'] ?>">
  <input type="hidden" name="template_id" value="<?= $arraySoc['template_id'] ?>">
</form> -->

<?php
if ($_SESSION['profil'] == 2) :
  if ($arraySoc['active'] == 0) :
?>
    <form method="post" action="include/modification.php">
      <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end">
          <input type="submit" class="btn btn-success mt-2 mx-3" value="Réactiver Societe" name="reactiverSociete">
          <input type="hidden" name="id_societe" value="<?= $arraySoc['id_societe'] ?>">
        </div>
      </div>
    </form>
  <?php
  else :
  ?>
    <form method="post" action="include/modification.php">
      <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end">
          <input type="submit" class="btn btn-danger mt-2 mx-3" value="Désactiver societe" name="desactiverSociete">
          <input type="hidden" name="id_societe" value="<?= $arraySoc['id_societe'] ?>">
        </div>
      </div>
    </form>
<?php
  endif;
endif;
