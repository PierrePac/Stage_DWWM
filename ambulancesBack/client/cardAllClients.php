<?php

if (!isset($_SESSION['profil'])) {
    header('location:../index.php');
}
?>

<div class="col-sm-12 col-md-5 my-1 mx-auto">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?=$dataclients['nom']?></h5>
      <p class="card-text"><?=$dataclients['prenom']?></p>
      <form method="post" action="">
        <input type="submit" class="btn btn-primary" value="Voir Profil Client" name="modifClients">
        <input type="hidden" name="id_client" value="<?=$dataclients['user_id']?>">
      </form>
    </div>
  </div>
</div>