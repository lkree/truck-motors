<?php
defined('_JEXEC') or die;

$user = JFactory::getUser();

if ($user->name === NULL) return NULL;
else
{
  require_once './customer/model/DBHandler.php';

  $doc_db = new DBHandler('documents-1c');
  $cars_db = new DBHandler('cars-1c');

  $cars = json_decode($cars_db->getAllCars());
  $car_id = $_GET['ci'];
  $currentDocument = 'Все документы';

  if ($car_id)
  {
    $documents = json_decode($doc_db->getDocument($car_id));
    $car = json_decode($cars_db->getCar($car_id));
    $currentDocument = $car[0]->model;
  }
  else $documents = json_decode($doc_db->getAllDocuments());

  require_once './customer/view/history.php';
}