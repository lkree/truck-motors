<?php
require_once './test/model/RequestHandler.php';
require_once './test/model/CsvHandler.php';
require_once './test/model/DBHandler.php';
require_once './test/model/UserHandler.php';

$CsvHandler = new CsvHandler('./test/data/users.csv');
$parsedCsv = $CsvHandler->getArray();

$DB_NAME = 'users-1c';
$UPDATE_KEY = 'client_id';

function sendRequests($array, $operation, $dbname, $key = '')
{
  $DbHandler = new DbHandler($dbname);

  foreach($array as $item) {
    $profile = RequestHandler::getDBObj($item);
    $request = $DbHandler->$operation($profile, $key ?? '');

    if ($request) {
      $user = new UserHandler($profile->name, $profile->client_id, $profile->client_id, $profile->client_id, $profile->email, $profile->phone);
      $user->save();
    }
  }
}

sendRequests($parsedCsv, 'upload', $DB_NAME);
sendRequests($parsedCsv, 'update', $DB_NAME, $UPDATE_KEY);