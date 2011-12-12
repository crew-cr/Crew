<?php if ($userIsAuthenticated) : ?>
  <ul class="breadcrumb">
    <li class="home <?php echo !$currentBreadCrumbRepository ? 'selected' : '' ?>"><?php echo link_to('Crew', '@homepage', array('class' => 'logo')) ?></li>
    <?php if ($currentBreadCrumbRepository): ?>
      <?php $repositoryNeedList = sizeof($repositoryBreadCrumbList) ?>
      <li class="<?php echo !$currentBreadCrumbBranch ? 'selected' : '' ?> <?php echo $repositoryNeedList ? 'dropdown' : '' ?>">
        <span class="ricon">Ø</span>
        <?php echo link_to($currentBreadCrumbRepository, 'default/branchList?repository=' . $currentBreadCrumbRepository->getId()) ?>
        <?php if($repositoryNeedList): ?>
          <?php echo link_to('@', '@homepage', array('class' => 'dropdown-toggle')) ?>
          <ul class="dropdown-menu">
            <?php foreach ($repositoryBreadCrumbList as $item): ?>
              <li><?php echo link_to($item, 'default/branchList?repository=' . $item->getId()) ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </li>
    <?php endif; ?>
    <?php if ($currentBreadCrumbBranch): ?>
      <?php $branchNeedList = sizeof($branchBreadCrumbList) ?>
      <li class="<?php echo !$currentBreadCrumbFile ? 'selected' : '' ?> <?php echo $branchNeedList ? 'dropdown' : '' ?>">
        <span class="ricon">.</span>
        <?php echo link_to($currentBreadCrumbBranch, 'default/fileList?branch=' . $currentBreadCrumbBranch->getId()) ?>
        <?php if($branchNeedList): ?>
          <?php echo link_to('@', '@homepage', array('class' => 'dropdown-toggle')) ?>
          <ul class="dropdown-menu">
            <?php foreach ($branchBreadCrumbList as $item): ?>
              <li>
                <span class="ricon"><?php if($item->getStatus() == 1): ?>*<?php elseif($item->getStatus() == 2): ?>%<?php else: ?>!<?php endif; ?></span>
                <?php echo link_to($item, 'default/fileList?branch=' . $item->getId()) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </li>
    <?php endif; ?>
    <?php if ($currentBreadCrumbFile): ?>
      <?php $fileNeedList = sizeof($fileBreadCrumbList) ?>
      <li class="selected<?php echo $fileNeedList ? ' dropdown' : '' ?>">
        <span class="ricon">E</span>
        <?php echo link_to($currentBreadCrumbFile, 'default/file?file=' . $currentBreadCrumbFile->getId()) ?>
        <?php if($fileNeedList): ?>
          <?php echo link_to('@', '@homepage', array('class' => 'dropdown-toggle')) ?>
          <ul class="dropdown-menu">
            <?php foreach ($fileBreadCrumbList as $item): ?>
              <li>
                <span class="ricon"><?php if($item->getStatus() == 1): ?>*<?php elseif($item->getStatus() == 2): ?>%<?php else: ?>!<?php endif; ?></span>
                <?php echo link_to($item, 'default/file?file=' . $item->getId()) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </li>
    <?php endif; ?>
  </ul>
<?php endif; ?>

<script type="text/javascript">
  $(document).ready(function() {
    $('.breadcrumb').dropdown()
  })
</script>
