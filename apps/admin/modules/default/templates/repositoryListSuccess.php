<div>
  <?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
  <?php endif ?>

  <?php if ($sf_user->hasFlash('error')): ?>
    <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
  <?php endif ?>

  <form action="<?php echo url_for('default/projectAdd') ?>" method="POST">
    <table>
      <?php echo $form ?>
      <tr>
        <td colspan="2">
          <input type="submit" value="Add project" />
        </td>
      </tr>
    </table>
  </form>
</div>

<div class="list">
  <div class="list_head">
    Project list
  </div>
  <div class="list_body" id="project_list">
    <table>
      <?php foreach ($repositories as $repository): ?>
      <tr>
        <td>
          <h3><?php echo $repository['Name'] ?></h3>
        </td>
        <td>
          <div class="view_infos">
            <span class="branch_icon"></span>
            <?php echo $repository['NbBranches'].' branch(es)' ?>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
