<?php

class DBHandler
{
  private $sittings;
  private $dbname;
  private $db;

  public function __construct($dbname)
  {
    $this->sittings = new JConfig();
    $this->dbname = $dbname;
    $this->db = JFactory::getDbo();
  }
  public function upload($profile)
  {
    try {
      $this->db->insertObject($this->sittings->dbprefix . $this->dbname, $profile);
      return true;
    } catch(Exception $e) {
      return false;
    }
  }
  public function update($profile, $key = '')
  {
    try {
      $this->db->updateObject($this->sittings->dbprefix . $this->dbname, $profile, $key ? $key : '');
      return true;
    } catch(Exception $e) {
      return false;
    }
  }
  public function getItems($props)
  {
    $query = $this->db->getQuery(true);

    $query
    ->select($this->db->quoteName(array($props['select'])))
    ->from($this->db->quoteName($this->sittings->dbprefix . $this->dbname))
    ->where($this->db->quoteName());
  }
  public function getAllCars()
  {
    $query = $this->db->getQuery(true);

    $query
    ->select('*')
    ->from($this->db->quoteName($this->sittings->dbprefix . $this->dbname))
    ->where($this->db->quoteName('client_id') . ' = ' . $this->db->quote(JFactory::getUser()->client_id));

    $this->db->setQuery($query);

    $results = $this->db->loadObjectList();
    return json_encode($results);
  }
  public function getCar($car_id)
  {
    $query = $this->db->getQuery(true);

    $query
    ->select('*')
    ->from($this->db->quoteName($this->sittings->dbprefix . $this->dbname))
    ->where($this->db->quoteName('client_id') . ' = ' . $this->db->quote(JFactory::getUser()->client_id))
    ->where($this->db->quoteName('car_id') . ' = ' . $this->db->quote($car_id));

    $this->db->setQuery($query);

    $results = $this->db->loadObjectList();
    return json_encode($results);
  }
  public function getAllDocuments()
  {
    $query = $this->db->getQuery(true);

    $query
    ->select('*')
    ->from($this->db->quoteName($this->sittings->dbprefix . $this->dbname))
    ->where($this->db->quoteName('client_id') . ' = ' . $this->db->quote(JFactory::getUser()->client_id));

    $this->db->setQuery($query);

    $results = $this->db->loadObjectList();
    return json_encode($results);
  }
  public function getDocument($carId)
  {
    $query = $this->db->getQuery(true);

    $query
    ->select('*')
    ->from($this->db->quoteName($this->sittings->dbprefix . $this->dbname))
    ->where($this->db->quoteName('client_id') . ' = ' . $this->db->quote(JFactory::getUser()->client_id))
    ->where($this->db->quoteName('car_id') . ' = ' . $this->db->quote($carId));

    $this->db->setQuery($query);

    $results = $this->db->loadObjectList();
    return json_encode($results);
  }
  public function getWorks($documentId)
  {
    $query = $this->db->getQuery(true);

    $query
    ->select('*')
    ->from($this->db->quoteName($this->sittings->dbprefix . $this->dbname))
    ->where($this->db->quoteName('document_id') . ' = ' . $this->db->quote($documentId));

    $this->db->setQuery($query);

    $results = $this->db->loadObjectList();
    return $results;
  }
};