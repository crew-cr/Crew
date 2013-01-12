<div class="list">
  <div class="list_head">
    <span class="title">Log Git</span>
  </div>
  <div class="list_body" id="log">
    <table>
      <?php foreach ($logs as $log): ?>
        <tr class="<?php if($log->getCode()) echo 'error' ?>">
          <td class="code repository_infos tooltip" title="<?php echo $log->getMessage() ?>"><?php echo $log->getCode() ?></td>
          <td class="command"><?php echo $log->getCommand() ?></td>
          <td class="date"><?php echo $log->getCreatedAt('d/m/Y H:i:s') ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <?php if ($moreLogs > 0): ?>
    <div class="list_footer">
      <?php echo link_to('More...', 'default/repositoryList', array('title' => 'More...', 'query_string' => 'gitlog='.$moreLogs)) ?>
    </div>
  <?php endif; ?>
</div>