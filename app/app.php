<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cd.php";

    $app = new Silex\Application();

    $app->get("/", function() {
      $first_cd = new CD("The Birthday Concert", "Jaco Pastorius", "img/birthday.jpg");
      $second_cd = new CD("Blackstar", "David Bowie", "img/blackstar.jpg");
      $third_cd = new CD("Bright Size Life", "Pat Metheney", "img/bright.jpg");
      $fourth_cd = new CD("Once Upon a Time in Shaolin", "Wu-Tang Clan", "img/wutang.jpeg", 2000000);
      $cds = array($first_cd, $second_cd, $third_cd, $fourth_cd);

      $cd_list = "";
      foreach ($cds as $album) {
          $cd_list = $cd_list . "<div class='row'>
              <div class='col-md-6'>
                  <img src=" . $album->getCoverArt() . ">
              </div>
              <div class='col-md-6'>
                  <p>" . $album->getTitle() . "</p>
                  <p>" . $album->getArtist() . "</p>
                  <p>$" . $album->getPrice() . "</p>
              </div>
          </div>
          ";
      }
        return $cd_list;
    });

    return $app;
 ?>
