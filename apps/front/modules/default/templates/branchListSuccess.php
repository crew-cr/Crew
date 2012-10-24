<?php use_helper('Date'); ?>
<div class="list">
  <div class="list_head">
    <span class="title">Branch list</span>
    <div class="right">
      <?php echo link_to('Synchronize', 'default/branchesSynchronize', array('title' => 'Synchronize branches', 'query_string' => 'repository='.$repository->getId(), 'class' => 'branch-sync')) ?>
    </div>
  </div>
  <div class="list_body" id="project_list">
    <table>
      <?php foreach ($branches as $branch): ?>
      <tr>
        <td class="branch_name">
          <h3>
            <?php if($branch['reviewRequest'] == 1): ?><span  class="new">new!</span><?php endif; ?>
            <?php echo link_to($branch['name'], 'default/fileList', array('query_string' => 'branch='.$branch['id'])) ?>
          </h3><br />
          <span title="<?php echo $branch['lastCommitDesc'] ?>" class="commit_desc tooltip"><?php echo stringUtils::shorten(stringUtils::trimTicketInfos($branch['lastCommitDesc']), 105) ?></span>
        </td>
        <td class="branch_ago"><?php echo time_ago_in_words($branch['created']) ?> ago</td>
        <td class="branch_infos">
          <?php echo $branch['total'].' files' ?>
          <?php if($branch['added']): ?><span class="added tooltip" title="<?php echo $branch['added'].' added file(s)'; ?>"><?php echo $branch['added'].'+'; ?></span><?php endif; ?>
          <?php if($branch['modified']): ?><span class="modified tooltip" title="<?php echo $branch['modified'].' modified file(s)'; ?>"><?php echo $branch['modified'].'*'; ?></span><?php endif; ?>
          <?php if($branch['deleted']): ?><span class="deleted tooltip" title="<?php echo $branch['deleted'].' deleted file(s)'; ?>"><?php echo $branch['deleted'].'-'; ?></span><?php endif; ?>
        </td>
        <td class="status">
          <?php include_partial('default/dropdownStatus', array('id' => $branch['id'], 'status' =>$branch['status'], 'readonly' => false, 'type' => 'branch')); ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
<?php include_partial('default/statusAction', array('statusActions' => $statusActions)) ?>
<?php include_partial('default/commentBoard', array('commentBoards' => $commentBoards)) ?>
