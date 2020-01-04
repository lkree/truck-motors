<?
require_once './customer/actions/action-types.php';

switch($_GET['req']) {
  case $IS_LOGIN: die(!!JFactory::getUser()->id);
  case $GET_USER_ID: die(JFactory::getUser()->id);
  case $GET_CLIENT_ID: die(JFactory::getUser()->client_id);
  case $GET_USER_NAME: die(JFactory::getUser()->username);
  case $GET_NAME: die(JFactory::getUser()->name);
  case $GET_PHONE: die(JFactory::getUser()->phone);
  case $GET_USER_INFO:
    require_once './customer/model/UserHandler.php';
    die(json_encode(UserHandler::getUserInfo()));
  case $GET_CARS:
    require_once './customer/model/DBHandler.php';
    $db = new DBHandler('cars-1c');
    die($db->getAllCars());
  case $GET_ALL_DOCUMENTS:
    require_once './customer/model/DBHandler.php';
    $db = new DBHandler('documents-1c');
    die($db->getAllDocuments());
  case $GET_DOCUMENT:
    if (!JFactory::getUser()->id) die();
    require_once './customer/model/DBHandler.php';
    $carId = $_GET['car_id'];
    $db = new DBHandler('documents-1c');
    die($db->getDocument($carId));
  case $GET_ALLL_WORKS:
    require_once './customer/model/DBHandler.php';
    require_once './customer/model/ArrayHandler.php';
    $documents = json_decode((new DBHandler('documents-1c'))->getDocuments());
    $documentIds = ArrayHandler::keyFilter($documents, 'document_id');
    $works = [];
    $db = new DBHandler('works-1c');
    foreach($documentIds as $v) array_push($works, $db->getWorks($v));
    die(json_encode($works));
  case $GET_WORK:
    if (!JFactory::getUser()->id) die();
    require_once './customer/model/DBHandler.php';
    $documentId = $_GET['document_id'];
    $db = new DBHandler('works-1c');
    $works = $db->getWorks($documentId);
    die(json_encode($works));
  case 'test': die($_GET['test']);
}
die('unhandled response or unknown request');