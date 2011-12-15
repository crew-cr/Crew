<!DOCTYPE html>
<html lang="fr">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/crew/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body onload="">
    <div class="header">
      <a href="<?php echo cross_app_url_for('front', '@homepage') ?>" id="crew-logo" title="Crew, code review tool for git projects"><?php echo image_tag('crew-logo.png') ?></a>
      <?php include_component('default', 'userbox') ?>
    </div>
    <div class="site">
      <div class="page">
        <?php echo $sf_content ?>
      </div>
    </div>
    <div class="footer">
      <div class="logoCrew">by <a href="http://team-fusion.pmsipilot.com" title="Team Fusion">Team Fusion</a> from <a href="http://www.pmsipilot.com/" title="PMSIpilot">PMSIpilot</a>.</div>
    </div>
  </body>
</html>
