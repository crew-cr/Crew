<?php if ($userIsAuthenticated && $currentBreadCrumbRepository) : ?>
<ul class="breadcrumb">
  <?php if (null !== $currentBreadCrumbRepository): ?>
  <?php $repositoryNeedList = 0 != sizeof($repositoryBreadCrumbList) ?>
  <li class="<?php echo $repositoryNeedList ? 'dropdown' : '' ?>">
    <?php if ($currentBreadCrumbRepository !== null) : ?>
      <a href="#" class="<?php echo $repositoryNeedList ? 'dropdown-toggle icon' : '' ?>">Ø</a>
      <?php echo link_to($currentBreadCrumbRepository, 'default/branchList?repository=' . $currentBreadCrumbRepository->getId()) ?>
      <?php if($repositoryNeedList): ?>
        <ul class="dropdown-menu">
          <?php foreach ($repositoryBreadCrumbList as $item): ?>
            <li><?php echo link_to($item, 'default/branchList?repository=' . $item->getId()) ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    <?php endif; ?>
  </li>
  <?php endif; ?>
  <?php if (null !== $currentBreadCrumbBranch): ?>
  <?php $branchNeedList = 0 != sizeof($branchBreadCrumbList) ?>
  <li class="divider">/</li>
  <li class="<?php echo $branchNeedList ? 'dropdown' : '' ?>">
    <?php if ($currentBreadCrumbBranch !== null) : ?>
      <a href="#" class="<?php echo $branchNeedList ? 'dropdown-toggle icon' : '' ?>">.</a>
      <?php echo link_to($currentBreadCrumbBranch, 'default/fileList?branch=' . $currentBreadCrumbBranch->getId()) ?>
      <?php if($branchNeedList): ?>
        <ul class="dropdown-menu">
          <?php foreach ($branchBreadCrumbList as $item): ?>
            <li><?php echo link_to($item, 'default/fileList?branch=' . $item->getId()) ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    <?php endif; ?>
  </li>
  <?php endif; ?>
  <?php if (null !== $currentBreadCrumbFile): ?>
  <?php $fileNeedList = 0 != sizeof($fileBreadCrumbList) ?>
  <li class="divider">/</li>
  <li class="<?php echo $fileNeedList ? 'dropdown' : '' ?>">
    <?php if ($currentBreadCrumbFile !== null) : ?>
      <a href="#" class="<?php echo $fileNeedList ? 'dropdown-toggle icon' : '' ?>">E</a>
      <?php echo link_to($currentBreadCrumbFile, 'default/file?file=' . $currentBreadCrumbFile->getId()) ?>
      <?php if($fileNeedList): ?>
        <ul class="dropdown-menu">
          <?php foreach ($fileBreadCrumbList as $item): ?>
            <li>
              <span class="ricon">
                <?php if(1 === $item->getStatus()): ?>
                  Ã
                <?php elseif(2 === $item->getStatus()): ?>
                  Â
                <?php endif; ?>
              </span>
              <?php echo link_to($item, 'default/file?file=' . $item->getId()) ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
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