<canvas id="outline" width="50" height="700" style="position: fixed;"></canvas>
<div class="file_bloc">
  <div class="list">
    <div class="list_head">
      <span class="title" title="<?php echo stringUtils::trimTicketInfos($file->getLastChangeCommitDesc()) ?>">
        <?php if($file->getsfGuardUser()):?>
          <img class="avatar" src="<?php echo $file->getsfGuardUser()->getProfile()->getAvatarUrl() ?>" />
          <strong><?php echo $file->getsfGuardUser()->getProfile()->__toString() ?></strong> :
        <?php endif; ?>
        <?php echo stringUtils::shorten(stringUtils::trimTicketInfos($file->getLastChangeCommitDesc()), 70) ?>
      </span>
      <ul class="right actions">
        <li class="status">
          <button class="icon success like <?php echo $file->getStatus() === BranchPeer::OK ? 'enabled' : ''?>"><?php echo link_to('Validated', 'default/fileToggleValidate', array('title' => 'Validate file', 'query_string' => 'file='.$file->getId(), 'class' => 'toggle')) ?></button>
          <button class="icon danger dislike <?php echo $file->getStatus() === BranchPeer::KO ? 'enabled' : ''?>"><?php echo link_to('Unvalidated', 'default/fileToggleUnvalidate', array('title' => 'Invalidate file', 'query_string' => 'file='.$file->getId(), 'class' => 'toggle')) ?></button>
          <button><?php echo link_to('View file', 'default/fileContent', array('title' => 'View entire file', 'query_string' => 'file='.$file->getId())) ?></button>
        </li>
      </ul>
    </div>
    <div class="list_body data">
      <table>
        <tbody>
        <?php $deleledLinesCounter = 0; ?>
        <?php $addedLinesCounter = 0; ?>
        <?php $position = 0; ?>
        <?php foreach ($fileContentLines as $fileContentLine): ?>
          <?php $position++; ?>
          <?php $deleledLinesCounter += substr($fileContentLine, 0, 1) == '+' ? 0 : 1; ?>
          <?php $addedLinesCounter += substr($fileContentLine, 0, 1) == '-' ? 0 : 1; ?>
          <tr id="position_<?php echo $position ?>">
            <td class="line_numbers"><?php echo substr($fileContentLine, 0, 1) == '+' ? '' : $deleledLinesCounter; ?></td>
            <td class="line_numbers"><?php echo substr($fileContentLine, 0, 1) == '-' ? '' : $addedLinesCounter; ?></td>
            <td style="width: 100%" class="line <?php echo substr($fileContentLine, 0, 1) == '-' ? 'deleted' : (substr($fileContentLine, 0, 1) == '+' ? 'added' : '') ?>">
              <strong class="add_bubble <?php echo array_key_exists($position, $sf_data->getRaw('fileLineComments')) ? 'disabled' : 'enabled'; ?><?php echo !empty($fileLineComments[$position]) && sizeof($fileLineComments[$position]) >= 1 ? ' commented' : ''; ?>" data="<?php echo url_for('default/commentAddLine') ?>?commit=<?php echo $file->getLastChangeCommit() ?>&fileId=<?php echo $file->getId() ?>&position=<?php echo $position ?>&line=<?php echo substr($fileContentLine, 0, 1) == '-' ? $deleledLinesCounter : $addedLinesCounter ?>"></strong>
              <pre><?php echo sprintf(" <strong>%s</strong> %s", substr($fileContentLine, 0, 1), substr($fileContentLine, 1)); ?></pre>
            </td>
          </tr>
          <?php if (array_key_exists($position, $sf_data->getRaw('fileLineComments'))) : ?>
            <?php include_component('default', 'commentLine', array(
              'commit'           => $file->getLastChangeCommit(),
              'position'         => $position,
              'user_id'          => $userId,
              'line'             => (substr($fileContentLine, 0, 1) == '-' ? $deleledLinesCounter : $addedLinesCounter),
              'file_id'          => $file->getId(),
              'form_visible'     => false,
              )); ?>
          <?php endif; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div id="comment_component" class="comments_holder">
      <?php include_component('default', 'commentGlobal', array('id' => $file->getId(), 'type' => CommentPeer::TYPE_FILE)); ?>
    </div>
  </div>
  <div class="navigation_links">
    <?php if (null !== $previousFileId): ?>
      <button><?php echo link_to('Previous file', 'default/file', array('title' => 'Previous file', 'query_string' => 'file='.$previousFileId, 'class' => 'previous')) ?></button>
    <?php endif; ?>
    <?php if (null !== $nextFileId): ?>
      <button class="right"><?php echo link_to('Next file', 'default/file', array('title' => 'Next file', 'query_string' => 'file='.$nextFileId, 'class' => 'next')) ?></button>
    <?php endif; ?>
  </div>
</div>
