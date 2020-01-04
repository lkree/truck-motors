<ul class="customer-info">
  <?php if ($user->name) echo(
    '<li class="customer-info__item">
      <p class="customer-info__item-header">Имя:</p>
      <p class="customer-info__item-content">'.$user->name.'</p></li>'
  ) ?>
  <?php if ($user->email) echo(
  '<li class="customer-info__item">
      <p class="customer-info__item-header">Email:</p>
      <p class="customer-info__item-content">'.$user->email.'</p></li>'
  ) ?>
  <?php if ($user->phone) echo(
  '<li class="customer-info__item">
      <p class="customer-info__item-header">Телефон:</p>
      <p class="customer-info__item-content">'.$user->phone.'</p></li>'
  ) ?>
</ul>
<a href="<?=$logoutUrl   = 'index.php?option=com_users&task=user.logout&'. JSession::getFormToken() .'=1';?>">Logout</a>