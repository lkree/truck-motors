<?php

class RequestHandler
{
  static function getDBObj($item)
  {
    $profile = new stdClass();
    foreach($item as $k => $v) $profile->$k = $item[$k];

    return $profile;
  }
};

//foreach($this->data as $item) {
//  $this->profile = new stdClass();
//  foreach($item as $k => $v) $this->profile->$k = $item[$k];
//
//  try {
//    $this->$cb();
//  } catch(Exception $e) {
//    return false;
//  }
//}