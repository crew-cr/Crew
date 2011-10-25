<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
  </head>
  <body>
  </body>
</html>


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
  <div class="page">
    <div class="header">
      <div class="padding_container">
        <h2 class="left"><?php echo link_to('Crew', 'default/repositoryList') ?></h2>
        <?php echo include_component('default', 'menu') ?>
      </div>
    </div>
    <div class="page_body">
      <?php echo $sf_content ?>
    </div>
  </div>
</body>
</html>