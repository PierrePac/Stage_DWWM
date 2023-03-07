<form action="include/sendEmail.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    <div class="mb-3 row my-2" style="width: 100%">
        <h3>Candidature Spontannée</h3>
    </div>
    <div class="mb-3 row" style="width: 100%">
        <label for="description_emploi" class="col-sm-4 col-form-label">Votre Nom</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="nom_postulant" value="" pattern="[A-Za-zàâäéèêëïîôöùûüç' ]{2,30}" required>
        </div>
    </div>
    <div class="mb-3 row" style="width: 100%">
        <label for="contrat" class="col-sm-4 col-form-label">Votre Prénom</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="prenom_postulant" value="" pattern="[A-Za-zàâäéèêëïîôöùûüç']{2,30}" required>
        </div>
    </div>
    <div class="mb-3 row" style="width: 100%">
        <label for="temps" class="col-sm-4 col-form-label">Votre E-mail</label>
        <div class="col-sm-3">
            <input type="mail" class="form-control" name="mail_postulant" value="" required>
        </div>
    </div>
    <div class="mb-3 row" style="width: 100%">
        <label for="salaire_heure" class="col-sm-4 col-form-label">Insérer votre CV</label>
        <div class="col-sm-3">
            <input type="file" class="form-control" name="cv" value="" accept=".doc,.docx,.pdf" required>
        </div>
    </div>
    <div class="mb-3 row" style="width: 100%">
        <label for="motivation" class="col-sm-4 col-form-label">Insérer votre Lettre de motivation<span style="color: red; font-size:small;">* facultatif</span></label>
        <div class="col-sm-3">
            <input type="file" class="form-control" name="motivation" value="" accept=".doc,.docx,.pdf">
        </div>
    </div>
    <div class="d-flex justify-content-center mb-3 mt-3" style="width: 100%">
    <div class="g-recaptcha" data-sitekey="6Le-kzsgAAAAAHa-A3aYD4tj9pwwr48CDgzQ70wq"></div>
    </div>
    <input type="hidden" name="emploi_id" value="<?= $_SESSION['id_societe'] ?>">
    <input type="hidden" name="direction" value="emploi">
    <input type="submit" class="btn btn-primary" name="postulerSpontanneOffre">
</form>