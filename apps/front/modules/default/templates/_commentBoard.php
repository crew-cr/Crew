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
          <img class="avatar" src="<?php echo Profile::getAvatarUrlFromEmail($commentBoard['UserEmail'], 18) ?>" />
          <?php echo link_to($commentBoard['UserName'], 'user/view', array('query_string' => 'id=' . $commentBoard['UserId'])) ?><br/>
          <span class="date"><?php echo $commentBoard['CreatedAt'] ?></span>
        </td>
        <td>
          <div class="message"><?php echo $commentBoard['Message'] ?></div>
          <div class="path">
            <?php if (!empty($commentBoard['ProjectId'])): ?><?php echo link_to($commentBoard['ProjectName'], 'default/branchList', array('query_string' => 'repository=' . $commentBoard['ProjectId'])) ?><?php endif; ?>
            <?php if (!empty($commentBoard['BranchId'])): ?>&gt; <?php echo link_to($commentBoard['BranchName'], 'default/fileList', array('query_string' => 'branch=' . $commentBoard['BranchId'])) ?><?php endif; ?>
            <?php if (!empty($commentBoard['FileId'])): ?>&gt; <?php echo link_to(stringUtils::lshorten($commentBoard['FileName'], 50), 'default/file', array('query_string' => 'file=' . $commentBoard['FileId'], 'title' => $commentBoard['FileName'])) ?><?php endif; ?>
            <?php if (!empty($commentBoard['Position'])): ?>&gt; <?php echo link_to(sprintf('line %s', $commentBoard['Line']), 'default/file', array('query_string' => sprintf('file=%s#position_%s', $commentBoard['FileId'], $commentBoard['Position']))) ?><?php endif; ?>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
<?php endif; ?>
