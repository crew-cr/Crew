<table>
  <tr>
    <td class="line_comment">
      <div class="comment_holder">
        <?php foreach ($globalComments as $globalComment) : ?>
        <div class="commit_comment">
          <div class="comment_user"><?php echo sprintf("<span>commenté le %s par <strong>%s</strong></span>", $globalComment->getUpdatedAt('d/m/Y à H:i:s'), $globalComment->getsfGuardUser()) ?></div>
          <div class="comment_body"><?php echo sprintf("%s", $globalComment->getValue()) ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </td>
  </tr>
</table>
<form name="globalComment" id="globalComment" method="post" action="<?php echo url_for('default/branchAddComment?branch='.$branch->getId()) ?>" >
  <?php echo $form['value']->render(); ?>
  <button type="submit">Commenter la branche</button>
</form>