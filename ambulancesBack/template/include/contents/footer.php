<div class="footer">
    <form action="../ambulancesBack/index.php" method="post">
        <button class="p-2 btn btn-light menu-link" name="connexion" value="<?= $dataSoc['id_societe'] ?>">Connexion</button>
    </form>
    <span>&#124;</span>
    <form action="../ambulancesBack/emploi.php" method="post">
        <button class="p-2 btn btn-light menu-link" name="emploi" value="<?= $dataSoc['id_societe'] ?>">Offre d'emploi</button>
        <input type="hidden" name="template_id" value="<?= $dataSoc['template_id'] ?>">
        <input type="hidden" name="template_id" value="<?= $dataSoc['id_societe'] ?>">
    </form>
    <span>&#124;</span>
    <form action="../ambulancesBack/emploi.php" method="post">
        <button class="p-2 btn btn-light menu-link" name="emploi" value="<?= $dataSoc['id_societe'] ?>">Candidature spontanée</button>
        <input type="hidden" name="template_id" value="<?= $dataSoc['template_id'] ?>">
        <input type="hidden" name="template_id" value="<?= $dataSoc['id_societe'] ?>">
    </form>
    <span>&#124;</span>
    <a class="p-2 btn btn-light menu-link" href="#">
        Google Business
        <i class="bi bi-google"></i>
    </a>
    <span class="fb">&#124;</span>
    <a class="p-2 btn btn-light menu-link fb" href="#">
        Facebook
        <i class="bi bi-facebook"></i>
    </a>
</div>
</div>