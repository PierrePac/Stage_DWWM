<div class="menu">
  <div class="w-100 mx-auto ">
    <div class="d-flex flex-row justify-content-around">
      <form action="../ambulancesBack/index.php" method="post">
        <button class="p-2 btn btn-light menu-link" name="rdv" value="<?= $dataSoc['id_societe'] ?>">Mes rendez-vous</button>
        <input type="hidden" name="template_id" value="<?= $dataSoc['template_id'] ?>">
      </form>
    </div>
  </div>
</div>