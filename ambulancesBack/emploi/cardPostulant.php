<?php
(file_exists("media/Postulant/". $dataEmploi['emploi_id']. "-cv-" . $dataEmploi['nom_postulant']. "-" . $dataEmploi['prenom_postulant'] . ".pdf")) ? $cv = ("media/Postulant/". $dataEmploi['emploi_id']. "-cv-" . $dataEmploi['nom_postulant']. "-" . $dataEmploi['prenom_postulant'] . ".pdf") : "";
(file_exists("media/Postulant/". $dataEmploi['emploi_id']. "-cv-" . $dataEmploi['nom_postulant']. "-" . $dataEmploi['prenom_postulant'] . ".doc")) ? $cv = ("media/Postulant/". $dataEmploi['emploi_id']. "-cv-" . $dataEmploi['nom_postulant']. "-" . $dataEmploi['prenom_postulant'] . ".doc") : "";
(file_exists("media/Postulant/". $dataEmploi['emploi_id']. "-cv-" . $dataEmploi['nom_postulant']. "-" . $dataEmploi['prenom_postulant'] . ".docx")) ? $cv = ("media/Postulant/". $dataEmploi['emploi_id']. "-cv-" . $dataEmploi['nom_postulant']. "-" . $dataEmploi['prenom_postulant'] . ".docx") : "";
(file_exists("media/Postulant/". $dataEmploi['emploi_id']. "-motivation-" . $dataEmploi['nom_postulant']. "-" . $dataEmploi['prenom_postulant'] . ".pdf")) ? $motivation = ("media/Postulant/". $dataEmploi['emploi_id']. "-motivation-" . $dataEmploi['nom_postulant']. "-" . $dataEmploi['prenom_postulant'] . ".pdf") : "";
(file_exists("media/Postulant/". $dataEmploi['emploi_id']. "-motivation-" . $dataEmploi['nom_postulant']. "-" . $dataEmploi['prenom_postulant'] . ".doc")) ? $motivation = ("media/Postulant/". $dataEmploi['emploi_id']. "-motivation-" . $dataEmploi['nom_postulant']. "-" . $dataEmploi['prenom_postulant'] . ".doc") : "";
(file_exists("media/Postulant/". $dataEmploi['emploi_id']. "-motivation-" . $dataEmploi['nom_postulant']. "-" . $dataEmploi['prenom_postulant'] . ".docx")) ? $motivation = ("media/Postulant/". $dataEmploi['emploi_id']. "-motivation-" . $dataEmploi['nom_postulant']. "-" . $dataEmploi['prenom_postulant'] . ".docx") : "";

?>
<div class="col-sm-12 col-md-5 my-1 mx-2">
    <div class="card border-primary mb-3">
        <div class="card-body">
            <h5>Postulant</h5>
            <table class="table table-striped ">
                <tbody>
                    <tr>
                        <th scope="row">Nom de l'offre</th>
                        <td><?= $dataEmploi['nom_emploi'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Nom</th>
                        <td><?= $dataEmploi['nom_postulant'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Prénom</th>
                        <td><?= $dataEmploi['prenom_postulant'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">E-mail</th>
                        <td><?= $dataEmploi['mail_postulant'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">CV</th>
                        <td><?= $dataEmploi['cv'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <form method="post" action="">
                <div class="row mb-3">
                    <div class="col-12 d-flex flex-wrap justify-content-center">
                        <a type="button" class="btn btn-success mx-5 mb-2 mt-2" href="<?= $cv ?>" target="blank">Voir le CV</a>
                        <?php if(isset($motivation)):?>
                        <a type="button" class="btn btn-success mx-5 mb-2 mt-2" href="<?= $motivation ?>" target="blank">Voir la lettre de motivation</a>
                        <?php endif;?>
                        <input type="submit" class="btn btn-primary mx-5 mb-2 mt-2" value="Postulant traité" name="PostulantTraite">
                        <input type="hidden" name="postulant_id" value="<?= $dataEmploi['postulant_id'] ?>">
                        <input type="hidden" name="cv" value="<?= $cv ?>">
                        <?php if(isset($motivation)):?>
                        <input type="hidden" name="motivation" value="<?= $motivation ?>">
                        <?php endif;?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>