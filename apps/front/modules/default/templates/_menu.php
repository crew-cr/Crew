<?php if ($form !== null) : ?>
  <?php if ($typeContext === 'Repository') : ?>
    <form id="context" name="context" method="get" action="<?php echo url_for('default/branchList') ?>" class="right">
  <?php elseif ($typeContext === 'Branch') : ?>
    <form id="context" name="context" method="get" action="<?php echo url_for('default/fileList') ?>" class="right">
  <?php elseif ($typeContext === 'File') : ?>
    <form id="context" name="context" method="get" action="<?php echo url_for('default/file') ?>" class="right">
  <?php endif; ?>
  <?php echo $form ?>
    </form>
<?php endif; ?>