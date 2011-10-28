<div class="list_head">
  Status actions list
</div>
<div class="list_body scrollable" id="project_list">
  <table>
    <?php foreach ($statusActions as $statusAction): ?>
    <tr>
      <td><?php echo $statusAction->getsfGuardUser() ?></td>
      <td><?php echo $statusAction->getRepository() ?></td>
      <td><?php echo htmlspecialchars_decode($statusAction->getMessage()) ?></td>
      <td><?php echo $statusAction->getCreatedAt('d/m/Y H:i:s') ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>