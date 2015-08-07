<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/cd.php";

    session_start();

    if(empty($_SESSION['list_of_cds'])) {
        $_SESSION['list_of_cds'] = array();
    }

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('main_page.html.twig', array('all_cds' => CD::getAll()));
    });

    $app->get("/add_form", function() use ($app) {
        return $app['twig']->render('add_form.html.twig');
    });
    $app->get("/search_form", function() use ($app) {
        return $app['twig']->render('search_form.html.twig');
    });
    $app->get("/search_results", function() use ($app) {
        $allCD = CD::getAll();
        $foundCD = array();
        $artistSearch = $_GET['artist'];
        foreach( $allCD as $cd){
            $actualCD = strtolower($cd->getArtist());
            $actualSearch = strtolower($artistSearch);
            if(strpos($actualCD, $actualSearch) != false) {
                array_push($foundCD, $cd);
            }
        }
        return $app['twig']->render('search_results.html.twig', array('found' => $foundCD));
    });
    $app->post("/add", function() use ($app) {
        $newCD = new CD($_POST['artist'], $_POST['album'], $_POST['cover']);
        $newCD->save();
        return $app['twig']->render('added.html.twig', array('newCd' => $newCD));
    });

    return $app;
?>
