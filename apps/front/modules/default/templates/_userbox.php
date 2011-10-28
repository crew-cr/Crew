<ul>
  <?php if ($user->isAuthenticated()) : ?>
  <li class="username"><?php echo $user ?></li>
  <li><?php echo link_to('Help', 'http://github.com/KuiKui/Crew/wiki') ?></li>
  <li class="last"><?php echo link_to('Log Out', url_for('@sf_guard_signout')) ?></li>
  <?php else: ?>
  <li class="last"><?php echo link_to('Log In', url_for('@sf_guard_signin')) ?></li>
  <?php endif;  ?>
</ul>
