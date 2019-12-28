<?php

class DBHandler
{
  private $sittings;
  private $dbname;

  public function __construct($dbname)
  {
    $this->sittings = new JConfig();
    $this->dbname = $dbname;
  }
  public function upload($profile)
  {
    try {
      JFactory::getDbo()->insertObject($this->sittings->dbprefix . $this->dbname, $profile);
      return true;
    } catch(Exception $e) {
      return false;
    }
  }
  public function update($profile, $key = '')
  {
    try {
      JFactory::getDbo()->updateObject($this->sittings->dbprefix . $this->dbname, $profile, $key ? $key : '');
      return true;
    } catch(Exception $e) {
      return false;
    }
  }
};