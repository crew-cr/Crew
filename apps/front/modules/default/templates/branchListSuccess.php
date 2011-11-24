<div class="list">
  <div class="list_head">
    Branch list
    <div class="right">
      <?php echo link_to('Synchronize', 'default/branchesSynchronize', array('title' => 'Synchronize branches', 'query_string' => 'repository='.$repository->getId(), 'class' => 'branch-sync')) ?>
    </div>
  </div>
  <div class="list_body" id="project_list">
    <table>
      <?php foreach ($branches as $branch): ?>
      <tr>
        <td class="review_request">
        <?php if($branch['reviewRequest'] === 1) : ?>
          <span class="review_request_icon"></span>
        <?php endif; ?>
        </td>
        <td class="branch_name">
          <h3><?php echo link_to($branch['name'], 'default/fileList', array('query_string' => 'branch='.$branch['id'])) ?></h3>
        </td>
        <td class="commit_desc">
          <?php echo stringUtils::shorten(stringUtils::trimTicketInfos($branch['lastCommitDesc']), 100) ?>
        </td>
        <td class="file_infos">
          <?php echo $branch['total'].' files' ?><br />
          <?php if($branch['added']): ?><span class="added"><?php echo $branch['added'].'+'; ?></span><?php endif; ?>
          <?php if($branch['modified']): ?><span class="modified"><?php echo $branch['modified'].'*'; ?></span><?php endif; ?>
          <?php if($branch['deleted']): ?><span class="deleted"><?php echo $branch['deleted'].'-'; ?></span><?php endif; ?>
        </td>
        <td class="status">
          <?php echo link_to('Valider', 'default/branchToggleValidate', array('title' => 'Validate branch', 'query_string' => 'branch='.$branch['id'], 'class' => 'toggle status-valid '. ($branch['status'] !== BranchPeer::OK ? 'disabled' : ''))) ?>
          <?php echo link_to('Invalider', 'default/branchToggleUnvalidate', array('title' => 'Invalidate branch', 'query_string' => 'branch='.$branch['id'], 'class' => 'toggle status-invalid '. ($branch['status'] !== BranchPeer::KO ? 'disabled' : ''))) ?>
        </td>
        <td class="state">
          <?php echo link_to('Blacklister', 'default/branchBlacklist', array('title' => 'Blacklist branch', 'query_string' => 'branch='.$branch['id'], 'class' => 'toggle status-blacklist disabled')) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
<?php include_partial('default/statusAction', array('statusActions' => $statusActions)) ?>
<?php include_partial('default/commentBoard', array('commentBoards' => $commentBoards)) ?>
