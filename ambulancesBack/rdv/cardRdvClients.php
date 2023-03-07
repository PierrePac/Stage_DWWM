<?php

if (!isset($_SESSION['profil'])) {
    header('location:../index.php');
}

$dataRdv['transport_type'] = 0 ? "Transport assis" : "Transport couché";
$dataRdv['transport_kms'] = 0 ? "Jusquà 150kms" : "au delà de 150kms";
$dataRdv['ald'] = 0 ? "Concerne une ALD" : "Ne concerne pas une ALD";
  switch ($dataRdv['rdv_raison']) {
    case 0:
      $dataRdv['rdv_raison'] = "Consultation";
      break;
    case 1:
      $dataRdv['rdv_raison'] = "Hospitalisation de jour";
      break;
    case 2:
      $dataRdv['rdv_raison'] = "Hospitalisation de plus de 12h";
      break;
    case 3:
      $dataRdv['rdv_raison'] = "Sortie d'hospitalisation";
      break;
  }

?>
  <div class="col-sm-12 col-md-5 mx-auto">
  <div class="card">
    <div class="card-body">
      <div class="container border border-primary border-3 rounded py-2">
        <div class="row bg-light">
        <div class="col">
            <h5 class="card-text">
              <?= $_SESSION['societe_nom'] ?>
            </h5>
          </div>
        </div>
        <div class="row bg-light">
          <div class="col">
            <h5 class="card-text border-bottom border-2 border-dark py-3">
              Information personnelle
            </h5>
          </div>
        </div>
        <div class="row py-2">
          <div class="col font-weight-bold">Adresse</div>
          <div class="col">
            <p class="card-text"><?= $dataRdv['adress'] ?></p>
          </div>
        </div>
        <div class="row py-2 bg-light">
          <div class="col font-weight-bold">Ville</div>
          <div class="col">
            <p class="card-text"><?= $dataRdv['zip'] ?> <?= $dataRdv['ville'] ?></p>
          </div>
        </div>
        <div class="row py-2">
          <div class="col font-weight-bold">Téléphonne</div>
          <div class="col">
            <p class="card-text">0<?= $dataRdv['tel'] ?></p>
          </div>
        </div>
        <div class="row py-2 bg-light">
          <div class="col font-weight-bold">E-mail</div>
          <div class="col">
            <p class="card-text"><?= $dataRdv['mail'] ?></p>
          </div>
        </div>
        <div class="row py-2">
          <div class="col">
            <h5
              class="card-text border-bottom border-top border-2 border-dark py-2 my-2"
            >
              Information sur le rendez-vous
            </h5>
          </div>
        </div>
        <div class="row py-2 bg-light">
          <div class="col font-weight-bold">Date et heure de rendez-vous</div>
          <div class="col">
            <p class="card-text">
              <?= $dataRdv['rdv_date'] ?> à <?= $dataRdv['heure'] ?>
            </p>
          </div>
        </div>
        <div class="row py-2">
          <div class="col font-weight-bold">Condition de transport</div>
          <div class="col">
            <p class="card-text"><?= $dataRdv['transport_type'] ?></p>
          </div>
        </div>
        <div class="row py-2 bg-light">
          <div class="col font-weight-bold">Distance du transport</div>
          <div class="col">
            <p class="card-text"><?= $dataRdv['transport_kms'] ?></p>
          </div>
        </div>
        <div class="row py-2">
          <div class="col font-weight-bold">Raison du transport</div>
          <div class="col">
            <p class="card-text"><?= $dataRdv['rdv_raison'] ?></p>
          </div>
        </div>
        <div class="row py-2 bg-light">
          <div class="col font-weight-bold">Affectation longue durée</div>
          <div class="col">
            <p class="card-text"><?= $dataRdv['ald'] ?></p>
          </div>
        </div>
        <div class="row py-2">
          <div class="col font-weight-bold">lieu de départ</div>
          <div class="col">
            <p class="card-text"><?= $dataRdv['pick_name'] ?></p>
          </div>
        </div>
        <div class="row py-2 bg-light">
          <div class="col font-weight-bold">Adresse de départ</div>
          <div class="col">
            <p class="card-text"><?= $dataRdv['pick_adress'] ?></p>
          </div>
        </div>
        <div class="row py-2">
          <div class="col font-weight-bold">Ville de départ</div>
          <div class="col">
            <p class="card-text"><?= $dataRdv['pick_zip'] ?> <?= $dataRdv['ville'] ?></p>
          </div>
        </div>
        <div class="row py-2 bg-light">
          <div class="col font-weight-bold">Lieu de destination</div>
          <div class="col">
            <p class="card-text"><?= $dataRdv['dest_name'] ?></p>
          </div>
        </div>
        <div class="row py-2">
          <div class="col font-weight-bold">Adresse de destination</div>
          <div class="col">
            <p class="card-text"><?= $dataRdv['dest_adress'] ?></p>
          </div>
        </div>
        <div class="row py-2 bg-light">
          <div class="col font-weight-bold">Ville de destination</div>
          <div class="col">
            <p class="card-text">
              <?= $dataRdv['dest_zip'] ?> <?= $dataRdv['dest_ville'] ?>
            </p>
          </div>
        </div>
        <div class="row py-2">
          <div class="col"><?php
          
          if($_SESSION['profil'] == 0 || $_SESSION['profil'] == 2):
              if($dataRdv['statut'] == 0):
                  ?><div class="row bg-primary text-white"><div class="col"><h5 class="px-5 border-top border-2 border-dark py-3">En traitement</h5></div></div><?php
              elseif($dataRdv['statut'] == 1):
                  ?><div class="row bg-success text-white"><div class="col"><h5 class="px-5 border-top border-2 border-dark py-3">Rendez-vous traité</h5></div></div><?php
              endif;
          elseif($_SESSION['profil'] == 1 || $_SESSION['profil'] == 4):
              if($dataRdv['statut'] == 0):
                    ?><form action="include/modification.php" method="post">
                           <div class="row bg-primary text-white">
            <div class="col">
              <input
                type="submit"
                class="btn btn-primary py-2 px-3"
                name="traitement"
                value="Client Rappelé"
              />
              <input
                type="hidden"
                class="btn"
                name="rdv_id"
                value="<?= $dataRdv['rdv_id'] ?>"
              />
            </div>
          </div>
        </form><?php
              elseif($dataRdv['statut'] == 1):
                  ?><div class="row bg-success text-white"><div class="col"><h5 class="px-5 border-top border-2 border-dark py-3">Rendez-vous traité</h5></div></div><?php
              endif;
          endif;
          ?></div>
        </div>
      </div>
    </div>
  </div>
</div>

