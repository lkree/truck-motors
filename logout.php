<?php
$user = JFactory::getUser();
$app = JFactory::getApplication();
$app->logout($user->id);
echo 1;