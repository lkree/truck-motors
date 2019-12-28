<?php
require_once './test/model/RequestHandler.php';
require_once './test/model/CsvHandler.php';
require_once './test/model/DBHandler.php';

$CsvHandler = new CsvHandler('./test/test.csv');
$parsedCsv = $CsvHandler->getArray();

function sendRequests($array, $operation, $dbname, $key = '')
{
  $DbHandler = new DbHandler($dbname);

  foreach($array as $item) {
    $profile = RequestHandler::getDBObj($item);
    $DbHandler->$operation($profile, $key ?? '');
  }
}

sendRequests($parsedCsv, 'upload', 'jumi');
sendRequests($parsedCsv, 'update', 'jumi', 'id');