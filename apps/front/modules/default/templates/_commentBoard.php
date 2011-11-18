<?php if (sizeof($commentBoards) > 0): ?>
<div class="list">
  <div class="list_head comment_board_icon">
    Comments list
  </div>
  <div class="list_body scrollable" id="project_list">
    <table>
      <?php foreach ($commentBoards as $commentBoard): ?>
      <tr>
        <td class="status_info">
          <img class="avatar" src="<?php echo $sf_user->getProfile()->getAvatarUrl(18) ?>" />
          <?php echo link_to($commentBoard['UserName'], 'user/view', array('query_string' => 'id=' . $commentBoard['UserId'])) ?><br/>
          <span class="date"><?php echo $commentBoard['CreatedAt'] ?></span>
        </td>
        <td>
          <?php if (! empty($commentBoard['ProjectId'])): ?>
            <?php echo link_to($commentBoard['ProjectName'], 'default/branchList', array('query_string' => 'repository=' . $commentBoard['ProjectId'])) ?>
          <?php endif; ?>
          <?php if (! empty($commentBoard['BranchId'])): ?>
            / <?php echo link_to($commentBoard['BranchName'], 'default/fileList', array('query_string' => 'branch=' . $commentBoard['BranchId'])) ?>
          <?php endif; ?>
          <?php if (! empty($commentBoard['FileId'])): ?>
            / <?php echo link_to($commentBoard['FileName'], 'default/file', array('query_string' => 'file=' . $commentBoard['FileId'])) ?>
          <?php endif; ?>
          <?php if (! empty($commentBoard['Position'])): ?>
            / <?php echo link_to(sprintf('on line %s', $commentBoard['Line']), 'default/file', array('query_string' => sprintf('file=%s#position_%s', $commentBoard['FileId'], $commentBoard['Position']))) ?>
          <?php endif; ?>
          <div class="message"><?php echo htmlspecialchars_decode($commentBoard['Message']) ?></div>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
<?php endif; ?>