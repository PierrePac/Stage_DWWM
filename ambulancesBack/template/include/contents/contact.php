<div class="img_1">
        <img
          src="media/<?= $dataSoc['img_2'] ?>"
          alt=""
          class="img-fluid"
        />
      </div>
      <div class="adresse">
        <p><?= $dataSoc['societe_adress'] ?></p>
        <p><?= $dataSoc['societe_zip'] ?> <?= $dataSoc['societe_ville'] ?></p>
        <br />
        <i class="bi bi-envelope"></i>
        <a href="mailto:<?= $dataSoc['societe_mail'] ?>"><?= $dataSoc['societe_mail'] ?></a>
      </div>
      <div class="tel">
        <a href="tel:+330<?= $dataSoc['societe_tel'] ?>">0<?= $dataSoc['societe_tel'] ?></a>
        <em class="bi bi-telephone"></em>
      </div>
      <div class="plan">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5580.678802522693!2d-1.0170524897353224!3d45.62391771865277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4801766f8e71c0d9%3A0xcf614f4f70730a0c!2sAmbulances%20Saint%20Bernard!5e0!3m2!1sfr!2sfr!4v1651141791374!5m2!1sfr!2sfr"
          style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="map"></iframe>
      </div>