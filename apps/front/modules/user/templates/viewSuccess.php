<h2 class="avatared"><?php echo $user->getUsername() ?></h1>
<div class="list">
  <?php include_partial('default/statusAction', array('statusActions' => $statusActions)) ?>
</div>
<div class="list">
  <?php include_partial('default/commentBoard', array('commentBoards' => $commentBoards)) ?>
</div>