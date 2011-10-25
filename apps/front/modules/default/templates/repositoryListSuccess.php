<div class="list">
  <div class="list_head">
    Liste des projets
  </div>
  <div class="list_body" id="project_list">
    <table>
      <?php foreach ($repositories as $repository): ?>
      <tr>
        <td>
          <div class="project_infos">
            <h3><?php echo link_to($repository['Name'], 'default/branchList', array('query_string' => 'repository='.$repository['Id'])) ?></h3>
            <span class="branchs">
              <span class="branch_icon"></span>
              <?php echo link_to($repository['NbBranches'].' branche(s)', 'default/branchList', array('query_string' => 'repository='.$repository['Id'])) ?>
            </span>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
