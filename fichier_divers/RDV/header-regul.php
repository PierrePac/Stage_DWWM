<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambulance Resa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

    <header class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <div class="container-fluid">
                <a class="navbar-brand text-dark" href="#">Ambulances RESA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="espace-regul.php">En attente de validation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="espace-regul-saisies.php">Transports validés</a>
                        <li class="nav-item">
                            <a class="nav-link" href="deconnexion.php">Se déconnecter</a>
                        </li>

                    </ul>
                    <p class="text-white">Bienvenue dans votre espace membre <?= $info['prenom']; ?></p>

                </div>
            </div>
        </nav>
    </header>