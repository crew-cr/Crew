
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="flashMessage notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flashMessage error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif ?>

<div>
  <form class="form" id="admin_project_add" action="<?php echo url_for('default/projectAdd') ?>" method="POST">
    <div class="form_head">
      <span class="title">Add project</span>
    </div>
    <div class="form_body">
      <?php echo $form ?>
    </div>
    <div class="form_footer">
      <button class="safe" type="reset">Reset form</button>
      <button type="submit">Add project</button>
    </div>
  </form>
</div>

<div class="list">
  <div class="list_head">
    <span class="title">Project list</span>
  </div>
  <div class="list_body" id="project_list">
    <table>
      <?php foreach ($repositories as $repository): ?>
      <tr>
        <td class="repository_infos">
          <?php echo $repository['Id'] ?>
        </td>
        <td class="padding-left">
          <h3><?php echo $repository['Name'] ?></h3>
        </td>
        <td>
          <h4><?php echo $repository['Remote'] ?></h4>
        </td>
        <td>
          <div class="view_infos">
            <span class="icon branch">
              <?php echo $repository['NbBranches'].' branch(es)' ?>
            </span>
          </div>
        </td>
        <td class="status">
          <button class="danger"><?php echo link_to('Delete', 'default/projectDelete', array('title' => 'Delete project', 'query_string' => 'id='.$repository['Id'], 'class' => 'status-blacklist')) ?></button>
        </td>
        <td>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
