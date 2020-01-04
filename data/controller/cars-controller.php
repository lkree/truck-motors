<?php

$user = JFactory::getUser();

if ($user->name === NULL) return NULL;
else
{
  require_once './customer/model/DBHandler.php';

  $db = new DBHandler('cars-1c');
  $cars = json_decode($db->getAllCars());

  require_once './customer/view/cars.php';
}