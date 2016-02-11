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
        $cds = $_SESSION['list_of_CDs'];
        $search_string = $_POST['searchCDs'];
        $search_results = CD::searchArtist($cds, $search_string);

        return $app['twig']->render('search_results.html.twig', array('results'=>$search_results));
    });

    $app->get("/delete", function() use ($app){
        CD::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    return $app;
 ?>
