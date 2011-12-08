<ul id="userbox">
  <?php if ($isAuthenticated) : ?>
    <li class="username">
      <img class="avatar" src="<?php echo $sf_user->getProfile()->getAvatarUrl(20) ?>" />
      <?php echo link_to($user, url_for('user/view?id='.$user->getId())) ?>
    </li>
    <li><?php echo link_to('Home', '@homepage') ?></li>
    <li><?php echo link_to('Help', 'http://github.com/pmsipilot/Crew/wiki') ?></li>
    <li><?php echo link_to('Log Out', url_for('@sf_guard_signout')) ?></li>
  <?php else: ?>
    <li><?php echo link_to('Log In', url_for('@sf_guard_signin')) ?></li>
  <?php endif;  ?>
</ul>
