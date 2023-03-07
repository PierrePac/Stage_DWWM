<?php
ob_start();
(!isset($_SESSION))? session_start():"";


if (isset($_SESSION['profil']) && $_SESSION['profil']==2){
    (!isset($_SESSION['template']))? $_SESSION['template'] = 1:"";
    $dataSoc['id_societe'] = 1;
    $dataSoc['template_id'] = $_SESSION['template'];
    $dataSoc['societe_nom'] = 'Ambulances Royan';
    $dataSoc['societe_adress'] = '1 rue des rues';
    $dataSoc['societe_zip'] = '17200';
    $dataSoc['societe_ville'] = 'Royan';
    $dataSoc['societe_tel'] = '123456789';
    $dataSoc['societe_mail'] = 'infomail@mail.fr';
    $dataSoc['story_1'] = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
    $dataSoc['story_2'] = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
    $dataSoc['img_2'] = '../../media/89-img2-carre.webp';
    $dataSoc['img_3'] = '../../media/89-img3-fond_inscription.webp';
    $dataSoc['slider_1'] = '../../media/89-slider_1-pexels-antonio-batinić-4164378.webp';
    $dataSoc['slider_2'] = '../../media/89-slider_2-pexels-pixabay-263402 (1).webp';
    $dataSoc['slider_3'] = '../../media/89-slider_3-pexels-mikhail-nilov-8942484.webp';
    $dataSoc['map'] = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5580.678802522693!2d-1.0170524897353224!3d45.62391771865277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4801766f8e71c0d9%3A0xcf614f4f70730a0c!2sAmbulances%20Saint%20Bernard!5e0!3m2!1sfr!2sfr!4v1651141791374!5m2!1sfr!2sfr';
    $dataSoc['logo'] = '../../media/croix_ambulances.jpg';

    if(isset($_POST['nextTemplate'])){
        $_SESSION['template'] += 1;
        header("Refresh:0");
    }
    ($_SESSION['template'] >= 5)? $_SESSION['template'] = 1:"";
    require "include/head.php";
    ?>
        <a type="submit" class="btn btn-primary" href="../index.php" style="height: 35px; position:absolute; top:0; left:0; z-index:1000;">Retour profil</a>
        <form action="" method="post">
            <input type="submit" class="btn btn-primary" href="#" style="height: 35px; position:absolute; top:0; right:0; z-index:1000;" value="Template suivant" name="nextTemplate">   
        </form>
    <?php
} else{
    require "include/headSoc.php";
}
if($dataSoc['template_id'] == 1 || $dataSoc['template_id'] == 2 || $dataSoc['template_id'] == 3):
    ?><style><?php
    require "assets/theme_1.css";
    require "assets/theme_2.css";
    require "assets/theme_3.css";
    require "assets/style_template.css";
    ?></style><?php
    (isset($_SESSION['profil']) && $_SESSION['profil']==2)? require "include/contents/headerSoc.php":require "include/contents/header.php" ;
    require "include/contents/carousel.php";
    require "include/contents/contact.php";
    require "include/contents/nav.php";
    require "include/contents/story.php";
endif;
if($dataSoc['template_id'] == 4):
    ?><style><?php
    require "assets/theme_4.css";
    ?></style><?php
    require "include/contents/template_4.php";
endif;
require "include/contents/footer.php";
(isset($_SESSION['profil']) && $_SESSION['profil']==2)? require "include/foot.php": require "include/footSoc.php";
ob_end_flush();
?>