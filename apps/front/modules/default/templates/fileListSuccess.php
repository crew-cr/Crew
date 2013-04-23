<div class="list">
  <div class="list_head">
    <span class="clickable icon-caret-down tooltip toggle-diff-range" title="Click to see the diff range selector"></span>
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
      <?php include_partial('default/dropdownStatus', array('id' => $branch->getId(), 'status' => $branch->getStatus(), 'readonly' => $readonly, 'type' => 'branch')); ?>
    </div>
  </div>
  <div class="list_head diff-range<?php $readonly && print " displayed"; ?>">
    <?php include_component('default', 'selectorDiffRange', array('type' => 'branch', 'id' => $branch->getId())); ?>
  </div>
  <?php $pathDirOld = ""; ?>
  <?php $maxLength = 110; ?>
  <?php $defaultParametersUrlFile = array(
    'from' => $commit_from,
    'to'   => $commit_to,
  ); ?>
  <div class="list_body" id="file_list">
    <table>
      <?php foreach ($files as $file): ?>
      <?php $pathDir = dirname($file['Filename']); ?>
      <?php $filename = basename($file['Filename']); ?>
      <?php if ($pathDirOld !== $pathDir && $pathDir !== ".") : ?>
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
            <?php if ($file['ReviewRequest'] == 1): ?><span class="ricon">i</span><?php endif; ?>
            <a
              class="tooltip"
              href="<?php echo url_for("default/file?" . http_build_query(array_merge($defaultParametersUrlFile, array('file' => $file['Id'])))); ?>" 
              title="<?php echo stringUtils::trimTicketInfos($file['LastChangeCommitDesc'])?>">
              <span style="display: none;"><?php echo ($pathDir !== ".")?stringUtils::lshorten($pathDir . '/', $maxLength - strlen($filename)):''; ?></span><?php echo stringUtils::lshorten($filename, $maxLength); ?>
            </a>
            <?php if ($file['IsBinary']):?>
              <span class="ricon binary" title="Binary file">Ñ</span>
            <?php endif; ?>
          </h3>
        </td>
        <td class="view_infos">
          <?php if ($file['NbFileComments']): ?>
            <span class="ricon<?php $file['NbFileCommentsNotChecked']==0 && print ' ricon0'; ?>">O</span><?php echo link_to($file['NbFileCommentsNotChecked'] . ' / ' . $file['NbFileComments'], 'default/file', array('query_string' => 'file='.$file['Id'].'#comment-'.$file['LastCommentId'], 'class' => 'icon', 'title' => $file['NbFileComments'] . ' comment(s)')) ?>
          <?php endif; ?>
        </td>
        <td class="file_infos">
          <?php if ($file['NbAddedLines'] > 0): ?><span class="added tooltip" title="<?php echo $file['NbAddedLines'] ?> added lines"><?php echo $file['NbAddedLines'] ?>+</span><?php endif; ?>
        </td>
        <td class="file_infos">
        <?php if ($file['NbDeletedLines'] > 0): ?><span class="deleted tooltip" title="<?php echo $file['NbDeletedLines'] ?> deleted lines"><?php echo $file['NbDeletedLines'] ?>-</span><?php endif; ?>
        </td>
        <td class="status">
          <?php include_partial('default/dropdownStatus', array('id' => $file['Id'], 'status' => $file['Status'], 'readonly' => $readonly, 'type' => 'file')); ?>
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
