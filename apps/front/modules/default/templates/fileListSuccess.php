<div class="list">
  <div class="list_head">
    <span class="title">File list</span>
    <span class="view_files_info">
       :
      added <input type="checkbox" checked id="view_files_A" name="view_files_A">,
      modified <input type="checkbox" checked id="view_files_M" name="view_files_M">,
      deleted <input type="checkbox" checked id="view_files_D" name="view_files_D">
    </span>
    <div class="right status">
      <button title="Validate branch <strong><?php echo $branch->__toString() ?></strong>" class="tooltip icon success like only-icon <?php echo $branch->getStatus() === BranchPeer::OK ? 'enabled' : '' ?>"><?php echo link_to('Validate branch', 'default/branchToggleValidate', array('title' => 'Validate branch', 'query_string' => 'branch='.$branch->getId(), 'class' => 'toggle')) ?></button>
      <button title="Invalidate branch <strong><?php echo $branch->__toString() ?></strong>" class="tooltip icon danger dislike only-icon <?php echo $branch->getStatus() === BranchPeer::KO ? 'enabled' : '' ?>"><?php echo link_to('Invalidate branch', 'default/branchToggleUnvalidate', array('title' => 'Invalidate branch', 'query_string' => 'branch='.$branch->getId(), 'class' => 'toggle')) ?></button>
    </div>
  </div>
  <div class="list_body" id="file_list">
    <table>
      <?php foreach ($files as $file): ?>
      <tr class="<?php echo $file['ReviewRequest'] === 1 ? 'review_request':'' ?>">
        <td class="state state_<?php echo $file['State'] ?> ricon" title="<?php echo $file['State'] == 'A' ? 'Added' : ($file['State'] == 'M' ? 'Modified' : 'Deleted') ?>">
          <?php echo $file['State'] == 'A' ? '@' : ($file['State'] == 'M' ? '>' : 'A') ?>
        </td>
        <td class="file_name">
          <h3><?php echo link_to(stringUtils::lshorten($file['Filename'], 80), 'default/file', array('title' => stringUtils::trimTicketInfos($file['LastChangeCommitDesc']), 'query_string' => 'file='.$file['Id'], 'class' => 'tooltip')) ?></h3>
        </td>
        <td class="view_infos">
          <?php if($file['NbFileComments']): ?>
            <?php echo link_to($file['NbFileComments'], 'default/file', array('query_string' => 'file='.$file['Id'], 'class' => 'icon comment', 'title' => $file['NbFileComments'] . ' comment(s)')) ?>
          <?php endif; ?>
        </td>
        <td class="file_infos">
          <?php if($file['NbAddedLines'] > 0): ?><span class="added tooltip" title="<?php echo $file['NbAddedLines'] ?> added lines"><?php echo $file['NbAddedLines'] ?>+</span><?php endif; ?>
        </td>
        <td class="file_infos">
        <?php if($file['NbDeletedLines'] > 0): ?><span class="deleted tooltip" title="<?php echo $file['NbDeletedLines'] ?> deleted lines"><?php echo $file['NbDeletedLines'] ?>-</span><?php endif; ?>
        </td>
        <td class="status minified">
          <button title="Validate file" class="tooltip icon success like only-icon <?php echo $file['Status'] === BranchPeer::OK ? 'enabled' : ''?>"><?php echo link_to('Valider', 'default/fileToggleValidate', array('title' => 'Validate file', 'query_string' => 'file='.$file['Id'], 'class' => 'toggle')) ?></button>
          <button title="Invalidate file" class="tooltip icon danger dislike only-icon <?php echo $file['Status'] === BranchPeer::KO ? 'enabled' : ''?>"><?php echo link_to('Invalider', 'default/fileToggleUnvalidate', array('title' => 'Invalidate file', 'query_string' => 'file='.$file['Id'], 'class' => 'toggle')) ?></button>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <div id="comment_component" class="comments_holder">
    <?php include_component('default', 'commentGlobal', array('type' => CommentPeer::TYPE_BRANCH, 'id' => $branch->getId())); ?>
  </div>
</div>
<?php include_partial('default/statusAction', array('statusActions' => $statusActions)) ?>
<?php include_partial('default/commentBoard', array('commentBoards' => $commentBoards)) ?>
