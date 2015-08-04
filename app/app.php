<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    $app = new Silex\Application();

    $app->get("/", function() {
        $porsche = new Car("pictures/porsche.jpg", "2014 Porsche 911", null, 7864);
        //$porsche->make_model = "2014 Porsche 911";
        //$porsche->price = 114991;
        //$porsche->miles = 7864;
        $porsche->setModel("Acura");
        $porsche->setMiles(10000);

        $ford = new Car("../pictures/ford.jpg","2001 Ford F450", 55995, 14241);
        /*$ford->make_model = "2011 Ford F450";
        $ford->price = 55995;
        $ford->miles = 14241;*/

        $lexus = new Car("pictures/lexus.jpg", "2013 Lexus RX 350", 44700, 20000);
        /*$lexus->make_model = "2013 Lexus RX 350";
        $lexus->price = 44700;
        $lexus->miles = 20000;*/

        $mercedes = new Car("pictures/mercedes.jpg", "Mercedes Benz CLS550", 39900, 37979);
        /*$mercedes->make_model = "Mercedes Benz CLS550";
        $mercedes->price = 39900;
        $mercedes->miles = 37979;*/

        $cars = array($porsche, $ford, $lexus,$mercedes);

        $output = "";
        foreach ($cars as $car) {
            $output = $output . "<div class='row'>
            <div class='col-md-6'>
                <img src=" . $car->getPicture() . ">
            </div>
                <div class='col-md-6'>
                    <p>" . $car->getModel() . "</p>
                    <p>By ". $car->getPrice() . "</p>
                    <p>$" . $car->getMiles() . "</p>
                </div>
            </div>
            ";
        }
        return $output;
    });

    $app->get("/car_search", function(){
        return"
        <!DOCTYPE html>
        <html>
        <head>
              <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
              <title>Find a Car</title>

        </head>
        <body>
            <div class='container'>
                <h1>Find a Car!</h1>
                <form action='/view_results'>
                    <div class='form-group'>
                        <label for='price'>Enter Maximum Price:</label>
                        <input id='price' name='price' class='form-control' type='number'>
                        <label for='mileage'>Enter Maximum Miles:</label>
                        <input id='mileage' name='mileage' class='form-control' type='number'>

                    </div>
                    <button type='submit' class='btn-success'>Submit</button>
                </form>
            </div>
        </body>
        </html>
        ";
    });

    $app->get("/view_results", function(){

        $porsche = new Car("/pictures/porsche.jpg", "2014 Porsche 911", null, 7864);
        //$porsche->make_model = "2014 Porsche 911";
        //$porsche->price = 114991;
        //$porsche->miles = 7864;
        $porsche->setModel("Acura");
        $porsche->setMiles(10000);

        $ford = new Car("/pictures/ford.jpg","2001 Ford F450", 55995, 14241);
        /*$ford->make_model = "2011 Ford F450";
        $ford->price = 55995;
        $ford->miles = 14241;*/

        $lexus = new Car("/pictures/lexus.jpg", "2013 Lexus RX 350", 44700, 20000);
        /*$lexus->make_model = "2013 Lexus RX 350";
        $lexus->price = 44700;
        $lexus->miles = 20000;*/

        $mercedes = new Car("/pictures/mercedes.jpg", "Mercedes Benz CLS550", 39900, 37979);
        /*$mercedes->make_model = "Mercedes Benz CLS550";
        $mercedes->price = 39900;
        $mercedes->miles = 37979;*/

        $cars = array($porsche, $ford, $lexus,$mercedes);

        $cars_matching_search = array();
            foreach ($cars as $car) {
              if (empty($_GET["price"]))
              {
                if ($car->getMiles() < $_GET["mileage"])
                {
                    array_push($cars_matching_search, $car);
                }

              }
                else if (empty($_GET["mileage"]))
                {
                    if($car->getPrice() < $_GET["price"])
                    {
                        array_push($cars_matching_search, $car);
                    }

                }
                else if($car->getPrice() < $_GET["price"] && $car->getMiles() < $_GET["mileage"])
                {
                  array_push($cars_matching_search, $car);
                }

            }
        if(empty($cars_matching_search))
        {
            $output = "<h1>There are no cars matching your search criteria!</h1>";
        } else {
            $output = "<h1>Search Results</h1>";
            foreach ($cars_matching_search as $car) {
                $output = $output . "<img src=" . $car->getPicture() . "</img>
                                    <p>" . $car->getModel() . "</p>
                                    <p>" . $car->getPrice() . "</p>
                                    <p>" . $car->getMiles() . "</p>";
            }

        }
        return $output;
    });

    return $app;
?>
