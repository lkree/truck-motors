<?php
require_once './test/model/DatabaseHandle.php';
require_once './test/model/CsvHandler.php';


$CsvHandler = new CsvHandler('./test/test.csv');
$arrayFromCsv = $CsvHandler->getArray();

$request = new DatabaseHandle('jumi', $arrayFromCsv);
$request->upload();
$request->update('id');





//require_once './test/model/ArrayHandler.php';
//
//$oldData = ['a', 'b', 'c', 'd'];
//$newData = ['a', 'b', 'c', 'd', 'e', 'f'];
//
//$arrayHandle = new ArrayHandler($oldData, $newData);
//$array = $arrayHandle->getNewValues();
//var_dump($array);
//echo '<br>';
//$array = $arrayHandle->getSameValues();
//var_dump($array);






//$user = new JUser();
//
//$userData = [
//  'name' => 'test',
//  'username' => 'test',
//  'email' => 'test@test.test',
//  'password' => 'test',
//  'params' => ['activate' => 1],
//];
//
//$user->set('group', 2);
//
//$user->bind($userData);
//$user->save();


//$db = JFactory::getDbo();
//
//$query = $db
//  ->getQuery(true)
//  ->select('id') //$query->select($db->quoteName('name'))
//  ->from($db->quoteName('t6sld_users'));
//
//$db->setQuery($query);
//$result = $db->loadObjectList();
//$resultArray = [];
//
//foreach($result as $item)
//{
//  array_push($resultArray, $item->id);
//}
//
//
//
//$a = array_filter($resultArray, function($b) {
//  $tempArray = [629, 632, 631];
//  if (!in_array($b, $tempArray)) return $b;
//});
//
//$tempArray = [];
//foreach($a as $item)
//{
//  array_push($tempArray, $item);
//}
//
//var_dump($tempArray);


////// Connect to database
////$db = JFactory::getDbo();
////$query = $db->getQuery(true);
////
////// Build the query
////$query->select($db->quoteName(array('id', 'filePath')));
////$query->from($db->quoteName('image'));
//////$query->where($db->quoteName('introtext') . ' LIKE '. $db->quote('%Joomla%'));
////$query->order('ordering ASC');
////$query->setLimit('10');
////
////$db->setQuery($query);
////$results = $db->loadObjectList();
////
////// Print the result
////foreach($results as $result){
////  echo '<h3>' . $result->title . '</h3>';
////  echo $result->introtext;
////}
//
////$get_params = $_GET['name'];
////var_dump($get_params);
////
////// безопасное соединение с базой данных
////$db = & JFactory::getDBO();
////
////// сам запрос
////$query = "SELECT * FROM t6sld_jumi";
////
////// запрос при котором происходит замещение "#__" на префикс из файла конфигурации
////$db->setQuery($query);
////
////// преобразует выборку в массив объектов
////$result = $db->loadObjectList();
//////
//////foreach($result as $k) {
//////  echo($k->custom_script);
//////}
//
////$profile = new stdClass();
////$profile->title = 'test-title';
////$profile->alias='test';
////$profile->path='/test/alias';
////$profile->custom_script='test()';
////
////// Insert the object into the user profile table.
////$result = JFactory::getDbo()->insertObject('t6sld_jumi', $profile);
//
//defined('_JEXEC') or die;
//
//use Joomla\Filesystem\File;
//use Joomla\CMS\Http\HttpFactory;
//use Joomla\Registry\Registry;
//
//class ModExampleHelper
//{
//  public static function getData($params)
//  {
//    // Source URL not set.
//    if (!$params->get('url'))
//    {
//      var_dump(1);
//      return array();
//    }
//
//    $file = JPATH_ADMINISTRATOR . '/cache/mod_example/' . md5($params->get('url'));
//
//    // File exists and is fresh.
//    if (filemtime($file) > microtime(true) - $params->get('refreshInterval', 60))
//    {
//      return json_decode(file_get_contents($file));
//    }
//
//    // Some servers may block requests without user agent.
//    $options  = $params->get('userAgent') ? new Registry(array('userAgent' => $params->get('userAgent'))) : null;
//
//    // Retrieve the data.
//    $response = HttpFactory::getHttp($options)->get($params->get('url'));
//
//    // Check that response is valid.
//    if ($response->code === 200 && $response->body)
//    {
//      // Save data based on CSV structure. This could be configurable.
//      foreach ($data = str_getcsv($response->body, "\n") as $key => $row)
//      {
//        $data[$key] = str_getcsv($row, ';');
//      }
//
//      // Save new data to file.
//      File::write($file, json_encode($data));
//
//      return $data;
//    }
//
//    // Retrieving data failed, return data from old file.
//    if ($file)
//    {
//      return json_decode(file_get_contents($file));
//    }
//
//    return array();
//  }
//}
//
////$data = ModExampleHelper::getData('asd');
//$file = fopen('./test/test.csv', 'r+');
//$array = [];
//$resultArray = [
//  'head' => [],
//  'body' => [],
//];
//while (($data = fgetcsv($file, '', ",")) !== FALSE)
//{
//  array_push($array, $data);
//}
//foreach($array as $key => $value) {
//  if ($key === 0) {
//    foreach($value as $k => $v) {
//      array_push($resultArray['head'], $v);
//    }
//  } else {
//      array_push($resultArray['body'], []);
//      foreach($value as $k => $v) {
//        $length = count($resultArray['body']) - 1;
//        $rowName = $resultArray['head'][$k];
//
//        $resultArray['body'][$length][$rowName] = $v;
//      };
//  }
//}
//array_shift($resultArray);
//$resultArray = $resultArray['body'];
//$sittings = new JConfig();
//$dbname = 'jumi';
//
//foreach($resultArray as $item) {
//  $profile = new stdClass();
//  $profile->id = $item['id'];
//  $profile->title = $item['title'];
//  $profile->alias = $item['alias'];
//  $profile->path = $item['path'];
//  $profile->custom_script = $item['custom_script'];
//
//// Insert the object into the user profile table.
//  try {
//    $result = JFactory::getDbo()->insertObject($sittings->dbprefix . $dbname, $profile, 'id');
//  } catch(Exception $e) {
//    echo($e->getMessage());
//  };
//
//  var_dump($result);
//}