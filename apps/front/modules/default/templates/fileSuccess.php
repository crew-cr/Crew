<div class="file_bloc">
  <div class="data">
    <div class="data_head">
      <?php echo link_to(sprintf('%s', $repository->getName()), 'default/branchList', array('query_string' => 'repository='.$repository->getId())) ?>
      > <?php echo link_to(sprintf('%s', $branch->getName()), 'default/fileList', array('query_string' => 'branch='.$branch->getId())) ?>
      > <?php echo $file->getFilename() ?>
      <div class="right"></div>
    </div>
    <div class="data_body">
      <table >
        <tbody>
        <?php $deleledLinesCounter = 0; ?>
        <?php $addedLinesCounter = 0; ?>
        <?php $position = 0; ?>
        <?php foreach ($fileContentLines as $fileContentLine): ?>
          <?php $position++; ?>
          <?php $deleledLinesCounter += substr($fileContentLine, 0, 1) == '+' ? 0 : 1; ?>
          <?php $addedLinesCounter += substr($fileContentLine, 0, 1) == '-' ? 0 : 1; ?>
          <tr>
            <td class="line_numbers"><?php echo substr($fileContentLine, 0, 1) == '+' ? '' : $deleledLinesCounter; ?></td>
            <td class="line_numbers"><?php echo substr($fileContentLine, 0, 1) == '-' ? '' : $addedLinesCounter; ?></td>
            <td style="width: 100%" class="line <?php echo substr($fileContentLine, 0, 1) == '-' ? 'deleted' : (substr($fileContentLine, 0, 1) == '+' ? 'added' : '') ?>">
              <strong class="add_bubble <?php echo array_key_exists($position, $sf_data->getRaw('fileLineComments')) ? 'disabled' : 'enabled'; ?><?php echo !empty($fileLineComments[$position]) && sizeof($fileLineComments[$position]) >= 1 ? ' commented' : ''; ?>" data="<?php echo url_for('default/lineAddComment') ?>?commitReference=<?php echo $file->getCommitStatusChanged() ?>&fileId=<?php echo $file->getId() ?>&position=<?php echo $position ?>&line=<?php echo substr($fileContentLine, 0, 1) == '-' ? $deleledLinesCounter : $addedLinesCounter ?>"></strong>
              <pre><?php echo sprintf(" <strong>%s</strong> %s", substr($fileContentLine, 0, 1), substr($fileContentLine, 1)); ?></pre>
            </td>
          </tr>
          <?php if (array_key_exists($position, $sf_data->getRaw('fileLineComments'))) : ?>
            <?php include_component('default', 'lineComment', array(
              'commit_reference' => $file->getCommitStatusChanged(),
              'position'         => $position,
              'line'             => (substr($fileContentLine, 0, 1) == '-' ? $deleledLinesCounter : $addedLinesCounter),
              'file_id'          => $file->getId(),
              'form_visible'     => false,
              )); ?>
          <?php endif; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div id="globalCommentComponent">
    <?php include_component('default', 'fileComment', array('file' => $file)); ?>
  </div>
</div>