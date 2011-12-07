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
  <div class="wrapper">
    <div class="header">
      <div class="userbox">
        <?php include_component('default', 'userbox') ?>
      </div>
      <div id="crew_logo">
        <a href="<?php echo url_for('default/repositoryList') ?>" title="Crew, a code review tool for git projects">
          <?php echo image_tag('crew-logo-hover.png') ?>
          <?php echo image_tag('crew-logo.png') ?>
        </a>
      </div>
    </div>
    <div class="site">
      <div class="page">
        <div class="page_body">
          <?php echo $sf_content ?>
        </div>
      </div>
    </div>
    <div class="push"></div>
  </div>
  <div class="footer">
    <div class="site">
      <div class="logoCrew">by <a href="http://team-fusion.pmsipilot.com" title="Team Fusion">Team Fusion</a> from <a href="http://www.pmsipilot.com/" title="PMSIpilot">PMSIpilot</a>.</div>
    </div>
  </div>
</body>
</html>