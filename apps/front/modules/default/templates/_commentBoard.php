<div class="list_head">
  Comments list
</div>
<div class="list_body scrollable" id="project_list">
  <table>
    <?php foreach ($commentBoards as $commentBoard): ?>
    <tr>
      <td><?php echo $commentBoard['User'] ?></td>
      <td><?php echo htmlspecialchars_decode($commentBoard['Message']) ?></td>
      <td><?php echo $commentBoard['CreatedAt'] ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>