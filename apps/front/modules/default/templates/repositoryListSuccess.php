<div class="list">
  <div class="list_head">
    Project list
  </div>
  <div class="list_body" id="project_list">
    <table>
      <?php foreach ($repositories as $repository): ?>
      <tr>
        <td>
          <h3><?php echo link_to($repository['Name'], 'default/branchList', array('query_string' => 'repository='.$repository['Id'])) ?></h3>
        </td>
        <td class="view_infos">
          <?php echo link_to($repository['NbBranches'].' branch(es)', 'default/branchList', array('query_string' => 'repository='.$repository['Id'], 'class' => 'icon branch')) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
<?php include_partial('default/statusAction', array('statusActions' => $statusActions)) ?>
<?php include_partial('default/commentBoard', array('commentBoards' => $commentBoards)) ?>
