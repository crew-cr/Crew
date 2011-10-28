<!DOCTYPE html>
<html lang="fr">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="shortcut icon" href="/favicon.ico" />
<?php include_stylesheets() ?>
<?php include_javascripts() ?>
</head>
<body onload="">
  <div class="header">
    <div class="userbox">
      <?php include_component('default', 'userbox') ?>
    </div>
    <div class="padding_container">
      <h2 class="left"><?php echo link_to('Crew, a code review tool for git projects', 'default/repositoryList') ?></h2>
    </div>
  </div>
  <div class="site">
    <div class="page">
      <?php echo include_component('default', 'breadcrumb') ?>
      <div class="page_body">
        <?php echo $sf_content ?>
      </div>
    </div>
  </div>
</body>
</html>