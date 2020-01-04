<?php
require_once './test/model/RequestHandler.php';
require_once './test/model/CsvHandler.php';
require_once './test/model/DBHandler.php';

$CsvHandler = new CsvHandler('./test/data/works.csv');
$parsedCsv = $CsvHandler->getArray();

$DB_NAME = 'works-1c';

function sendRequests($array, $operation, $dbname, $key = '')
{
  $DbHandler = new DbHandler($dbname);

  foreach($array as $item) {
    $profile = RequestHandler::getDBObj($item);
    $DbHandler->$operation($profile, $key ?? '');
  }
}

sendRequests($parsedCsv, 'upload', $DB_NAME);