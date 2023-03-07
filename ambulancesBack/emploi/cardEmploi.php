<div class="col-sm-12 col-md-5 my-1 mx-auto">
  <div class="card border-primary mb-3">
    <div class="card-body">
      <h5>Offre d'emploi</h5>
      <table class="table table-striped ">
        <tbody>
          <tr>
            <th scope="row">Nom de l'offre</th>
            <td><?= $dataEmploi['nom_emploi'] ?></td>
          </tr>
          <tr>
            <th scope="row">Descriptif du poste</th>
            <td><?= $dataEmploi['description_emploi'] ?></td>
          </tr>
          <tr>
            <th scope="row">Prérequis</th>
            <td><?= $dataEmploi['obligation_emploi'] ?></td>
          </tr>
          <tr>
            <th scope="row">Type de contrat</th>
            <td><?= $dataEmploi['contrat'] ?></td>
          </tr>
          <tr>
            <th scope="row">Nombre d'heure par semaine</th>
            <td><?= $dataEmploi['temps'] ?></td>
          </tr>
          <tr>
            <th scope="row">Taux horaire</th>
            <td><?= $dataEmploi['salaire_heure'] ?></td>
          </tr>
          <tr>
            <th scope="row">Date de mise en ligne</th>
            <td><?= $dataEmploi['date'] ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <?php
      if (isset($_SESSION['profil']) && $_SESSION['profil'] == 3) :
      ?>
        <form method="post" action="">
          <div class="row mb-3">
            <div class="col-12 d-flex flex-wrap justify-content-center">
              <input type="submit" class="btn btn-primary mx-5 mb-2 mt-2" value="Modifier l'offre" name="modifOffre">
              <?php
              if ($dataEmploi['statut'] == 1) :
              ?>
                <input type="submit" class="btn btn-danger mx-5 mb-2 mt-2" value="Supprimer l'offre" name="desactiverOffre">
              <?php
                else :
                  ?><input type="submit" class="btn btn-primary mx-5 mb-2 mt-2" value="Réactiver l'offre" name="reactiverOffre"><?php
                endif; ?>
              <input type="hidden" name="emploi_id" value="<?= $dataEmploi['emploi_id'] ?>">
            </div>
          </div>
        </form>
      <?php
      else :
      ?>
        <form method="post" action="">
          <div class="row mb-3">
            <div class="col-12 d-flex flex-wrap justify-content-center">
              <input type="submit" class="btn btn-primary mx-5 mb-2 mt-2" value="Postuler à l'offre" name="postuler">
              <input type="hidden" name="emploi_id" value="<?= $dataEmploi['emploi_id'] ?>">
            </div>
          </div>
        </form>
      <?php
      endif;

      ?>
    </div>
  </div>
</div>