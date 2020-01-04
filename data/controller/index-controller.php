<?php
$user = JFactory::getUser();

if ($user->name === NULL) return NULL;
else require_once './customer/view/index.php';