<?php

if (!isset($_SESSION['profil'])) {
    header('location:../index.php');
}
?>

<form action="include/modification.php" method="post">
    <div class="mb-3 row">
        <label for="nom_emploi" class="col-sm-4 col-form-label">Intitulé de l'emploi</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="nom_emploi" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{2,30}" value="<?= recuperationOffre($_POST)["nom_emploi"] ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="description_emploi" class="col-sm-4 col-form-label">description du poste</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="description_emploi" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{2,30}" value="<?= recuperationOffre($_POST)['description_emploi'] ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="obligation_emploi" class="col-sm-4 col-form-label">Prérequis du poste</label>
        <div class="col-sm-3">
            <textarea type="text" class="form-control" name="obligation_emploi" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{2,300}" value="<?= recuperationOffre($_POST)['obligation_emploi'] ?>" placeholder="<?= recuperationOffre($_POST)['obligation_emploi'] ?>"></textarea>
            <input type="hidden" class="form-control" name="old_obligation_emploi" value="<?= recuperationOffre($_POST)['obligation_emploi'] ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="contrat" class="col-sm-4 col-form-label">Type de contrat</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="contrat" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{2,20}" value="<?= recuperationOffre($_POST)['contrat'] ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="temps" class="col-sm-4 col-form-label">Nombre d'heure par semaine</label>
        <div class="col-sm-3">
            <input type="number" class="form-control" name="temps" value="<?= recuperationOffre($_POST)['temps'] ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="salaire_heure" class="col-sm-4 col-form-label">rémunération horaire</label>
        <div class="col-sm-3">
            <input type="number" class="form-control" name="salaire_heure" step=0.01 value="<?= recuperationOffre($_POST)['salaire_heure'] ?>">
        </div>
    </div>
    <input type="hidden" name="emploi_id" value="<?= recuperationOffre($_POST)['emploi_id'] ?>">
    <input type="submit" class="btn btn-primary" name="modifierOffre">
</form>
</div>