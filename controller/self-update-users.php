<?php
require_once './test/model/RequestHandler.php';
require_once './test/model/CsvHandler.php';
require_once './test/model/DBHandler.php';
require_once './test/model/UserHandler.php';

$CsvHandler = new CsvHandler('./test/test.csv');
$parsedCsv = $CsvHandler->getArray();

function sendRequests($array, $operation, $dbname, $key = '')
{
  $DbHandler = new DbHandler($dbname);

  foreach($array as $item) {
    $profile = RequestHandler::getDBObj($item);
    $request = $DbHandler->$operation($profile, $key ?? '');

    if ($request && $operation === 'upload') {
      $user = new UserHandler($profile->name, $profile->id, $profile->id, $profile->email ?? '');
      $user->save();
    }
  }
}

sendRequests($parsedCsv, 'upload', 'jumi');
sendRequests($parsedCsv, 'update', 'jumi', 'id');