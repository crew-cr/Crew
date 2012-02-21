<div class="file_bloc">
  <div class="list">
    <div class="list_head scroll">
      <span class="title">
        <?php if($file->getsfGuardUser()):?>
          <img class="avatar" src="<?php echo $file->getsfGuardUser()->getProfile()->getAvatarUrl() ?>" />
          <?php echo $file->getsfGuardUser()->getProfile()->__toString() ?> :
        <?php endif; ?>
      </span>
      <span class="tooltip" title="<?php echo stringUtils::trimTicketInfos($file->getLastChangeCommitDesc()) ?>">
        <?php echo stringUtils::shorten(stringUtils::trimTicketInfos($file->getLastChangeCommitDesc()), 65) ?>
      </span>
      <ul class="right dropdown-action">
        <li class="dropdown">
          <?php if (BranchPeer::OK === $file->getStatus()): ?>
            <?php echo link_to('Ã', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file->getId(), BranchPeer::OK), 'class' => 'dropdown-toggle ricon validate tooltip', 'title' => 'Validated')); ?>
            <ul class="dropdown-menu">
              <lI><?php echo link_to('Â', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file->getId(), BranchPeer::KO), 'class' => 'ricon invalidate item-status-action tooltip', 'title' => 'Invalidated')); ?></lI>
              <lI><?php echo link_to('!', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file->getId(), BranchPeer::A_TRAITER), 'class' => 'ricon todo item-status-action tooltip', 'title' => 'To do')); ?></lI>
          <?php elseif (BranchPeer::KO === $file->getStatus()): ?>
            <?php echo link_to('Â', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file->getId(), BranchPeer::KO), 'class' => 'dropdown-toggle ricon invalidate tooltip', 'title' => 'Invalidated')); ?>
            <ul class="dropdown-menu">
                <lI><?php echo link_to('Ã', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file->getId(), BranchPeer::OK), 'class' => 'ricon validate item-status-action tooltip', 'title' => 'Validated')); ?></lI>
                <lI><?php echo link_to('!', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file->getId(), BranchPeer::A_TRAITER), 'class' => 'ricon todo item-status-action tooltip', 'title' => 'To do')); ?></lI>
          <?php else: ?>
            <?php echo link_to('!', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file->getId(), BranchPeer::A_TRAITER), 'class' => 'dropdown-toggle ricon todo tooltip', 'title' => 'To do')); ?>
            <ul class="dropdown-menu">
              <lI><?php echo link_to('Ã', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file->getId(), BranchPeer::OK), 'class' => 'ricon validate item-status-action tooltip', 'title' => 'Validated')); ?></lI>
              <lI><?php echo link_to('Â', 'default/changeStatus', array('query_string' => sprintf('type=file&id=%s&status=%s', $file->getId(), BranchPeer::KO), 'class' => 'ricon invalidate item-status-action tooltip', 'title' => 'Invalidated')); ?></lI>
          <?php endif; ?>
          </ul>
        </li>
      </ul>
      <div class="actions">
        <?php if ('D' !== $file->getState() && !$file->getIsBinary()): ?>
          <?php echo link_to('View file', 'default/fileContent', array('title' => 'View entire file', 'query_string' => 'file='.$file->getId(), 'target' => '_blank')) ?>
        <?php endif; ?>
        <?php if (null !== $previousFileId): ?>
          <?php echo link_to('<< Previous file', 'default/file', array('title' => 'Previous file', 'query_string' => 'file='.$previousFileId, 'class' => 'previous')) ?>
        <?php endif; ?>
        <?php if (null !== $nextFileId): ?>
          <?php echo link_to('Next file >>', 'default/file', array('title' => 'Next file', 'query_string' => 'file='.$nextFileId, 'class' => 'next')) ?>
        <?php endif; ?>
      </div>
    </div>
    <div id="window" class="list_body data">
      <?php if(!$file->getIsBinary()): ?>
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
                <strong class="add_bubble <?php echo array_key_exists($position, $sf_data->getRaw('fileLineComments')) ? 'disabled' : 'enabled'; ?><?php echo !empty($fileLineComments[$position]) && sizeof($fileLineComments[$position]) >= 1 ? ' commented' : ''; ?>" data="<?php echo url_for('default/commentAddLine') ?>?commit=<?php echo $file->getLastChangeCommit() ?>&fileId=<?php echo $file->getId() ?>&position=<?php echo $position ?>&line=<?php echo substr($fileContentLine, 0, 1) == '-' ? $deleledLinesCounter : $addedLinesCounter ?>"><span class="ricon">P</span> <span class="ricon">@</span></strong>
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
      <?php else: ?>
        <div class="flashMessage error">This is a binary file.</div>
      <?php endif; ?>
    </div>
    <div id="comment_component" class="comments_holder">
      <?php include_component('default', 'commentGlobal', array('id' => $file->getId(), 'type' => CommentPeer::TYPE_FILE)); ?>
    </div>
  </div>
</div>
