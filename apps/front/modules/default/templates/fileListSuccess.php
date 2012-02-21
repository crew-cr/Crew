<div class="list">
  <div class="list_head">
    <span class="title">File list</span>
    <span class="view_files_info">
       :
      <label for="view_files_A">added</label>
      <input type="checkbox" checked id="view_files_A" name="view_files_A">,
      <label for="view_files_M">modified</label>
      <input type="checkbox" checked id="view_files_M" name="view_files_M">,
      <label for="view_files_D">deleted</label>
      <input type="checkbox" checked id="view_files_D" name="view_files_D">
    </span>
    <span class="title">View</span>
    <span class="view_files_info">
       :
      <label for="view_files_tree" >tree</label> <input type="checkbox" checked id="view_files_tree" name="view_files_tree">
    </span>
    <div class="right status">
      <ul class="dropdown-action">
        <li class="dropdown">
          <?php if (BranchPeer::OK === $branch->getStatus()): ?>
            <?php echo link_to('Ã', 'default/changeStatus', array('query_string' => sprintf('type=branch&id=%s&status=%s', $branch->getId(), BranchPeer::OK), 'class' => 'dropdown-toggle ricon validate tooltip', 'title' => 'Validated')); ?>
            <ul class="dropdown-menu">
              <lI><?php echo link_to('Â', 'default/changeStatus', array('query_string' => sprintf('type=branch&id=%s&status=%s', $branch->getId(), BranchPeer::KO), 'class' => 'ricon invalidate item-status-action tooltip', 'title' => 'Invalidated')); ?></lI>
              <lI><?php echo link_to('!', 'default/changeStatus', array('query_string' => sprintf('type=branch&id=%s&status=%s', $branch->getId(), BranchPeer::A_TRAITER), 'class' => 'ricon todo item-status-action tooltip', 'title' => 'To do')); ?></lI>
          <?php elseif (BranchPeer::KO === $branch->getStatus()): ?>
            <?php echo link_to('Â', 'default/changeStatus', array('query_string' => sprintf('type=branch&id=%s&status=%s', $branch->getId(), BranchPeer::KO), 'class' => 'dropdown-toggle ricon invalidate tooltip', 'title' => 'Invalidated')); ?>
            <ul class="dropdown-menu">
                <lI><?php echo link_to('Ã', 'default/changeStatus', array('query_string' => sprintf('type=branch&id=%s&status=%s', $branch->getId(), BranchPeer::OK), 'class' => 'ricon validate item-status-action tooltip', 'title' => 'Validated')); ?></lI>
                <lI><?php echo link_to('!', 'default/changeStatus', array('query_string' => sprintf('type=branch&id=%s&status=%s', $branch->getId(), BranchPeer::A_TRAITER), 'class' => 'ricon todo item-status-action tooltip', 'title' => 'To do')); ?></lI>
          <?php else: ?>
            <?php echo link_to('!', 'default/changeStatus', array('query_string' => sprintf('type=branch&id=%s&status=%s', $branch->getId(), BranchPeer::A_TRAITER), 'class' => 'dropdown-toggle ricon todo tooltip', 'title' => 'To do')); ?>
            <ul class="dropdown-menu">
              <lI><?php echo link_to('Ã', 'default/changeStatus', array('query_string' => sprintf('type=branch&id=%s&status=%s', $branch->getId(), BranchPeer::OK), 'class' => 'ricon validate item-status-action tooltip', 'title' => 'Validated')); ?></lI>
              <lI><?php echo link_to('Â', 'default/changeStatus', array('query_string' => sprintf('type=branch&id=%s&status=%s', $branch->getId(), BranchPeer::KO), 'class' => 'ricon invalidate item-status-action tooltip', 'title' => 'Invalidated')); ?></lI>
          <?php endif; ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <?php $pathDirOld = ""; ?>
  <?php $maxLength = 110; ?>
  <div class="list_body" id="file_list">
    <table>
      <?php foreach ($files as $file): ?>
      <?php $pathDir = dirname($file['Filename']); ?>
      <?php $filename = basename($file['Filename']); ?>
      <?php if($pathDirOld !== $pathDir && $pathDir !== ".") : ?>
        <tr class="path_directory">
          <td class="ricon">Ø</td>
          <td colspan="5"><?php echo $pathDir . '/';?></td>
        </tr>
      <?php endif;?>
      <tr>
        <td class="state state_<?php echo $file['State'] ?> ricon" title="<?php echo $file['State'] == 'A' ? 'Added' : ($file['State'] == 'M' ? 'Modified' : 'Deleted') ?>">
          <?php echo $file['State'] == 'A' ? '@' : ($file['State'] == 'M' ? '>' : 'A') ?>
        </td>
        <td class="file_name">
          <h3>
            <?php if($file['ReviewRequest'] == 1): ?><span class="ricon">i</span><?php endif; ?>
            <?php if(!$file['IsBinary']):?><a class="tooltip" href="<?php echo url_for("default/file")?>?file=<?php echo $file['Id']?>" title="<?php echo stringUtils::trimTicketInfos($file['LastChangeCommitDesc'])?>"><?php endif; ?>
              <span style="display: none;"><?php echo ($pathDir !== ".")?stringUtils::lshorten($pathDir . '/', $maxLength - strlen($filename)):''; ?></span><?php echo stringUtils::lshorten($filename, $maxLength); ?>
            <?php if($file['IsBinary']):?></a><?php endif; ?>
          </h3>
        </td>
        <td class="view_infos">
          <?php if($file['NbFileComments']): ?>
            <span class="ricon">O</span><?php echo link_to($file['NbFileComments'], 'default/file', array('query_string' => 'file='.$file['Id'].'#comment-'.$file['LastCommentId'], 'class' => 'icon', 'title' => $file['NbFileComments'] . ' comment(s)')) ?>
          <?php endif; ?>
        </td>
        <td class="file_infos">
          <?php if($file['NbAddedLines'] > 0): ?><span class="added tooltip" title="<?php echo $file['NbAddedLines'] ?> added lines"><?php echo $file['NbAddedLines'] ?>+</span><?php endif; ?>
        </td>
        <td class="file_infos">
        <?php if($file['NbDeletedLines'] > 0): ?><span class="deleted tooltip" title="<?php echo $file['NbDeletedLines'] ?> deleted lines"><?php echo $file['NbDeletedLines'] ?>-</span><?php endif; ?>
        </td>
        <td class="status">
          <ul class="dropdown-action">
            <li class="dropdown">
              <?php if (BranchPeer::OK === $file['Status']): ?>
                <?php echo link_to('Ã', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file['Id'], BranchPeer::OK), 'class' => 'dropdown-toggle ricon validate tooltip', 'title' => 'Validated')); ?>
                <ul class="dropdown-menu">
                  <lI><?php echo link_to('Â', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file['Id'], BranchPeer::KO), 'class' => 'ricon invalidate item-status-action tooltip', 'title' => 'Invalidated')); ?></lI>
                  <lI><?php echo link_to('!', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file['Id'], BranchPeer::A_TRAITER), 'class' => 'ricon todo item-status-action tooltip', 'title' => 'To do')); ?></lI>
              <?php elseif (BranchPeer::KO === $file['Status']): ?>
                <?php echo link_to('Â', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file['Id'], BranchPeer::KO), 'class' => 'dropdown-toggle ricon invalidate tooltip', 'title' => 'Invalidated')); ?>
                <ul class="dropdown-menu">
                    <lI><?php echo link_to('Ã', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file['Id'], BranchPeer::OK), 'class' => 'ricon validate item-status-action tooltip', 'title' => 'Validated')); ?></lI>
                    <lI><?php echo link_to('!', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file['Id'], BranchPeer::A_TRAITER), 'class' => 'ricon todo item-status-action tooltip', 'title' => 'To do')); ?></lI>
              <?php else: ?>
                <?php echo link_to('!', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file['Id'], BranchPeer::A_TRAITER), 'class' => 'dropdown-toggle ricon todo tooltip', 'title' => 'To do')); ?>
                <ul class="dropdown-menu">
                  <lI><?php echo link_to('Ã', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file['Id'], BranchPeer::OK), 'class' => 'ricon validate item-status-action tooltip', 'title' => 'Validated')); ?></lI>
                  <lI><?php echo link_to('Â', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file['Id'], BranchPeer::KO), 'class' => 'ricon invalidate item-status-action tooltip', 'title' => 'Invalidated')); ?></lI>
              <?php endif; ?>
              </ul>
            </li>
          </ul>
        </td>
      </tr>
      <?php $pathDirOld = $pathDir; ?>
      <?php endforeach; ?>
    </table>
  </div>
  <div id="comment_component" class="comments_holder">
    <?php include_component('default', 'commentGlobal', array('type' => CommentPeer::TYPE_BRANCH, 'id' => $branch->getId())); ?>
  </div>
</div>
<?php include_partial('default/statusAction', array('statusActions' => $statusActions)) ?>
<?php include_partial('default/commentBoard', array('commentBoards' => $commentBoards)) ?>
