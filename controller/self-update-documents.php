<?php
require_once './test/model/RequestHandler.php';
require_once './test/model/CsvHandler.php';
require_once './test/model/DBHandler.php';

$CsvHandler = new CsvHandler('./test/data/documents.csv');
$parsedCsv = $CsvHandler->getArray();

$DB_NAME = 'documents-1c';
$UPDATE_KEY = 'document_id';

function sendRequests($array, $operation, $dbname, $key = '')
{
  $DbHandler = new DbHandler($dbname);

  foreach($array as $item) {
    $profile = RequestHandler::getDBObj($item);
    $DbHandler->$operation($profile, $key ?? '');
  }
}

sendRequests($parsedCsv, 'upload', $DB_NAME);
sendRequests($parsedCsv, 'update', $DB_NAME, $UPDATE_KEY);