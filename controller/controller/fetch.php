<?
if ($_GET['isLogin']) die(!!JFactory::getUser()->id);
if ($_GET['getUserId']) die(JFactory::getUser()->id);
if ($_GET['getClientId']) die(JFactory::getUser()->client_id);
if ($_GET['getUserName']) die(JFactory::getUser()->username);
if ($_GET['getUserInfo']) {
  require_once './test/model/UserHandler.php';
  die(json_encode(UserHandler::getUserInfo()));
}
if ($_GET['getCars']) {
  require_once './test/model/DBHandler.php';
  $db = new DBHandler('cars-1c');
  die($db->getCars());
}
if ($_GET['getDocuments']) {
  require_once './test/model/DBHandler.php';
  $db = new DBHandler('documents-1c');
  die($db->getDocuments());
}
if ($_GET['getAllWorks']) {
  require_once './test/model/DBHandler.php';
  require_once './test/model/ArrayHandler.php';
  $documents = json_decode((new DBHandler('documents-1c'))->getDocuments());
  $documentIds = ArrayHandler::keyFilter($documents, 'document_id');
  $works = [];
  $db = new DBHandler('works-1c');
  foreach($documentIds as $v) array_push($works, $db->getWorks($v));
  die(json_encode($works));
}
if ($_GET['getWork']) {
  if (!JFactory::getUser()->id) die();
  require_once './test/model/DBHandler.php';
  $documentId = $_GET['document_id'];
  $db = new DBHandler('works-1c');
  $works = $db->getWorks($documentId);
  die(json_encode($works));
}
die();