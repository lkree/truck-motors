<?php

class ArrayHandler
{
  private $newData;
  private $oldData;
  private $uniqueArray = [];
  private $resultArray = [];

  public function __construct($oldData, $newData)
  {
    $this->newData = $newData;
    $this->oldData = $oldData;
  }
  public function getNewValues()
  {
    $this
    ->clearData()
    ->createUniqueArray()
    ->handleArray();

    return $this->resultArray;
  }
  public function getSameValues()
  {
    $this
    ->clearData()
    ->createSameArray()
    ->handleArray();

    return $this->resultArray;
  }
  static function keyFilter(array $array, string $key)
  {
    $resultArray = [];
    foreach($array as $v) array_push($resultArray, $v->$key);
    return $resultArray;
  }

  private function createUniqueArray()
  {
    $this->uniqueArray = array_filter($this->newData, function($b)
    {
      if (!in_array($b, $this->oldData)) return $b;
    });

    return $this;
  }
  private function createSameArray()
  {
    $this->uniqueArray = array_filter($this->newData, function($b)
    {
      if (in_array($b, $this->oldData)) return $b;
    });

    return $this;
  }
  private function handleArray()
  {
    foreach($this->uniqueArray as $item)
    {
      array_push($this->resultArray, $item);
    }

    return $this;
  }
  private function clearData()
  {
    $this->uniqueArray = [];
    $this->resultArray = [];

    return $this;
  }
}