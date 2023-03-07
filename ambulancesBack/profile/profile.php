<?php
require 'include/bdd.php';

// *********** Nav profil ****************
function navProfil($profil){
    $style0="";
    $style1="";
    ($profil==0)? $style1 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";
    ($profil==1)? $style0 = 'style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; border: 1px solid #1F85DE !important; background-color: #1F85DE !important; color: whitesmoke !important;"':" ";
    echo '<div class="card text-center main-card" id="main-card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <form action="" method="post">
                            <input type="submit" class="nav-link active" '. $style0 .' name="profil" value="Votre Profil"></input>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="" method="post">
                            <input type="submit" class="nav-link active" '. $style1 .' name="modifProfil" value="Modifier votre profil"></input>
                        </form>
                    </li>
                </ul>
            </div>';
}
function navProfilRH(){
    echo '<div class="card text-center main-card" id="main-card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <form action="" method="post">
                            <input type="submit" class="nav-link active" name="profil" value="Votre Profil"></input>
                        </form>
                    </li>
                </ul>
            </div>';
}

function infoSoc($fkSoc){
    $db = connectBd();
    $getSocinfo = $db->prepare("SELECT * FROM ambu_site_societe WHERE id_societe = $fkSoc");
    $getSocinfo->execute();
    $socFullinfo = $getSocinfo->fetch(PDO::FETCH_ASSOC);
    return $socFullinfo;
}

// ***** Formulaire de connexion/inscription ******

$formLogInSignIn = '<div class="inscription">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 text-center align-self-center">
      <div class="section pt-1 pt-sm-2 text-center">
        
      <label for="reg-log"><h6><span>S\'identifier </span>
      <span>S\'inscrire</span></h6></label>
        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
        <label for="reg-log"></label>
        <div class="card-3d-wrap mx-auto">
          <div class="card-3d-wrapper">
            <div class="card-front">
              <div class="center-wrap">
                <div class="section text-center">

                  <!-- S\'identifier -->

                  <h4 class="mb-4 pb-3">S\'identifier</h4>
                  <form action="include/connexion.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Email address">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="mdp" name="mdp" required placeholder="Password">
                    </div>
                    <input type="submit" class="btn btn-primary" name="identification"></input>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-back display">
              <div class="center-wrap">
                <div class="section text-center">
                  <!-- S\'inscrire -->
                  <h4 class="mb-4 pb-3">S\'inscrire</h4>
                  <form action="include/inscription.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Nom" id="nom" name="nom" pattern="[A-Za-z]{2,30}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Prénom"id="prenom" name="prenom" pattern="[A-Za-z]{2,30}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Adresse"id="adresse" name="adresse" pattern="[0-9]{1,3}(([,. ]?){1}[-a-zA-Zàâäéèêëïîôöùûüç\']+)*" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Code postal"id="zip" name="zip" pattern="[0-9]{5}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Ville"id="ville" name="ville" pattern="[A-Za-z]{2,30}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Numéro de téléphone"id="tel" name="tel"  pattern="[0-9]{10}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="E-mail" name="email" required>
                        </div>
                    </div>
                    <span style="color:red; font-size:0.8rem;">*au moins 8 caractères, un chiffre, une lettre majuscule et une minuscule</span>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="mdp" name="mdp" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required placeholder="mot de passe">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="verif-mdp" name="verifMdp" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required placeholder="confirmer votre mot de passe">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="inscription"></input>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>';
