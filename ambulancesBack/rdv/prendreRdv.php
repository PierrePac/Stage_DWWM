<form action="include/modification.php" method="post" class="needs-validation" novalidate>
    <div class="mb-3 row">
        <label for="nom" class="col-sm-4 col-form-label">Date du rendez-vous</label>
        <div class="col-sm-3 col-md-5">
            <input type="date" class="form-control" placeholder="Date de rdv" name="rdv_date" value="<?= date('Y-m-d')?>" min="<?= date('Y-m-d')?>" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="prenom" class="col-sm-4 col-form-label">Heure du rendez-vous</label>
        <div class="col-sm-3 col-md-5">
            <input type="time" class="form-control" name="heure" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="transport" class="col-sm-4 col-form-label">Transport</label>
        <div class="col-sm-3 col-md-5">
            <select class="form-select" name="transport_type" required>
                <option selected>Type de transport</option>
                <option value="0">Transport assis</option>
                <option value="1">Transport couché</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="transport_kms" class="col-sm-4 col-form-label">Distance à parcourir</label>
        <div class="col-sm-3 col-md-2">
            <input class="form-check-input" id="transport_kms1" type="radio" name="transport_kms" value="0" required>
            <label class="form-check-label" for="transport_kms1">
                Jusquà 150kms.
            </label>
        </div>
        <div class="col-sm-3 col-md-2">
            <input class="form-check-input" id="transport_kms2" type="radio" name="transport_kms" value="1" required>
            <label class="form-check-label" for="transport_kms2">
                Au delà de 150kms.
            </label>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="prenom" class="col-sm-4 col-form-label">Raison</label>
        <div class="col-sm-3 col-md-5">
            <select class="form-select" name="raison" required>
                <option selected>Selectionner la raison du transport</option>
                <option value="0">Consultation</option>
                <option value="1">Hospitalisation de jour</option>
                <option value="2">Hospitalisation de plus de 12h</option>
                <option value="3">Sortie d'hospitalisation</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="ald" class="col-sm-4 col-form-label">Affection longue durée</label>
            <div class="col-sm-3 col-md-2">
                <input class="form-check-input" id="ald1" type="radio" name="ald" value="0" required>
                <label class="form-check-label" for="ald1">
                    Concerne une ALD
                </label>
            </div>
            <div class="col-sm-3 col-md-2">
                <input class="form-check-input" id="ald2" type="radio" name="ald" value="1" required>
                <label class="form-check-label" for="ald2">
                    Ne concerne pas une ALD
                </label>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="pick_name" class="col-sm-4 col-form-label">Lieu départ</label>
        <div class="col-sm-3 col-md-5">
            <input type="text" class="form-control" placeholder="Lieu départ" name="pick_name" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{0,80}" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="pick_adress" class="col-sm-4 col-form-label">Adresse départ</label>
        <div class="col-sm-3 col-md-5">
            <input type="text" class="form-control" placeholder="Adresse départ" pattern="[0-9A-Za-zàâäéèêëïîôöùûüç\' ]{0,80}" name="pick_adress" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="pick_zip" class="col-sm-4 col-form-label">Code postal départ</label>
        <div class="col-sm-3 col-md-5">
            <input type="text" class="form-control" placeholder="Code postal départ" pattern="[0-9]{5}" name="pick_zip" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="pick_ville" class="col-sm-4 col-form-label">Ville départ</label>
        <div class="col-sm-3 col-md-5">
            <input type="text" class="form-control" placeholder="Ville départ" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{0,80}" name="pick_ville" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="dest_name" class="col-sm-4 col-form-label">Lieux destination</label>
        <div class="col-sm-3 col-md-5">
            <input type="text" class="form-control" placeholder="Lieux destination" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{0,80}" name="dest_name" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="dest_adress" class="col-sm-4 col-form-label">Adresse destination</label>
        <div class="col-sm-3 col-md-5">
            <input type="text" class="form-control" placeholder="Adresse destination" pattern="[0-9A-Za-zàâäéèêëïîôöùûüç\' ]{0,80}" name="dest_adress" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="dest_zip" class="col-sm-4 col-form-label">Code postal destination</label>
        <div class="col-sm-3 col-md-5">
            <input type="text" class="form-control" placeholder="Code postal destination" pattern="[09]{5}" name="dest_zip" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="dest_ville" class="col-sm-4 col-form-label">Ville destination</label>
        <div class="col-sm-3 col-md-5">
            <input type="text" class="form-control" placeholder="Ville destination" pattern="[A-Za-zàâäéèêëïîôöùûüç\' ]{0,80}" name="dest_ville" required>
        </div>
    </div>
    <div class="d-flex justify-content-center mb-3 mt-3">
    <div id="captcha" class="g-recaptcha" data-sitekey="6Le-kzsgAAAAAHa-A3aYD4tj9pwwr48CDgzQ70wq"></div>
    </div>
    <input type="submit" class="btn btn-primary" name="priseRdv">
    <input type="hidden" name="direction" value="rdv"> 
</form>
</div>