<?php

class UserHandler
{
  private $userData;
  private $groups;
  private $user;

  public function __construct($name, $username, $password, $client_id, $email, $phone, $params = ['activate' => 1], $groups = ['2' => 2])
  {
    $this->userData = [
    'name' => $name,
    'username' => $username,
    'client_id' => $client_id,
    'email' => $email,
    'phone' => $phone,
    'password' => $password,
    'params' => $params,
    ];
    $this->groups = $groups;
    $this->user = new JUser();
  }
  public function save()
  {
    $this
    ->groupSet()
    ->bind()
    ->saveData();
  }

  static function isUserLogin()
  {
    return !!JFactory::getUser()->id;
  }
  static function getUserId()
  {
    return JFactory::getUser()->id ?? NULL;
  }
  static function getClientId()
  {
    return JFactory::getUser()->client_id ?? NULL;
  }
  static function getName()
  {
    return JFactory::getUser()->name ?? NULL;
  }
  static function getEmail()
  {
    return JFactory::getUser()->email ?? NULL;
  }
  static function getPhone()
  {
    return JFactory::getUser()->phone ?? NULL;
  }
  static function getUsername()
  {
    return JFactory::getUser()->username ?? NULL;
  }
  static function getUserInfo()
  {
    if (!UserHandler::isUserLogin()) return NULL;
    return [
    'name' => UserHandler::getName(),
    'phone' => UserHandler::getPhone(),
    'email' => UserHandler::getEmail(),
    'id' => UserHandler::getUserId(),
    'username' => UserHandler::getUsername(),
    ];
  }

  private function groupSet()
  {
    $this->user->groups = $this->groups;

    return $this;
  }
  private function bind()
  {
    $this->user->bind($this->userData);

    return $this;
  }
  private function saveData()
  {
    $this->user->save();

    return $this;
  }
}