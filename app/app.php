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
    //   $first_cd = new CD("The Birthday Concert", "Jaco Pastorius", "img/birthday.jpg");
    //   $second_cd = new CD("Blackstar", "David Bowie", "img/blackstar.jpg");
    //   $third_cd = new CD("Bright Size Life", "Pat Metheney", "img/bright.jpg");
    //   $fourth_cd = new CD("Once Upon a Time in Shaolin", "Wu-Tang Clan", "img/wutang.jpeg", 2000000);
    //   $fifth_cd = new  CD("Ten", "Pearl Jam", "img/ten.jpg", 5);
    //   $cds = array($first_cd, $second_cd, $third_cd, $fourth_cd, $fifth_cd);

        $cd_list = $_SESSION['list_of_CDs'];

        return $app['twig']->render('index.html.twig', array('cds'=> $cd_list));
    });

    $app->get("/add_CD", function() use ($app) {

        return $app['twig']->render('add_CD.html.twig');
    });

    $app->post("/new_CD", function() use ($app){
        $newCD = new CD($_POST['title'], $_POST['artist'], $_POST['cover_image']);
        $newCD->saveCD();

        return $app['twig']->render('new_CD.html.twig', array('newCD'=>$newCD));
    });

    $app->post("/search", function() use ($app){
        $cds= $_SESSION['list_of_CDs'];
        $search_results = array();
        $found= (strtoupper($_POST['searchCDs']));
        $search_terms = explode(" ", $found);
        var_dump($search_terms);

        foreach($search_terms as $search_term){
            foreach($cds as $cd){
                if (strpos(strtoupper($cd->getArtist()), $search_term) !== false)
                {
                    array_push($search_results, $cd);
                }
            }
        }
        return $app['twig']->render('search_results.html.twig', array('results'=>$search_results));
    });

    $app->get("/delete", function() use ($app){
        CD::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    return $app;
 ?>
