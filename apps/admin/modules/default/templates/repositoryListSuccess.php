<div class="list">
  <div class="list_head">
    Project list
  </div>
  <div class="list_body" id="project_list">
    <table>
      <?php foreach ($repositories as $repository): ?>
      <tr>
        <td>
          <h3><?php echo $repository['Name'] ?></h3>
        </td>
        <td>
          <div class="view_infos">
            <span class="branch_icon"></span>
            <?php echo $repository['NbBranches'].' branch(es)' ?>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
