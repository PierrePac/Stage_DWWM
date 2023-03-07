<?php
if (!isset($_SESSION)) {
    session_start();
} else {
    session_destroy();
    session_start();
}
require "../ambulancesBack/include/connexion.php";
$dataSoc = getWebsite(__DIR__);
$_SESSION['id_societe'] = $dataSoc['id_societe'];
require "../ambulancesBack/template/templates.php";


