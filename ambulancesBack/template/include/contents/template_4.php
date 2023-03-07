<body style="background-image: linear-gradient(rgba(3, 22, 54, 0.65), rgba(3, 22, 30, 0.65)), url('media/bg.jpg');">
<header>
            <h1 class="site-heading text-center text-faded d-none d-lg-block">
                <i class="fa-solid fa-star-of-life"></i>
                <span class="site-heading-lower"><?= $dataSoc['societe_nom'] ?></span>
            </h1>
        </header>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html"><i class="fa-solid fa-star-of-life"></i><?= $dataSoc['societe_nom'] ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item px-lg-4">
                            <form action="../ambulancesBack/index.php" method="post">
                                <button class="nav-link text-uppercase" name="rdv" value="<?= $dataSoc['id_societe'] ?>">Mes rendez-vous</button>
                                <input type="hidden" name="template_id" value="<?= $dataSoc['template_id'] ?>">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="page-section">
            <div class="container">
                <div class="product-item">
                    <div class="product-item-title d-flex">
                        <div class="bg-faded p-5 d-flex ms-auto rounded">
                            <h2 class="section-heading mb-0">
                                <span class="section-heading-lower">Conctactez nous</span>
                                <span class="section-heading-upper"><?= $dataSoc['societe_adress'] ?></span>
                                <span class="section-heading-upper"><?= $dataSoc['societe_zip'] ?> <?= $dataSoc['societe_ville'] ?></span>
                                <span class="section-heading-upper"><a href="mailto:<?= $dataSoc['societe_mail'] ?>"><?= $dataSoc['societe_mail'] ?></a></span>
                            </h2>
                        </div>
                    </div>
                    
                    <iframe class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5580.678802522693!2d-1.0170524897353224!3d45.62391771865277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4801766f8e71c0d9%3A0xcf614f4f70730a0c!2sAmbulances%20Saint%20Bernard!5e0!3m2!1sfr!2sfr!4v1651141791374!5m2!1sfr!2sfr" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="map"></iframe>
                    <div class="product-item-description d-flex me-auto">
                        <div class="bg-faded p-5 rounded">
                            <i class="fa-solid fa-phone"></i>
                            <a href="tel:+330">0<?= $dataSoc['societe_tel'] ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section">
            <div class="container">
                <div class="product-item">
                    <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="media/<?= $dataSoc['slider_1'] ?>" alt="..." />
                    <div class="product-item-description d-flex ms-auto">
                        <div class="bg-faded p-5 rounded"><p class="mb-0"><?= $dataSoc['story_1'] ?></p></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section">
            <div class="container">
                <div class="product-item">
                    <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="media/<?= $dataSoc['slider_2'] ?>" alt="..." />
                    <div class="product-item-description d-flex me-auto">
                        <div class="bg-faded p-5 rounded"><p class="mb-0"><?= $dataSoc['story_2'] ?></p></div>
                    </div>
                </div>
            </div>
        </section>

