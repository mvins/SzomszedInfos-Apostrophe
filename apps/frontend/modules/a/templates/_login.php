<ul class="a-ui a-controls a-login">
  <?php if ($sf_user->isAuthenticated()): ?>
    <li class="a-login-user"><?php echo __('You are logged in as', null, 'apostrophe') ?> <span><?php echo $sf_user->getGuardUser()->getUsername() ?></span></li>
  <?php include_partial('a/language') ?>
    <li class="a-login-logout"><?php echo link_to(__('Log Out', null, 'apostrophe'), sfConfig::get('app_a_actions_logout', 'sfGuardAuth/signout'), array('class' => 'a-btn',)) ?></li>
  <?php else: ?>
  <?php include_partial('a/language') ?>
  <?php // You can easily turn off the 'Log In' link via app.yml ?>
  <?php if (sfConfig::get('app_a_login_link', true)): ?>
        <li class="a-login-login last">
    <?php echo link_to('Login', GoogleOpenID::getLoginUrl(), array('class' => 'googleLogin a-btn')) ?>
      </li>
  <?php endif ?>
  <?php endif ?>
</ul>