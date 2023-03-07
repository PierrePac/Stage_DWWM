<?php
if (!isset($_SESSION)) {
    session_start();
}
if(isset($_POST['id_societe'])){
    $idSoc = $_POST['id_societe'];
    $db = connectBd();
    $getSocInfos = $db->prepare("SELECT * FROM ambu_site_societe WHERE `id_societe` = $idSoc");
    $getSocInfos->execute();
    $dataSoc = $getSocInfos->fetch(PDO::FETCH_ASSOC);
} else{
    $dataSoc['societe_nom'] = 'Ambulances Royan';
    $dataSoc['societe_adress'] = '1 rue des rues';
    $dataSoc['societe_zip'] = '17200';
    $dataSoc['societe_ville'] = 'Royan';
    $dataSoc['societe_tel'] = '01.23.45.67.89';
    $dataSoc['societe_mail'] = 'infomail@mail.fr';
    $dataSoc['story_1'] = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
    $dataSoc['story_2'] = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
    $dataSoc['img_1'] = 'rectangle.webp';
    $dataSoc['img_2'] = 'carre.webp';
    $dataSoc['img_3'] = 'carre.webp';
    $dataSoc['map'] = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5580.678802522693!2d-1.0170524897353224!3d45.62391771865277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4801766f8e71c0d9%3A0xcf614f4f70730a0c!2sAmbulances%20Saint%20Bernard!5e0!3m2!1sfr!2sfr!4v1651141791374!5m2!1sfr!2sfr';
    $dataSoc['logo'] = 'croix_ambulances.webp';
    $dataSoc['slider_1'] =  '';
    $dataSoc['slider_2'] =  '';
    $dataSoc['slider_3'] =  '';
}

    require "include/contents/header.php";
    require "include/contents/contact.php";
    require "include/contents/nav.php";
    require "include/contents/story.php";
    require "include/contents/footer.php";
    require "include/foot.php";