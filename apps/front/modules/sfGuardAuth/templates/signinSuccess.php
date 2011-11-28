<div>
  <form class="form" id="formLogin" action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    <div class="form_head">
      <span class="title">Connection</span>
    </div>
    <div class="form_body" id="project_list1">
      <?php echo $form ?>
    </div>
    <div class="form_footer">
      <button type="submit">Connection</button>
    </div>
  </form>
</div>