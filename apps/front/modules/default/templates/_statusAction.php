<?php if (sizeof($statusActions) > 0): ?>
<div class="list notifier">
  <div class="list_head icon status_action">
    <span class="title">Status action list</span>
  </div>
  <div class="list_body scrollable" id="project_list">
    <table>
      <?php foreach ($statusActions as $statusAction): ?>
      <tr>
        <td class="status_info">
          <img class="avatar" src="<?php echo Profile::getAvatarUrlFromEmail($statusAction->getsfGuardUser()->getProfile()->getEmail(), 18) ?>" />
          <?php echo link_to($statusAction->getAuthorName(), 'user/view', array('query_string' => 'id=' . $statusAction->getUserId())) ?><br/>
          <span class="date"><?php echo $statusAction->getCreatedAt('d/m/Y H:i:s') ?></span>
        </td>
        <td class="status_content">
          <div class="message"><?php echo htmlspecialchars_decode($statusAction->getMessage()) ?></div>
          <div class="path">
            <?php if (null !== $statusAction->getRepository()): ?><?php echo link_to($statusAction->getRepository(), 'default/branchList', array('query_string' => 'repository=' . $statusAction->getRepositoryId())) ?><?php endif; ?>
            <?php if (null !== $statusAction->getBranch()): ?>&gt; <?php echo link_to($statusAction->getBranch(), 'default/fileList', array('query_string' => 'branch=' . $statusAction->getBranchId())) ?><?php endif; ?>
            <?php if (null !== $statusAction->getFile()): ?>&gt; <?php echo link_to(stringUtils::lshorten($statusAction->getFile(), 50), 'default/file', array('query_string' => 'file=' . $statusAction->getFileId(), 'title' => $statusAction->getFile())) ?><?php endif; ?>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
<?php endif; ?>
