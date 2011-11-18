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
      <div>
        <h2 id="crew_logo"><?php echo link_to('Crew, a code review tool for git projects', 'default/repositoryList') ?></h2>
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
    <div class="push"></div>
  </div>
  <div class="footer">
      <div class="site">
        <div class="logoTF">
          Developed by <a href="team-fusion.pmsipilot.com" title="Team Fusion">Team Fusion</a>, the third technical team of <a href="http://www.pmsipilot.com/" title="PMSIpilot">PMSIpilot</a>.
        </div>
      </div>
    </div>
  </div>
</body>
</html>