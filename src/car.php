<?php
class Car
{
    private $picture;
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

   function getPicture()
   {
       return $this->picture;
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

   function setMiles($new_miles)
   {
     $this->miles = $new_miles;
   }

   function setModel($new_model)
   {
     $this->make_model = $new_model;
   }

   function setPrice($new_price)
   {
     $this->price = $new_price;
   }

   function save()
    {
        array_push($_SESSION['cars'], $this);
    }

    static function getAll()
    {
        return $_SESSION['cars'];
    }


}
 ?>
