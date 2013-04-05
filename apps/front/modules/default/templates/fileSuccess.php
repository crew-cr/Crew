<div class="file_bloc">
  <div class="list">
    <div class="list_head scroll">
      <span class="clickable icon-caret-<?php echo $readonly ? 'up' : 'down'; ?> tooltip toggle-diff-range" title="Click to see the diff range selector"></span>
      <span class="title">
        <?php if($file->getsfGuardUser()):?>
          <img class="avatar" src="<?php echo $file->getsfGuardUser()->getProfile()->getAvatarUrl() ?>" />
          <?php echo $file->getsfGuardUser()->getProfile()->__toString() ?> :
        <?php endif; ?>
      </span>
      <span class="tooltip" title="<?php echo stringUtils::trimTicketInfos($file->getLastChangeCommitDesc()) ?>">
        <?php echo stringUtils::shorten(stringUtils::trimTicketInfos($file->getLastChangeCommitDesc()), 65) ?>
      </span>
      <?php include_partial('default/dropdownStatus', array('id' => $file->getId(), 'status' => $file->getStatus(), 'readonly' => $readonly, 'type' => 'file')); ?>
      <div class="actions">
        <?php $defaultParametersUrlFile = array(
          'from' => $commit_from,
          'to'   => $commit_to,
        ); ?>
        <?php if ('D' !== $file->getState() && !$file->getIsBinary()): ?>
          <?php echo link_to('View file', 'default/fileContent', array('title' => 'View entire file', 'query_string' => http_build_query(array_merge($defaultParametersUrlFile, array('file' => $file->getId()))), 'target' => '_blank')) ?>
        <?php endif; ?>
        <?php if (null !== $previousFileId): ?>
          <?php echo link_to('<< Previous file', 'default/file', array('title' => 'Previous file', 'query_string' => http_build_query(array_merge($defaultParametersUrlFile, array('file' => $previousFileId))), 'class' => 'previous')) ?>
        <?php endif; ?>
        <?php if (null !== $nextFileId): ?>
          <?php echo link_to('Next file >>', 'default/file', array('title' => 'Next file', 'query_string' => http_build_query(array_merge($defaultParametersUrlFile, array('file' => $nextFileId))), 'class' => 'next')) ?>
        <?php endif; ?>
      </div>
    </div>
    <div id="window" class="list_body data">
      <div class="list_head diff-range<?php $readonly && print " displayed"; ?>">
        <?php include_component('default', 'selectorDiffRange', array('type' => 'file', 'id' => $file->getId())); ?>
      </div>
      <?php if(!$file->getIsBinary()): ?>
        <table>
          <tbody>
          <?php $deleledLinesCounter = 0; ?>
          <?php $addedLinesCounter = 0; ?>
          <?php $position = 0; ?>
          <?php
          $isFileUTF8 = sfToolkit::isUTF8(implode("\n", $fileContentLines->getRawValue()));
          
          if (!$isFileUTF8) {
            $previousSfCharset = sfConfig::get('sf_charset');
            
            // If file isn't detected as UTF-8, we fallback to ISO-8859-1 to prevent symfony escaping from blowing up $fileContentLines
            // Could be improved with better encoding detection and not only 2 values to choose from
            sfConfig::set('sf_charset', 'ISO-8859-1');
          }
          ?>
          <?php foreach ($fileContentLines as $fileContentLine): ?>
            <?php $position++; ?>
            <?php $deleledLinesCounter += substr($fileContentLine, 0, 1) == '+' ? 0 : 1; ?>
            <?php $addedLinesCounter += substr($fileContentLine, 0, 1) == '-' ? 0 : 1; ?>
            <tr id="position_<?php echo $position ?>">
              <td class="line_numbers"><?php echo substr($fileContentLine, 0, 1) == '+' ? '' :
                sprintf('<a href="crewide://%s@%s@%d">%d</a>', urlencode($repository->getName()), urlencode($file->getFilename()), $deleledLinesCounter, $deleledLinesCounter)
              ?></td>
              <td class="line_numbers"><?php echo substr($fileContentLine, 0, 1) == '-' ? '' :
                sprintf('<a href="crewide://%s@%s@%d">%d</a>', urlencode($repository->getName()), urlencode($file->getFilename()), $addedLinesCounter, $addedLinesCounter)
              ?></td>
              <td style="width: 100%" class="line <?php echo substr($fileContentLine, 0, 1) == '-' ? 'deleted' : (substr($fileContentLine, 0, 1) == '+' ? 'added' : '') ?>">
                <?php if (!$readonly): ?>
                  <strong 
                    class="add_bubble 
                          <?php echo array_key_exists($position, $sf_data->getRaw('fileLineComments')) ? 'disabled' : 'enabled'; ?>
                          <?php echo !empty($fileLineComments[$position]) && sizeof($fileLineComments[$position]) >= 1 ? ' commented' : ''; ?>" 
                    data="<?php echo url_for('default/commentAddLine') ?>?commit=<?php echo $file->getLastChangeCommit() ?>&fileId=<?php echo $file->getId() ?>&position=<?php echo $position ?>&line=<?php echo substr($fileContentLine, 0, 1) == '-' ? $deleledLinesCounter : $addedLinesCounter ?>">
                    <span class="ricon">P</span>
                    <span class="ricon">@</span> 
                  </strong>
                <?php endif; ?>
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
            <?php if (isset($previousSfCharset)) sfConfig::set('sf_charset', $previousSfCharset); ?>
          </tbody>
        </table>
      <?php else: ?>
        <div>
          <div class="imageDiff old">
            <?php if (!$oldImageExists): ?><div class="flashMessage notice">No binary file in this revision.</div>
            <?php elseif (is_null($oldImageType)): ?><div class="flashMessage error">This is an unknown type binary file.</div>
            <?php else: ?><img src="data:image/<?php echo $oldImageType ?>;base64,<?php echo $oldImageContent ?>" title="<?php echo $file->getFilename() ?>" />
            <?php endif;?>
          </div>
          <div class="imageDiff new">
            <?php if (!$newImageExists): ?><div class="flashMessage notice">No binary file in this revision.</div>
            <?php elseif (is_null($newImageType)): ?><div class="flashMessage error">This is an unknown type binary file.</div>
            <?php else: ?><img src="data:image/<?php echo $newImageType ?>;base64,<?php echo $newImageContent ?>" title="<?php echo $file->getFilename() ?>" />
            <?php endif;?>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <div id="comment_component" class="comments_holder">
      <?php if (!$readonly): ?>
        <?php include_component('default', 'commentGlobal', array('id' => $file->getId(), 'type' => CommentPeer::TYPE_FILE)); ?>
      <?php endif; ?>
    </div>
  </div>
</div>
