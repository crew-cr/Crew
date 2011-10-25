<div class="list">
  <div class="list_head">
    Liste des branches en attente de review
  </div>
  <div class="list_body" id="project_list">
    <table>
      <?php foreach ($branches as $branch): ?>
      <tr>
        <td>
          <div class="project_infos">
            <h3>
              <?php echo link_to($branch['Name'], 'default/fileList', array('query_string' => 'branch='.$branch['Id'])) ?>
            </h3>
            <span class="branchs">
              <span class="branch_icon"></span>
              <?php echo link_to($branch['NbFiles'].' fichier(s)', 'default/fileList', array('query_string' => 'branch='.$branch['Id'])) ?>
            </span>
          </div>
        </td>
        <td class="state">
          <?php echo link_to('Valider', 'default/branchToggleValidate', array('query_string' => 'branch='.$branch['Id'], 'class' => 'toggle status-valid '. ($branch['StatusId'] !== StatusPeer::OK ? 'disabled' : ''))) ?>
        </td>
        <td class="state">
          <?php echo link_to('Invalider', 'default/branchToggleUnvalidate', array('query_string' => 'branch='.$branch['Id'], 'class' => 'toggle status-invalid '. ($branch['StatusId'] !== StatusPeer::KO ? 'disabled' : ''))) ?>
        </td>
        <td class="state">
          <?php echo link_to('Blacklister', 'default/branchBlacklist', array('query_string' => 'branch='.$branch['Id'], 'class' => 'toggle status-blacklist disabled')) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
