<?php

class UserHandler
{
  private $userData;
  private $group;
  private $user;

  public function __construct($name, $username, $password, $email = '', $params = ['activate' => 1], $group = 2)
  {
    $this->userData = [
    'name' => $name,
    'username' => $username,
    'email' => $email,
    'password' => $password,
    'params' => $params,
    ];
    $this->group = $group;
    $this->user = new JUser();
  }
  public function save()
  {
    $this
    ->groupSet()
    ->bind()
    ->saveData();
  }

  private function groupSet()
  {
    $this->user->set('group', $this->group);

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
  }
}