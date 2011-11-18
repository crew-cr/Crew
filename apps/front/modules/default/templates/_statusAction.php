<?php if (sizeof($statusActions) > 0): ?>
<div class="list">
  <div class="list_head status_actions_icon">
    Status actions list
  </div>
  <div class="list_body scrollable" id="project_list">
    <table>
      <?php foreach ($statusActions as $statusAction): ?>
      <tr>
        <td class="status_info">
          <img class="avatar" src="<?php echo $sf_user->getProfile()->getAvatarUrl(18) ?>" />
          <?php echo link_to($statusAction->getAuthorName(), 'user/view', array('query_string' => 'id=' . $statusAction->getUserId())) ?><br/>
          <span class="date"><?php echo $statusAction->getCreatedAt('d/m/Y H:i:s') ?></span>
        </td>
        <td>
          <?php if (null !== $statusAction->getRepository()): ?>
            <?php echo link_to($statusAction->getRepository(), 'default/branchList', array('query_string' => 'repository=' . $statusAction->getRepositoryId())) ?>
          <?php endif; ?>
          <?php if (null !== $statusAction->getBranch()): ?>
            / <?php echo link_to($statusAction->getBranch(), 'default/fileList', array('query_string' => 'branch=' . $statusAction->getBranchId())) ?>
          <?php endif; ?>
          <?php if (null !== $statusAction->getFile()): ?>
            / <?php echo link_to($statusAction->getFile(), 'default/file', array('query_string' => 'file=' . $statusAction->getFileId())) ?>
          <?php endif; ?>
          <div class="message"><?php echo htmlspecialchars_decode($statusAction->getMessage()) ?></div>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
<?php endif; ?>
