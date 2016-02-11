<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cd.php";

    session_start();
    if(empty($_SESSION['list_of_CDs'])){
        $_SESSION['list_of_CDs'] = array();
    }


    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path'=>__DIR__.'/../views'
    ));



    $app->get("/", function() use ($app) {
      $first_cd = new CD("The Birthday Concert", "Jaco Pastorius", "img/birthday.jpg");
      $second_cd = new CD("Blackstar", "David Bowie", "img/blackstar.jpg");
      $third_cd = new CD("Bright Size Life", "Pat Metheney", "img/bright.jpg");
      $fourth_cd = new CD("Once Upon a Time in Shaolin", "Wu-Tang Clan", "img/wutang.jpeg", 2000000);
      $fifth_cd = new  CD("Ten", "Pearl Jam", "img/ten.jpg", 5);
      $cds = array($first_cd, $second_cd, $third_cd, $fourth_cd, $fifth_cd);

      $cd_list = $cds;


        return $app['twig']->render('index.html.twig', array('cds'=> $cd_list));
    });

    return $app;
 ?>
