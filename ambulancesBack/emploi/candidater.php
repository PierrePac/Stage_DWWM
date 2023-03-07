<form action="include/modification.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    <div class="mb-3 row my-2">
        <h3>Vous postuler pour de <?= $dataOffre['nom_emploi'] ?></h3>
    </div>
    <div class="mb-3 row">
        <label for="description_emploi" class="col-sm-4 col-form-label">Votre Nom</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="nom_postulant" value="" pattern="[A-Za-zàâäéèêëïîôöùûüç' ]{2,30}" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="contrat" class="col-sm-4 col-form-label">Votre Prénom</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="prenom_postulant" value="" pattern="[A-Za-zàâäéèêëïîôöùûüç' ]{2,30}" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="temps" class="col-sm-4 col-form-label">Votre E-mail</label>
        <div class="col-sm-3">
            <input type="mail" class="form-control" name="mail_postulant" value="" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="cv" class="col-sm-4 col-form-label">Insérer votre CV</label>
        <div class="col-sm-3">
            <input type="file" class="form-control" name="cv" value="" accept=".doc,.docx,.pdf" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="motivation" class="col-sm-4 col-form-label">Insérer votre Lettre de motivation<span style="color: red; font-size:small;">* facultatif</span></label>
        <div class="col-sm-3">
            <input type="file" class="form-control" name="motivation" value="" accept=".doc,.docx,.pdf">
        </div>
    </div>
    <input type="hidden" name="emploi_id" value="<?= $dataOffre['emploi_id'] ?>">
    <input type="submit" class="btn btn-primary" name="postulerOffre">
</form>