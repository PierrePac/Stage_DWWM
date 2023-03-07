<?php

require "bdd.php";

session_start();

// deconnexion

if (isset($_POST['deconnexion'])) {
    disconnectSession();
  }