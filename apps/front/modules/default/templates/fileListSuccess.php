<div class="list">
  <div class="list_head">
    <?php echo link_to(sprintf('%s', $repository->getName()), 'default/branchList', array('query_string' => 'repository='.$repository->getId())) ?>
    > <?php echo $branch->getName() ?>
    <div class="right">
      <?php echo link_to('Valider', 'default/branchToggleValidate', array('query_string' => 'branch='.$branch->getId(), 'class' => 'toggle status-valid '. ($branch->getStatusId() !== StatusPeer::OK ? 'disabled' : ''))) ?>
      <?php echo link_to('Invalider', 'default/branchToggleUnvalidate', array('query_string' => 'branch='.$branch->getId(), 'class' => 'toggle status-invalid '. ($branch->getStatusId() !== StatusPeer::KO ? 'disabled' : ''))) ?>
    </div>
  </div>
  <div class="list_body" id="file_list">
    <table>
      <?php foreach ($files as $file): ?>
      <tr>
        <td class="state">
          <span class="state_<?php echo $file['State'] ?>"><?php echo $file['State'] ?></span>
        </td>
        <td>
          <div class="file_infos">
            <h3>
              <?php echo link_to($file['Filename'], 'default/file', array('query_string' => 'file='.$file['Id'])) ?>
            </h3>
            <span class="file_comments">
              <?php echo link_to($file['NbFileComments'].' commentaire(s)', 'default/file', array('query_string' => 'file='.$file['Id'])) ?>
            </span>
          </div>
        </td>
        <td class="state">
          <?php echo link_to('Valider', 'default/fileToggleValidate', array('query_string' => 'file='.$file['Id'], 'class' => 'toggle status-valid '. ($file['StatusId'] !== StatusPeer::OK ? 'disabled' : ''))) ?>
        </td>
        <td class="state">
          <?php echo link_to('Invalider', 'default/fileToggleUnvalidate', array('query_string' => 'file='.$file['Id'], 'class' => 'toggle status-invalid '. ($file['StatusId'] !== StatusPeer::KO ? 'disabled' : ''))) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <div id="globalCommentComponent">
    <?php include_component('default', 'branchComment', array('branch' => $branch)); ?>
  </div>
</div>
