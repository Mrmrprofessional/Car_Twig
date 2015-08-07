<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    session_start();

    if (empty($_SESSION['cars'])) {
        $_SESSION['cars'] = array();
        $porsche = new Car("pictures/porsche.jpg", "2014 Porsche 911", null, 7864);
        $porsche->setModel("Acura");
        $porsche->setMiles(10000);
        $ford = new Car("pictures/ford.jpg","2001 Ford F450", 55995, 14241);
        $lexus = new Car("pictures/lexus.jpg", "2013 Lexus RX 350", 44700, 20000);
        $mercedes = new Car("pictures/mercedes.jpg", "Mercedes Benz CLS550", 39900, 37979);
        $porsche->save();
        $ford->save();
        $lexus->save();
        $mercedes->save();
    }



    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {



        return $app['twig']->render('home.html.twig', array('cars' => Car::getAll()));
    });

    $app->get("/car_search", function() use ($app) {
        return $app['twig']->render('search.html.twig');

    });

    $app->get("/view_results", function() use ($app) {

        $cars_matching_search = array();
            foreach ($cars as $car) {
              if (empty($_GET["price"]))
              {
                if ($car->getMiles() < $_GET["miles"])
                {
                    array_push($cars_matching_search, $car);
                }

              }
                else if (empty($_GET["miles"]))
                {
                    if($car->getPrice() < $_GET["price"])
                    {
                        array_push($cars_matching_search, $car);
                    }

                }
                else if($car->getPrice() < $_GET["price"] && $car->getMiles() < $_GET["miles"])
                {
                  array_push($cars_matching_search, $car);
                }

            }

        return $app['twig']->render('results.html.twig', array('cars_matching_search' => $cars_matching_search)) ;
    });

    $app->post("/new_car", function() use ($app) {
            $car = new Car($_POST['picture'], $_POST['model'], $_POST['price'], $_POST['miles']);
            $car->save();
            return $app["twig"]->render('add_car.html.twig', array('newcar' => $car));
        });
    return $app;
?>
