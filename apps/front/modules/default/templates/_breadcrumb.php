<ul id="breadcrumb">
<?php foreach($links as $link) : ?>
  <li><a href="<?php echo url_for($link['url']) ?>" class="<?php echo $link['class'] ?>"><?php echo $link['label'] ?></a> / </li>
<?php endforeach; ?>
  <li>
<?php if ($form !== null && $userIsAuthenticated && $typeContext !== null) : ?>
  <?php if ($typeContext === 'Repository') : ?>
    <form id="context" class="repository" name="context" method="get" action="<?php echo url_for('default/branchList') ?>">
  <?php elseif ($typeContext === 'Branch') : ?>
    <form id="context" name="context" method="get" action="<?php echo url_for('default/fileList') ?>">
  <?php elseif ($typeContext === 'File') : ?>
    <form id="context" name="context" method="get" action="<?php echo url_for('default/file') ?>">
  <?php endif; ?>
      <?php echo $form[$typeContext] ?>
    </form>
<?php endif; ?>
  </li>
</ul>
