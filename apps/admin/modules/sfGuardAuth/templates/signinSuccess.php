<form class="form" id="formLogin" action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <div class="form_head">
    <span class="title">Log in</span>
  </div>
  <div class="form_body">
    <?php echo $form ?>
  </div>
  <div class="form_footer">
    <button type="submit">Log in</button>
  </div>
</form>