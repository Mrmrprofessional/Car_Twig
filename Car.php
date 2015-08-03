<?php
class Car
{
    public $picture;
    private $make_model;
    private $price;
    private $miles;


   function __construct($picture, $make_model, $price = null, $miles)
   {
     $this->picture = $picture;
     $this->make_model = $make_model;
     $this->price = $price;
     $this->miles = $miles;

     if (is_null($price)){
         $this->price = 50000;
       }
   }

   function getModel()
   {
     return $this->make_model;
   }
   function getPrice()
   {
     return $this->price;
   }
   function getMiles()
   {
     return $this->miles;
   }
 }
$porsche = new Car("pictures/porsche.jpg", "2014 Porsche 911", null, 7864);
//$porsche->make_model = "2014 Porsche 911";
//$porsche->price = 114991;
//$porsche->miles = 7864;

$ford = new Car("pictures/ford.jpg","2001 Ford F450", 55995, 14241);
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
?>


<!DOCTYPE html>
<html>
<head>
    <title>Your Car Dealership's Homepage</title>
</head>
<body>
    <h1>Your Car Dealership</h1>
    <ul>
      <?php
        if (empty($cars_matching_search))
        {
          echo "There are no cars matching your search!";
        }
        else
            {
            foreach ($cars_matching_search as $car) {
              $car_model = $car->getModel();
              $car_price = $car->getPrice();
              $car_miles = $car->getMiles();
              echo "<img src='$car->picture'>";
              echo "<li> $car_model </li>";
              echo "<ul>";
                echo "<li> $car_price </li>";
                echo "<li> Miles: $car_miles </li>";
              echo "</ul>";
            }
        }
      ?>
    </ul>
</body>
</html>
