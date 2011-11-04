<div class="list">
  <div class="list_head">
    File list
    <div class="right status">
      <?php echo link_to('Valider', 'default/branchToggleValidate', array('title' => 'Validate branch', 'query_string' => 'branch='.$branch->getId(), 'class' => 'toggle status-valid '. ($branch->getStatus() !== BranchPeer::OK ? 'disabled' : ''))) ?>
      <?php echo link_to('Invalider', 'default/branchToggleUnvalidate', array('title' => 'Invalidate branch', 'query_string' => 'branch='.$branch->getId(), 'class' => 'toggle status-invalid '. ($branch->getStatus() !== BranchPeer::KO ? 'disabled' : ''))) ?>
    </div>
  </div>
  <div class="list_body" id="file_list">
    <table>
      <?php foreach ($files as $file): ?>
      <tr>
        <td class="state">
          <span class="state_<?php echo $file['State'] ?>" title="<?php echo $file['State'] == 'A' ? 'Added' : ($file['State'] == 'M' ? 'Modified' : 'Deleted') ?>"><?php echo $file['State'] ?></span>
        </td>
        <td>
          <h3><?php echo link_to(stringUtils::lshorten($file['Filename']), 'default/file', array('title' => $file['Filename'], 'query_string' => 'file='.$file['Id'])) ?></h3>
        </td>
        <td class="view_infos">
            <span class="file_comments"><?php echo link_to($file['NbFileComments'].' comment(s)', 'default/file', array('query_string' => 'file='.$file['Id'])) ?></span>
        </td>
        <td class="status">
          <?php echo link_to('Valider', 'default/fileToggleValidate', array('title' => 'Validate file', 'query_string' => 'file='.$file['Id'], 'class' => 'toggle status-valid '. ($file['Status'] !== BranchPeer::OK ? 'disabled' : ''))) ?>
          <?php echo link_to('Invalider', 'default/fileToggleUnvalidate', array('title' => 'Invalidate file', 'query_string' => 'file='.$file['Id'], 'class' => 'toggle status-invalid '. ($file['Status'] !== BranchPeer::KO ? 'disabled' : ''))) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <div id="globalCommentComponent">
    <?php include_component('default', 'branchComment', array('branch' => $branch)); ?>
  </div>
</div>
<div class="list">
  <?php include_partial('default/statusAction', array('statusActions' => $statusActions)) ?>
</div>
<div class="list">
  <?php include_partial('default/commentBoard', array('commentBoards' => $commentBoards)) ?>
</div>
