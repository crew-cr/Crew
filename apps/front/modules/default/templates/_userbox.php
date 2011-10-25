<ul>
  <?php if ($user->isAuthenticated()) : ?>
  <li><?php echo link_to(sprintf('Log Out (%s)', $user), url_for('@sf_guard_signout')) ?></li>
  <?php else: ?>
  <li><?php echo link_to(sprintf('Log In'), url_for('@sf_guard_signin')) ?></li>
  <?php endif;  ?>
</ul>