<?php

class CsvHandler
{
  private $url;
  private $mode = 'r+';
  private $tempArray = [];
  private $resultArray = [
  'head' => [],
  'body' => [],
  ];
  private $file;

  public function __construct($url)
  {
    $this->url = $url;

  }
  public function getArray()
  {
    $this
    ->getFile()
    ->fillTempArray()
    ->fillResultArray()
    ->handleResultArray()
    ->closeFile();

    return $this->resultArray;
  }

  private function getFile()
  {
    $this->file = fopen($this->url, $this->mode);

    return $this;
  }
  private function fillTempArray()
  {
    while (($data = fgetcsv($this->file, '', ",")) !== FALSE)
    {
      array_push($this->tempArray, $data);
    }

    return $this;
  }
  private function fillResultArray()
  {
    foreach($this->tempArray as $key => $value) {
      if ($key === 0) {
        foreach($value as $k => $v) {
          array_push($this->resultArray['head'], $v);
        }
      } else {
        array_push($this->resultArray['body'], []);
        foreach($value as $k => $v) {
          $length = count($this->resultArray['body']) - 1;
          $rowName = $this->resultArray['head'][$k];

          $this->resultArray['body'][$length][$rowName] = $v;
        };
      }
    }

    return $this;
  }
  private function handleResultArray()
  {
    array_shift($this->resultArray);
    $this->resultArray = $this->resultArray['body'];

    return $this;
  }
  private function closeFile()
  {
    fclose($this->file);

    return $this;
  }
}